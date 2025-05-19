<?php

namespace App\Services;

use App\Http\Requests\AssignmentRequest;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;

class AssignmentService
{
    public function index()
    {
        if (count(Auth::user()->groups) > 0) {
            return Assignment::with(['lesson'])->get();
        }
        return null;
    }

    public function show(int $id)
    {
        $assignment = Assignment::with('lesson')->find($id);

        return $assignment;
    }

    public function create(AssignmentRequest $assignment)
    {
        $assignmentData = $assignment->validated();
        $newAssignment = Assignment::create($assignmentData['assignment']);

        return $newAssignment;
    }

    public function update(int $id, AssignmentRequest $assignment)
    {
        $assignmentData = $assignment->validated();
        $updateAssignmen = $this->show($id);
        $updateAssignmen->update($assignmentData['assignment']);
        $updateAssignmen->save();

        return $updateAssignmen;
    }

    public function delete(int $id)
    {
        $deleteAssignmen = $this->show($id);
        $deleteAssignmen->delete();
    }
}
