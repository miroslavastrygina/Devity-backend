<?php

namespace App\Services;

use App\Http\Requests\CourseRequest;
use App\Models\Course;

class CourseService
{
    public function index()
    {
        return Course::all();
    }

    public function show($id)
    {
        $course = Course::find($id);

        return $course;
    }

    public function create(CourseRequest $course)
    {
        $courseData = $course->validated();
        $newCourse = Course::create($courseData);

        return $newCourse;
    }

    public function update(int $id, CourseRequest $course)
    {
        $courseData = $course->validated();
        $updateCourse = $this->show($id);
        $updateCourse->update($courseData);
        $updateCourse->save();

        return $updateCourse;
    }

    public function delete(int $id)
    {
        $deletedCourse = Course::find($id);
        $deletedCourse->delete();
    }
}