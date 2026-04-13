<?php

namespace App\Orchid\Layouts\Tests;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class TestListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tests';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('title', 'Название теста')->render(function ($item) {
                return Link::make($item->title)->route('platform.tests.edit', $item->id);
            })->sort(),
            TD::make('lesson', 'Урок')->render(function ($item) {
                return Link::make($item->lesson->title)->route('platform.lessons.edit', $item->lesson->id);
            })->defaultHidden()->sort(),
            TD::make('timer', 'Время на прохождение')->render(function ($item) {
                $minutes = floor($item->timer);
                $seconds = round(($item->timer - $minutes) * 60);
                return "{$minutes} мин {$seconds} сек";
            })->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
        ];
    }
}
