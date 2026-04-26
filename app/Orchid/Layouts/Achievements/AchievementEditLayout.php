<?php

namespace App\Orchid\Layouts\Achievements;

use App\Models\Achievement;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class AchievementEditLayout extends Rows
{
    protected function fields(): iterable
    {
        return [
            Input::make('achievement.title')
                ->title('Название')
                ->required(),
            Input::make('achievement.slug')
                ->title('Slug')
                ->help('Уникальный технический идентификатор')
                ->required(),
            TextArea::make('achievement.description')
                ->title('Описание'),
            Input::make('achievement.icon')
                ->title('Иконка (URL или имя)')
                ->help('Опционально, для отображения в ЛК'),
            Select::make('achievement.action_type')
                ->title('Триггер')
                ->options(Achievement::actionOptions())
                ->required(),
            Input::make('achievement.condition_value')
                ->type('number')
                ->min(1)
                ->title('Условие')
                ->help('Например, 3 = после 3 выполнений действия')
                ->required(),
            Input::make('achievement.points')
                ->type('number')
                ->min(0)
                ->title('Очки'),
            CheckBox::make('achievement.is_active')
                ->title('Активна')
                ->placeholder('Ачивка участвует в выдаче')
                ->value(1)
                ->sendTrueOrFalse(),
        ];
    }
}
