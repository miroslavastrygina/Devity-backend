<?php

namespace App\Orchid\Layouts\TestQuestions;

use App\Models\Test;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;

class TestQuestionEditLayout extends Rows
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
            TextArea::make('testQuestion.question')->title('Вопрос'),
            Input::make('testQuestion.answer')->title('Ответ'),
            Relation::make('testQuestion.test_id')
                ->title('Тест')
                ->fromModel(Test::class, 'title')
        ];
    }
}
