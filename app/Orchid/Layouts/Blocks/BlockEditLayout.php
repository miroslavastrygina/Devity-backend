<?php

namespace App\Orchid\Layouts\Blocks;

use App\Models\Course;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\TextArea;

class BlockEditLayout extends Rows
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
            Input::make('block.title')->title('Заголовок'),
            TextArea::make('block.description')->title('Описание'),
            Relation::make('block.course_id')
                ->title('Курс')
                ->fromModel(Course::class, 'title')
        ];
    }
}
