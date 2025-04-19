<?php

namespace App\Orchid\Screens\Courses;

use App\Models\Course;
use App\Orchid\Layouts\Blocks\BlockListTable;
use App\Orchid\Layouts\Courses\CourseEditLayout;
use Orchid\Screen\Screen;
use App\Services\CourseService;

class CourseScreen extends Screen
{
    public $course;

    public function __construct(
        private readonly CourseService $courseService
    ) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->course = $this->courseService->show($id);
        } else {
            $this->course = new Course();
        }

        return [
            'course' => $this->course,
            'blocks' => $this->course->block
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->course->id ? 'Подробнее о "' . $this->course->title . '"' : 'Создать курс';
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
            CourseEditLayout::class,
            BlockListTable::class
        ];
    }
}