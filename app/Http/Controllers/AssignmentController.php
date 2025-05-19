<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use Exception;
use Illuminate\Http\Request;
use App\Services\AssignmentService;

class AssignmentController extends Controller
{
    public function __construct(private readonly AssignmentService $assginmentService) {}

    public function index()
    {
        try {
            $test = $this->assginmentService->index();
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
            $test = $this->assginmentService->show($id);
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

    public function create(AssignmentRequest $request)
    {
        try {
            $newTest = $this->assginmentService->create($request);
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

    public function update(int $id, AssignmentRequest $request)
    {
        try {
            $updatedTest = $this->assginmentService->update($id, $request);
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
            $this->assginmentService->delete($id);
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
