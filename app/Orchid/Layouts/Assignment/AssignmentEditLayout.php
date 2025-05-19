<?php

namespace App\Orchid\Layouts\Assignment;

use App\Models\Lesson;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\SimpleMDE;

class AssignmentEditLayout extends Rows
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
            Input::make('assignment.title')->title('Заголовок'),
            SimpleMDE::make('assignment.description')->title('Описание задания'),
            Relation::make('assignment.lesson_id')
                ->title('Урок')
                ->fromModel(Lesson::class, 'title')
        ];
    }
}
