<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\AssignmentGrade;
use App\Services\AssignmentSubmissionService;
use App\Http\Requests\AssignmentSubmissionRequest;

class AssignmentSubmissionController extends Controller
{
    public function __construct(private readonly AssignmentSubmissionService $assginmentSubmissionService) {}

    public function index()
    {
        try {
            $assignmentsSubmission = $this->assginmentSubmissionService->index();
            return response()->json([
                "success" => true,
                "data" => $assignmentsSubmission
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function getGradesByStudent(int $id)
    {
        try {
            $grades = AssignmentGrade::whereHas('submission', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
                ->with(['submission.assignment', 'teacher'])
                ->get();
            return response()->json([
                "success" => true,
                "data" => $grades
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
            $assignmentsSubmission = $this->assginmentSubmissionService->show($id);
            return response()->json([
                "success" => true,
                "data" => $assignmentsSubmission
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(AssignmentSubmissionRequest $request)
    {
        try {
            $newAssignmentsSubmission = $this->assginmentSubmissionService->create($request);
            return response()->json([
                "success" => true,
                "data" => $newAssignmentsSubmission
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(int $id, AssignmentSubmissionRequest $request)
    {
        try {
            $updatedAssignmentsSubmission = $this->assginmentSubmissionService->update($id, $request);
            return response()->json([
                "success" => true,
                "data" => $updatedAssignmentsSubmission
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
            $this->assginmentSubmissionService->delete($id);
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
