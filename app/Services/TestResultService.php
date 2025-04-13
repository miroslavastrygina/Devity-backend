<?php

namespace App\Services;

use App\Http\Requests\TestResultRequest;
use App\Models\TestResult;

class TestResultService
{
    public function index()
    {
        return TestResult::all();
    }

    public function show(int $id)
    {
        $testResult = TestResult::find($id);

        return $testResult;
    }

    public function create(TestResultRequest $testResult)
    {
        $testResultData = $testResult->validated();
        $newTestResult = TestResult::create($testResultData);

        return $newTestResult;
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
