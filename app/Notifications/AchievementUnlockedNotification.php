<?php

namespace App\Notifications;

use App\Models\Achievement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AchievementUnlockedNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Achievement $achievement
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
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
