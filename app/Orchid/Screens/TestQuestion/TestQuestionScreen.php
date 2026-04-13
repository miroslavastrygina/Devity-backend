<?php

namespace App\Orchid\Screens\TestQuestion;

use Orchid\Screen\Screen;
use App\Models\TestQuestion;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Services\TestQuestionService;
use App\Http\Requests\TestQuestionRequest;
use App\Orchid\Layouts\TestQuestions\TestQuestionEditLayout;

class TestQuestionScreen extends Screen
{

    public $testQuestion;

    public function __construct(private readonly TestQuestionService $testQuestionService) {}
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query($id = null): iterable
    {
        if (isset($id)) {
            $this->testQuestion = $this->testQuestionService->show($id);
        } else {
            $this->testQuestion = new TestQuestion();
        }

        return [
            'testQuestion' => $this->testQuestion
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->testQuestion->id ? 'Редактировать вопрос' : 'Добавить вопросы';
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
                ->icon('floppy')
                ->method('save'),
            Button::make('Удалить')
                ->icon('trash')
                ->method('delete')
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
            TestQuestionEditLayout::class
        ];
    }

    public function save(TestQuestionRequest $request)
    {
        if (isset($this->testQuestion->id)) {
            $this->testQuestionService->update($this->testQuestion->id, $request);

            Toast::info("Вопрос успешно обновлен");
        } else {
            $newTestQuestion = $this->testQuestionService->create($request);
            Toast::info("Вопрос успешно создан");

            return redirect()->route('platform.tests.edit', $newTestQuestion->test_id);
        }
    }

    public function delete()
    {
        if (isset($this->testQuestion->id)) {
            $test_id = $this->testQuestion->test_id;
            $this->testQuestion->delete($this->testQuestion->id);
            Toast::info("Вопрос успешно удален");

            return redirect()->route('platform.tests.edit', $test_id);
        }
    }
}