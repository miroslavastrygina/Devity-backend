<?php

namespace App\Orchid\Screens\Lessons;

use App\Models\Lesson;
use Orchid\Screen\Screen;
use App\Services\LessonService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\LessonRequest;
use App\Orchid\Layouts\Tests\TestListTable;
use App\Orchid\Layouts\Lessons\LessonEditLayout;

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
        return [
            Button::make('Сохранить')
                ->method('save'),
            Button::make('Удалить')
                ->method('delete'),
            Link::make('Создать тест')
                ->route('platform.tests.create')
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
            LessonEditLayout::class,
            TestListTable::class
        ];
    }

    public function save(LessonRequest $request)
    {
        if (isset($this->lesson->id)) {
            $this->lessonService->update($this->lesson->id, $request);

            Toast::info("Урок успешно обновлен");
        } else {
            $newLesson = $this->lessonService->create($request);
            Toast::info("Урок успешно создан");

            return redirect()->route('platform.blocks.edit', $newLesson->block_id);
        }
    }

    public function delete()
    {
        if (isset($this->lesson->id)) {
            $block_id = $this->lesson->block_id;
            $this->lessonService->delete($this->lesson->id);
            Toast::info("Урок успешно удален");

            return redirect()->route('platform.blocks.edit', $block_id);
        }
    }
}