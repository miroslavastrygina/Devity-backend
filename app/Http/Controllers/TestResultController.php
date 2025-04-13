<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestResultRequest;
use Exception;
use App\Services\TestResultService;

class TestResultController extends Controller
{
    public function __construct(
        private readonly TestResultService $testResultService
    ) {}

    public function index()
    {
        try {
            $testResults = $this->testResultService->index();
            return response()->json([
                "success" => true,
                "data" => $testResults
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
            $testResult = $this->testResultService->show($id);
            return response()->json([
                "success" => true,
                "data" => $testResult
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(TestResultRequest $request)
    {
        try {
            $newTestResult = $this->testResultService->create($request);
            return response()->json([
                "success" => true,
                "data" => $newTestResult
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(int $id, TestResultRequest $request)
    {
        try {
            $updatedTestResult = $this->testResultService->update($id, $request);
            return response()->json([
                "success" => true,
                "data" => $updatedTestResult
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
            $this->testResultService->delete($id);
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