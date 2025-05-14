<?php

namespace App\Services;

use App\Models\TestResult;
use App\Models\TestUserResult;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TestResultRequest;

class TestResultService
{
    public function __construct(
        protected TestQuestionService $testQuestionService,
        protected TestService $testService,
    ) {}

    public function index()
    {
        return TestResult::all();
    }

    public function show(int $id)
    {
        $testResult = TestUserResult::with(['user', 'test.lesson'])->find($id);

        return $testResult;
    }

    public function create(TestResultRequest $testResult)
    {
        $testResultData = $testResult->validated();
        if (empty($testResultData['question'])) {
            return true;
        }
        $user_id = Auth::id();
        $testId = $this->testQuestionService->show($testResultData['question'][0]['question_id'])->test->id;
        $questionCount =  count($this->testService->show($testId)->testQuestions);
        $points = 0;
        // Проверка ответов
        foreach ($testResultData['question'] as $value) {
            $testQestion = $this->testQuestionService->show($value['question_id']);

            if ($testQestion->answer == $value['user_answer']) {
                $points++;
            }
        }
        $avg_points = $points;
        $avg_percent = $points / $questionCount * 100;

        $result = TestUserResult::create([
            "test_id" => $testId,
            "user_id" => $user_id,
            "avg_points" => round($avg_points, 2),
            "avg_percent" => round($avg_percent, 2)
        ]);

        // TestResult::insert($testResultData['question']);

        return $result;
    }

    public function update(int $id, TestResultRequest $testResult)
    {
        $testResultData = $testResult->validated();
        $updateTestResult = $this->show($id);
        $updateTestResult->update($testResultData);
        $updateTestResult->save();

        return $updateTestResult;
    }

    public function delete(int $id)
    {
        $deletedTestResult = $this->show($id);
        $deletedTestResult->delete();
    }
}
