<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\AssignmentSubmissionRequest;

class AssignmentSubmissionService
{
    public function index()
    {
        return AssignmentSubmission::with(['assignment', 'user.groups'])->get();
    }

    public function show(int $id)
    {
        $assignment = AssignmentSubmission::with(['assignment', 'user.groups'])->find($id);

        return $assignment;
    }

    public function create(AssignmentSubmissionRequest $request)
    {
        $validated = $request->validated();
        // Проверка, есть ли файл
        if ($request->hasFile('file')) {
            // Сохраняем файл в диск 'public' и папку 'submissions'
            $path = $request->file('file')->store('submissions', 'public');

            // Формируем URL
            $fileUrl = asset('storage/' . $path);

            // Обновляем данные
            $validated['file_url'] = $fileUrl;
            $validated['submitted_at'] = now();

            $submission = AssignmentSubmission::create($validated);

            return response()->json($submission);
        }

        return response()->json(['error' => 'Файл не найден'], 400);
    }


    public function update(int $id, AssignmentSubmissionRequest $assignment)
    {
        $assignmentData = $assignment->validated();
        $updateAssignmen = $this->show($id);
        $updateAssignmen->update($assignmentData['submission']);
        $updateAssignmen->save();

        return $updateAssignmen;
    }

    public function delete(int $id)
    {
        $deleteAssignmen = $this->show($id);
        $deleteAssignmen->delete();
    }
}
