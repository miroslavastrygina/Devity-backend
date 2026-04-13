<?php

namespace App\Orchid\Screens\Teacher;

use Orchid\Screen\Screen;
use App\Services\AssignmentSubmissionService;
use App\Orchid\Layouts\Teacher\TeacherAssignmentTable;

class TeacherAssignmentScreen extends Screen
{
    public function __construct(private readonly AssignmentSubmissionService $assignmentSubmissionService) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $assignmentSubmissions = $this->assignmentSubmissionService->index();

        return [
            "assignmentSubmissions" => $assignmentSubmissions
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Задания на проверку';
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
            TeacherAssignmentTable::class
        ];
    }
}
