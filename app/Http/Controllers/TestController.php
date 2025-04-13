<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\TestService;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function __construct(private readonly TestService $testService) {}

    public function index()
    {
        try {
            $test = $this->testService->index();
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
            $test = $this->testService->show($id);
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

    public function create(TestRequest $request)
    {
        try {
            $newTest = $this->testService->create($request);
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

    public function update(int $id, TestRequest $request)
    {
        try {
            $updatedTest = $this->testService->update($id, $request);
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
            $this->testService->delete($id);
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
