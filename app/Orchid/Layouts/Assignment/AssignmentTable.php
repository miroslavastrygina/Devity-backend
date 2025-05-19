<?php

namespace App\Orchid\Layouts\Assignment;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class AssignmentTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'assignments';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('title', 'Задание')->render(function ($item) {
                return Link::make($item->title)->route('platform.assignments.edit', $item->id);
            })->sort(),
            TD::make('lesson', 'Урок')->render(function ($item) {
                return Link::make($item->lesson->title)->route('platform.lessons.edit', $item->lesson->id);
            })->defaultHidden()->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
        ];
    }
}
