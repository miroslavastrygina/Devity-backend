<?php

namespace App\Orchid\Layouts\Groups;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class GroupListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'groups';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('name', 'Название')->render(function ($item) {
                return Link::make($item->name)->route('platform.groups.edit', $item->id);
            })->sort(),
            TD::make('description', 'Описание')->sort(),
            TD::make('teacher_id', 'Учитель')->render(function ($item) {
                return $item->teacher->email;
            })->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
        ];
    }
}
