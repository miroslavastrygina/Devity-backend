<?php

namespace App\Orchid\Screens\Assignment;

use Orchid\Screen\Screen;
use App\Models\Assignment;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Services\AssignmentService;
use App\Http\Requests\AssignmentRequest;
use App\Orchid\Layouts\Assignment\AssignmentEditLayout;

class AssignmentScreen extends Screen
{
    public $assignment;

    public function __construct(private readonly AssignmentService $assignmentService) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->assignment = $this->assignmentService->show($id);
        } else {
            $this->assignment = new Assignment();
        }

        return [
            "assignment" => $this->assignment,
            // "questions" => $this->test->testQuestions
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->assignment->id ? 'Подробнее о "' . $this->assignment->title . '"' : 'Создать задание';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Сохранить')
                ->method('save'),
            Button::make('Удалить')
                ->method('delete'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            AssignmentEditLayout::class
        ];
    }

    public function save(AssignmentRequest $request)
    {
        if (isset($this->assignment->id)) {
            $this->assignmentService->update($this->assignment->id, $request);

            Toast::info("Задание успешно обновлено");
        } else {
            $newTest = $this->assignmentService->create($request);
            Toast::info("Задание успешно создано");

            return redirect()->route('platform.lessons.edit', $newTest->lesson_id);
        }
    }

    public function delete()
    {
        if (isset($this->assignment->id)) {
            $lesson_id = $this->assignment->lesson_id;
            $this->assignmentService->delete($this->assignment->id);
            Toast::info("Задание успешно удалено");

            return redirect()->route('platform.lessons.edit', $lesson_id);
        }
    }
}
