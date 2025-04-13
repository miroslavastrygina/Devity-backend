<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestQuestionRequest;
use Exception;
use App\Services\TestQuestionService;

class TestQuestionController extends Controller
{
    public function __construct(
        private readonly TestQuestionService $testQuestionService
    ) {}

    public function index()
    {
        try {
            $test = $this->testQuestionService->index();
            return response()->json([
                "success" => true,
                "data" => $test
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function show(int $id)
    {
        try {
            $test = $this->testQuestionService->show($id);
            return response()->json([
                "success" => true,
                "data" => $test
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(TestQuestionRequest $request)
    {
        try {
            $newTest = $this->testQuestionService->create($request);
            return response()->json([
                "success" => true,
                "data" => $newTest
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(int $id, TestQuestionRequest $request)
    {
        try {
            $updatedTest = $this->testQuestionService->update($id, $request);
            return response()->json([
                "success" => true,
                "data" => $updatedTest
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->testQuestionService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Test deleted successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}