<?php

namespace App\Orchid\Layouts\Lessons;

use App\Models\Block;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class LessonEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('lesson.title')->title('Заголовок'),
            Relation::make('lesson.block_id')
                ->title('Блок')
                ->fromModel(Block::class, 'title'),
            Input::make('lesson.video_url')->title('Ссылка для видео')->type('url'),
            SimpleMDE::make('lesson.content')->title('Контент урока'),
            TextArea::make('lesson.compiler_blocks_json')
                ->title('Блоки компилятора (JSON)')
                ->rows(18)
                ->help('Массив объектов {"code": "..."}. Вставьте в markdown маркеры [[compiler:0]], [[compiler:1]], … по порядку индексов.'),
        ];
    }
}