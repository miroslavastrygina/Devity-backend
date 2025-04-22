<?php

namespace App\Orchid\Screens\Courses;

use App\Models\Course;
use Orchid\Screen\Screen;
use App\Services\CourseService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\CourseRequest;
use App\Orchid\Layouts\Blocks\BlockListTable;
use App\Orchid\Layouts\Courses\CourseEditLayout;
use App\Services\BlockService;

class CourseScreen extends Screen
{
    public $course;

    public function __construct(
        private readonly CourseService $courseService,
        private readonly BlockService $blockService
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
        return [
            Button::make('Сохранить')
                ->method('save'),
            Button::make('Удалить')
                ->method('delete'),
            Link::make('Создать блок')
                ->route('platform.blocks.create')
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
            CourseEditLayout::class,
            BlockListTable::class
        ];
    }


    public function save(CourseRequest $request)
    {
        if (isset($this->course->id)) {
            $this->courseService->update($this->course->id, $request);

            Toast::info("Курс успешно обновлен");
        } else {
            $this->courseService->create($request);
            Toast::info("Курс успешно создан");

            return redirect()->route('platform.courses');
        }
    }

    public function delete()
    {
        if (isset($this->course->id)) {
            $this->courseService->delete($this->course->id);
            Toast::info("Курс успешно удален");

            return redirect()->route('platform.courses');
        }
    }

    public function deleteBlock(int $id)
    {
        if ($id) {
            $this->blockService->delete($id);
            Toast::info("Курс успешно удален");

            return redirect()->route('platform.courses.edit', $this->course->id);
        }
    }
}