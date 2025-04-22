<?php

namespace App\Orchid\Layouts\Tests;

use App\Models\Lesson;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

class TestEditLayout extends Rows
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
            Input::make('test.title')->title('Заголовок'),
            Relation::make('test.lesson_id')
                ->title('Урок')
                ->fromModel(Lesson::class, 'title')
        ];
    }
}
