<?php

namespace App\Services;

use App\Models\Lesson;
use App\Http\Requests\LessonRequest;

class LessonService
{
    public function index()
    {
        return Lesson::all();
    }

    public function show(int $id)
    {
        $lesson = Lesson::find($id);

        return $lesson;
    }

    public function create(LessonRequest $lesson)
    {
        $lessonData = $lesson->validated();
        $newLesson = Lesson::create($lessonData);

        return $newLesson;
    }

    public function update(int $id, LessonRequest $lesson)
    {
        $lessonData = $lesson->validated();
        $updateLesson = $this->show($id);
        $updateLesson->update($lessonData);
        $updateLesson->save();

        return $updateLesson;
    }

    public function delete(int $id)
    {
        $deletedLesson = $this->show($id);
        $deletedLesson->delete();
    }
}