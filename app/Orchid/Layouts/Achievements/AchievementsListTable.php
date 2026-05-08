<?php

namespace App\Orchid\Layouts\Achievements;

use App\Models\Achievement;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AchievementsListTable extends Table
{
    protected $target = 'achievements';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('title', 'Название')
                ->render(fn (Achievement $item) => Link::make($item->title)->route('platform.achievements.edit', $item->id))
                ->sort(),
            TD::make('action_type', 'Триггер')->sort(),
            TD::make('condition_value', 'Условие')->sort(),
            TD::make('points', 'Очки')->sort(),
            TD::make('is_active', 'Активна')
                ->render(fn (Achievement $item) => $item->is_active ? 'Да' : 'Нет'),
            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->render(fn (Achievement $item) => DropDown::make()
                    ->icon('bi.list-ul')
                    ->list([
                        Link::make('Изменить')
                            ->icon('bi.pen')
                            ->route('platform.achievements.edit', $item->id),
                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить эту запись?')
                            ->method('delete', ['id' => $item->id]),
                    ])),
        ];
    }
}
