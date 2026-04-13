<?php

namespace App\Orchid\Layouts\Teacher;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\TextArea;

class GradeLayout extends Rows
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
            TextArea::make('feedback')
                ->title('Комментарии')
                ->rows(5),
            Input::make('score')
                ->type('number')
                ->step("1")
                ->title('Оценка от 0 до 100')
                ->set('max', 100)
                ->set('min', 0)
                ->required(),
        ];
    }
}
