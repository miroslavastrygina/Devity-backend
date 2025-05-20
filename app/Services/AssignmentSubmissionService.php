<?php

namespace App\Services;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\AssignmentGrade;
use App\Models\AssignmentSubmission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AssignmentRequest;
use App\Http\Requests\AssignmentSubmissionRequest;

class AssignmentSubmissionService
{
    public function index()
    {
        return AssignmentSubmission::with(['assignment', 'user.groups'])
            ->where('rated', false)
            ->whereHas('user.groups', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->get();
    }

    public function getGradesByStudent(Request $request)
    {
        $userId = $request->query('user_id'); // Получаем user_id из параметра запроса

        // Получаем все оценки, где submission принадлежит нужному пользователю
        $grades = AssignmentGrade::whereHas('submission', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->with(['submission', 'teacher'])
            ->get();

        return response()->json($grades);
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
