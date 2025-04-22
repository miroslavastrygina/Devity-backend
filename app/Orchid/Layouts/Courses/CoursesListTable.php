<?php

namespace App\Orchid\Layouts\Courses;

use Orchid\Screen\TD;
use App\Models\Course;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class CoursesListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'courses';

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
                return Link::make($item->title)->route('platform.courses.edit', $item->id);
            })->sort(),
            TD::make('description', 'Описание')->sort(),
            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()->sort(),
            TD::make(("Действия"))
                ->align(TD::ALIGN_CENTER)
                ->render(
                    fn(Course $item) => DropDown::make()
                        ->icon("bi.list-ul")
                        ->list([
                            Link::make('Изменить')
                                ->icon("bi.pen")
                                ->route("platform.courses.edit", $item),
                            Button::make("Удалить")
                                ->icon('bs.trash3')
                                ->confirm("Вы уверены, что хотите удалить эту запись ?")
                                ->method('delete', ["id" => $item->id]),
                        ])
                ),
        ];
    }
}
