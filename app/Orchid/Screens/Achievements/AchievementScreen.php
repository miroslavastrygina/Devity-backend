<?php

namespace App\Orchid\Screens\Achievements;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use App\Orchid\Layouts\Achievements\AchievementEditLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AchievementScreen extends Screen
{
    public ?Achievement $achievement = null;

    public function query(?int $id = null): iterable
    {
        $this->achievement = $id
            ? Achievement::query()->findOrFail($id)
            : new Achievement(['is_active' => true, 'condition_value' => 1, 'points' => 0]);

        return [
            'achievement' => $this->achievement,
        ];
    }

    public function name(): ?string
    {
        return $this->achievement?->exists
            ? 'Редактирование ачивки'
            : 'Создание ачивки';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('save'),
            Button::make('Удалить')
                ->method('delete'),
        ];
    }

    public function layout(): iterable
    {
        return [
            AchievementEditLayout::class,
        ];
    }

    public function save(AchievementRequest $request)
    {
        $payload = $request->validated()['achievement'];
        $payload['is_active'] = $payload['is_active'] ?? false;

        if ($this->achievement?->exists) {
            $this->achievement->update($payload);
            Toast::info('Ачивка обновлена');
        } else {
            Achievement::query()->create($payload);
            Toast::info('Ачивка создана');
        }

        return redirect()->route('platform.achievements');
    }

    public function delete()
    {
        if ($this->achievement?->exists) {
            $this->achievement->delete();
            Toast::info('Ачивка удалена');
        }

        return redirect()->route('platform.achievements');
    }
}
