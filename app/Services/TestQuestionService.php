<?php

namespace App\Services;

use App\Http\Requests\TestQuestionRequest;
use App\Models\TestQuestion;

class TestQuestionService
{
    public function index()
    {
        return TestQuestion::all();
    }

    public function show(int $id)
    {
        $testQuestion = TestQuestion::find($id);

        return $testQuestion;
    }

    public function create(TestQuestionRequest $testQuestion)
    {
        $testQuestionData = $testQuestion->validated();
        $newTestQuestion = TestQuestion::create($testQuestionData);

        return $newTestQuestion;
    }

    public function update(int $id, TestQuestionRequest $testQuestion)
    {
        $testQuestionData = $testQuestion->validated();
        $updateTestQuestion = $this->show($id);
        $updateTestQuestion->update($testQuestionData);
        $updateTestQuestion->save();

        return $updateTestQuestion;
    }

    public function delete(int $id)
    {
        $deletedTestQuestion = $this->show($id);
        $deletedTestQuestion->delete();
    }
}