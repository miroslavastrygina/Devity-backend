<?php

namespace App\Orchid\Screens\Teacher;

use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Legend;
use Orchid\Support\Facades\Layout;
use App\Services\AssignmentSubmissionService;

class AssignmentSubmissionScreen extends Screen
{
    public $email;
    public function __construct(private readonly AssignmentSubmissionService $assignmentSubmissionService) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(?int $id = null): iterable
    {
        $assignmentSubmission = $this->assignmentSubmissionService->show($id);
        $this->email = $assignmentSubmission->user->email;
        return [
            "assignmentSubmission" => $assignmentSubmission
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Решение от ' . $this->email;
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend(
                'assignmentSubmission',
                [
                    Sight::make('id'),
                    Sight::make('user_id', 'Ученик')->render(
                        function ($item) {
                            return $item->user->name . " " .
                                $item->user->surname . " " . $item->user->patronymic;
                        }
                    ),
                    Sight::make('Email')->render(
                        function ($item) {
                            return $item->user->email;
                        }
                    ),
                    Sight::make('Группы')->render(
                        function ($item) {
                            $groups = $item->user->groups;
                            $groupMsgs = "";
                            foreach ($groups as $value) {
                                $groupMsgs .= $value->name;
                            }
                            return $groupMsgs;
                        }
                    ),
                    Sight::make('assignment_id', 'Задание')->render(
                        function ($item) {
                            return $item->assignment->title;
                        }
                    ),
                    Sight::make('file_url', 'Скачать файл')->render(
                        function ($item) {
                            return "<a href=\"{$item->file_url}\" download>Скачать</a>";
                        }
                    )
                    // Sight::make('text', "Текст"),
                ]
            )
        ];
    }
}
