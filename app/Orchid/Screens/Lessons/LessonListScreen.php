<?php

namespace App\Orchid\Screens\Lessons;

use Orchid\Screen\Screen;
use App\Services\LessonService;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Lessons\LessonListTable;

class LessonListScreen extends Screen
{
    public function __construct(
        private readonly LessonService $lessonService
    ) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $lessons = $this->lessonService->index();

        return [
            'lessons' => $lessons
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Уроки';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать блок')
                ->route('platform.lessons.create')
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
            LessonListTable::class
        ];
    }
}