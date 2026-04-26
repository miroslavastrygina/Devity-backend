<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $achievements = Achievement::query()
            ->where('is_active', true)
            ->with([
                'users' => function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                },
            ])
            ->orderBy('id')
            ->get()
            ->map(function (Achievement $achievement) use ($user) {
                $awarded = $achievement->users->firstWhere('id', $user->id);

                return [
                    'id' => $achievement->id,
                    'title' => $achievement->title,
                    'description' => $achievement->description,
                    'icon' => $achievement->icon,
                    'action_type' => $achievement->action_type,
                    'condition_value' => $achievement->condition_value,
                    'points' => $achievement->points,
                    'is_unlocked' => (bool) $awarded,
                    'awarded_at' => $awarded?->pivot?->awarded_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $achievements,
        ]);
    }

    public function show(int $id)
    {
        $user = Auth::user();

        $achievement = Achievement::query()
            ->where('is_active', true)
            ->with([
                'users' => function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                },
            ])
            ->findOrFail($id);

        $awarded = $achievement->users->firstWhere('id', $user->id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $achievement->id,
                'title' => $achievement->title,
                'description' => $achievement->description,
                'icon' => $achievement->icon,
                'action_type' => $achievement->action_type,
                'condition_value' => $achievement->condition_value,
                'points' => $achievement->points,
                'is_unlocked' => (bool) $awarded,
                'awarded_at' => $awarded?->pivot?->awarded_at,
            ],
        ]);
    }
}
