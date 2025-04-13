<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    public function __construct(
        private readonly CourseService $courseService,
    ) {}

    public function index()
    {
        try {
            $courses = $this->courseService->index();
            return response()->json([
                "success" => true,
                "data" => $courses
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
            $course = $this->courseService->show($id);
            return response()->json([
                "success" => true,
                "data" => $course
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(CourseRequest $course)
    {
        try {
            $newCourse = $this->courseService->create($course);
            return response()->json([
                "success" => true,
                "data" => $newCourse
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(CourseRequest $course, int $id)
    {
        try {
            $updatedCourse = $this->courseService->update($id, $course);
            return response()->json([
                "success" => true,
                "data" => $updatedCourse
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
            $this->courseService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Курс удален"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
