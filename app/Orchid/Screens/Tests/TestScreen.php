<?php

namespace App\Orchid\Screens\Tests;

use App\Models\Test;
use Orchid\Screen\Screen;
use App\Services\TestService;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\TestRequest;
use App\Orchid\Layouts\Tests\TestEditLayout;
use App\Orchid\Layouts\TestQuestions\TestQuestionListTable;

class TestScreen extends Screen
{
    public $test;

    public function __construct(private readonly TestService $testService) {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->test = $this->testService->show($id);
        } else {
            $this->test = new Test();
        }

        return [
            "test" => $this->test,
            "questions" => $this->test->testQuestions
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->test->id ? 'Подробнее о "' . $this->test->title . '"' : 'Создать тест';
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
            Link::make('Добавить ответы')
                ->route('platform.tests-question.create')
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
            TestEditLayout::class,
            TestQuestionListTable::class
        ];
    }

    public function save(TestRequest $request)
    {
        if (isset($this->test->id)) {
            $this->testService->update($this->test->id, $request);

            Toast::info("Тест успешно обновлен");
        } else {
            $newTest = $this->testService->create($request);
            Toast::info("Тест успешно создан");

            return redirect()->route('platform.lessons.edit', $newTest->lesson_id);
        }
    }

    public function delete()
    {
        if (isset($this->test->id)) {
            $lesson_id = $this->test->lesson_id;
            $this->testService->delete($this->test->id);
            Toast::info("Урок успешно удален");

            return redirect()->route('platform.lessons.edit', $lesson_id);
        }
    }
}