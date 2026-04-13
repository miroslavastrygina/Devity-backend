<?php

namespace App\Orchid\Layouts\GroupsMember;

use Orchid\Screen\TD;
use App\Models\GroupMember;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;

class GroupMemberListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'members';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('user_id', 'Пользователь')->render(
                function ($item) {
                    return $item->user->email;
                }
            )->sort(),
            TD::make('joined_at', 'Дата присоединения')->sort(),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(GroupMember $user) =>
                Button::make(__('Удалить'))
                    ->icon('bs.trash3')
                    ->confirm(__('Вы уверены что хотите открепить пользователя от группые ?'))
                    ->method('detach', [
                        'id' => $user->id,
                    ])),

        ];
    }
}
