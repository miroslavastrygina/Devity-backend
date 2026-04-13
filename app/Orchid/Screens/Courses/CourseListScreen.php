<?php

namespace App\Orchid\Screens\Courses;

use Orchid\Screen\Screen;
use App\Services\CourseService;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Courses\CoursesListTable;

class CourseListScreen extends Screen
{
    public function __construct(
        private readonly CourseService $courseService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $courses = $this->courseService->index();

        return [
            "courses" => $courses
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Курсы';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Создать курс')
                ->route('platform.courses.create')
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
            CoursesListTable::class
        ];
    }

    public function delete($id)
    {
        $this->courseService->delete($id);
        Toast::info("Курс успешно удален");

        return redirect()->route('platform.courses');
    }
}
