<?php

namespace App\Orchid\Layouts\Lessons;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class LessonListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'lessons';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('title', 'Название')->render(function ($item) {
                return Link::make($item->title)->route('platform.lessons.edit', $item->id);
            })->sort(),
            TD::make('content', 'Описание')->sort(),
            TD::make('video_url', 'Видео')->sort(),
            TD::make('block', 'Блок')->render(function ($item) {
                return Link::make($item->block->title)->route('platform.blocks.edit', $item->block->id);
            })->defaultHidden()->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
        ];
    }
}