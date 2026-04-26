<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\TestQuestion;
use App\Models\TestResult;
use App\Models\TestUserResult;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TestResultRequest;

class TestResultService
{
    public function __construct(
        protected TestQuestionService $testQuestionService,
        protected TestService $testService,
        protected AchievementService $achievementService,
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
        $answers = $testResultData['question'] ?? [];

        if (empty($answers)) {
            return true;
        }

        $userId = Auth::id();
        $questionIds = collect($answers)
            ->pluck('question_id')
            ->filter()
            ->unique()
            ->values();

        if ($questionIds->isEmpty()) {
            return true;
        }

        $questions = TestQuestion::query()
            ->select(['id', 'test_id', 'answer'])
            ->whereIn('id', $questionIds)
            ->get()
            ->keyBy('id');

        $firstQuestion = $questions->first();

        if (!$firstQuestion) {
            return true;
        }

        $testId = (int) $firstQuestion->test_id;
        $questionCount = (int) TestQuestion::query()
            ->where('test_id', $testId)
            ->count();

        if ($questionCount === 0) {
            return true;
        }

        $points = 0;
        foreach ($answers as $value) {
            $question = $questions->get($value['question_id'] ?? null);
            if (!$question) {
                continue;
            }

            if ($question->answer === ($value['user_answer'] ?? null)) {
                $points++;
            }
        }

        $avgPoints = $points;
        $avgPercent = $points / $questionCount * 100;

        $result = TestUserResult::create([
            "test_id" => $testId,
            "user_id" => $userId,
            "avg_points" => round($avgPoints, 2),
            "avg_percent" => round($avgPercent, 2)
        ]);

        $this->achievementService->processAction($userId, Achievement::ACTION_TEST_PASSED);

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
