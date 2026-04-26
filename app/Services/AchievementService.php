<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\AssignmentSubmission;
use App\Models\TestUserResult;
use App\Models\User;
use App\Models\UserAchievement;
use App\Notifications\AchievementUnlockedNotification;

class AchievementService
{
    public function processAction(int $userId, string $actionType): void
    {
        $user = User::find($userId);

        if (!$user) {
            return;
        }

        $achievements = Achievement::query()
            ->where('is_active', true)
            ->where('action_type', $actionType)
            ->get();

        if ($achievements->isEmpty()) {
            return;
        }

        $metricValue = $this->resolveMetric($userId, $actionType);

        foreach ($achievements as $achievement) {
            $alreadyAwarded = UserAchievement::query()
                ->where('user_id', $userId)
                ->where('achievement_id', $achievement->id)
                ->exists();

            if ($alreadyAwarded) {
                continue;
            }

            if ($metricValue < $achievement->condition_value) {
                continue;
            }

            UserAchievement::create([
                'user_id' => $userId,
                'achievement_id' => $achievement->id,
                'awarded_at' => now(),
            ]);

            $user->notify(new AchievementUnlockedNotification($achievement));
        }
    }

    private function resolveMetric(int $userId, string $actionType): int
    {
        return match ($actionType) {
            Achievement::ACTION_TEST_PASSED => TestUserResult::query()
                ->where('user_id', $userId)
                ->where('avg_percent', '>=', 70)
                ->count(),
            Achievement::ACTION_ASSIGNMENT_SUBMITTED => AssignmentSubmission::query()
                ->where('user_id', $userId)
                ->count(),
            Achievement::ACTION_ASSIGNMENT_GRADED => AssignmentSubmission::query()
                ->where('user_id', $userId)
                ->where('rated', true)
                ->count(),
            default => 0,
        };
    }
}
