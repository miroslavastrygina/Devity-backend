<?php

namespace App\Orchid\Layouts\Lessons;

use App\Models\Block;
use Illuminate\Database\Eloquent\Relations\Relation as RelationsRelation;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\SimpleMDE;

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
        ];
    }
}