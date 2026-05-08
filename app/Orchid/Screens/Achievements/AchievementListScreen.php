<?php

namespace App\Orchid\Screens\Achievements;

use App\Models\Achievement;
use App\Orchid\Layouts\Achievements\AchievementsListTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AchievementListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'achievements' => Achievement::query()->orderBy('id')->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Ачивки';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Создать ачивку')
                ->route('platform.achievements.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            AchievementsListTable::class,
        ];
    }

    public function delete(int $id)
    {
        Achievement::query()->whereKey($id)->delete();

        Toast::info('Ачивка удалена');

        return redirect()->route('platform.achievements');
    }
}
