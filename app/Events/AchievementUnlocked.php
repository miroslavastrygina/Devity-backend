<?php

namespace App\Events;

use App\Models\Achievement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementUnlocked implements ShouldBroadcastNow
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public function __construct(
        public readonly int $userId,
        public readonly Achievement $achievement,
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel('achievements.' . $this->userId);
    }

    public function broadcastAs(): string
    {
        return 'achievement.unlocked';
    }

    public function broadcastWith(): array
    {
        return [
            'achievement_id' => $this->achievement->id,
            'title' => $this->achievement->title,
            'description' => $this->achievement->description,
            'icon' => $this->achievement->icon,
            'points' => $this->achievement->points,
            'awarded_at' => now()->toISOString(),
        ];
    }
}
