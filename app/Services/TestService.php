<?php

namespace App\Services;

use App\Http\Requests\TestRequest;
use App\Models\Test;

class TestService
{
    public function index()
    {
        return Test::with(['lesson', 'testQuestions'])->get();
    }

    public function show(int $id)
    {
        $test = Test::with(['testQuestions'])->find($id);

        return $test;
    }

    public function create(TestRequest $test)
    {
        $testData = $test->validated();
        $newTest = Test::create($testData['test']);

        return $newTest;
    }

    public function update(int $id, TestRequest $test)
    {
        $testData = $test->validated();
        $updateTest = $this->show($id);
        $updateTest->update($testData['test']);
        $updateTest->save();

        return $updateTest;
    }

    public function delete(int $id)
    {
        $deletedTest = $this->show($id);
        $deletedTest->delete();
    }
}
