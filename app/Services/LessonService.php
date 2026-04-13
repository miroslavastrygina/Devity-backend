<?php

namespace App\Services;

use App\Models\Lesson;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\Auth;

class LessonService
{
    public function index()
    {
        $withArr = ['block', 'tests'];
        if (count(Auth::user()->groups) > 0) {
            $withArr[] = 'assignments';
        }

        return Lesson::with($withArr)->get();
    }

    public function show(int $id)
    {
        $lesson = Lesson::with(['block', 'tests'])->find($id);

        return $lesson;
    }

    public function create(LessonRequest $lesson)
    {
        $lessonData = $lesson->validated();
        $newLesson = Lesson::create($lessonData['lesson']);

        return $newLesson;
    }

    public function update(int $id, LessonRequest $lesson)
    {
        $lessonData = $lesson->validated();
        $updateLesson = $this->show($id);
        $updateLesson->update($lessonData['lesson']);
        $updateLesson->save();

        return $updateLesson;
    }

    public function delete(int $id)
    {
        $deletedLesson = $this->show($id);
        $deletedLesson->delete();
    }
}
