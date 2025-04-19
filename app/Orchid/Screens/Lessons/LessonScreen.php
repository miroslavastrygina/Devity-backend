<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Lesson;
use App\Orchid\Layouts\Lessons\LessonEditLayout;
use App\Orchid\Layouts\Tests\TestListTable;
use App\Services\LessonService;
use Orchid\Screen\Screen;

class LessonScreen extends Screen
{
    public $lesson;

    public function __construct(
        private readonly LessonService $lessonService
    ) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->lesson = $this->lessonService->show($id);
        } else {
            $this->lesson = new Lesson();
        }

        return [
            'lesson' => $this->lesson,
            'tests' => $this->lesson->tests
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->lesson->id ? 'Подробнее о "' . $this->lesson->title . '"' : 'Создать урок';
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
            LessonEditLayout::class,
            TestListTable::class
        ];
    }
}