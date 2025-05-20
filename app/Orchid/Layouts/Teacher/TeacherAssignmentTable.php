<?php

namespace App\Orchid\Layouts\Teacher;

use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use App\Models\AssignmentSubmission;

class TeacherAssignmentTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'assignmentSubmissions';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->sort(),
            TD::make('assignment_id', 'Задание')->render(function ($item) {
                return Link::make($item->assignment->title)->route('platform.assignments.edit', $item->assignment->id);
            })->sort(),
            TD::make('user_id', 'Пользователь')->render(function ($item) {
                return $item->user->email;
            })->sort(),
            TD::make('created_at', 'Дата отправления')->sort(),
            TD::make('rated', 'Статус проверки')
                ->render(function ($item) {
                    return $item->rated == false ? "Не проверен" : "Проверен";
                })
                ->sort(),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(
                    fn(AssignmentSubmission $assignment) =>
                    Link::make('Проверить')
                        ->icon('bs.check-all')
                        ->route('platform.assignment-submissions-view', ["id" => $assignment->id])
                ),
        ];
    }
}
