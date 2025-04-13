<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\LessonService;
use App\Http\Requests\LessonRequest;

class LessonController extends Controller
{
    public function __construct(private readonly LessonService $lessonService) {}

    public function index()
    {
        try {
            $lessons = $this->lessonService->index();
            return response()->json([
                "success" => true,
                "data" => $lessons
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
            $lesson = $this->lessonService->show($id);
            return response()->json([
                "success" => true,
                "data" => $lesson
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(LessonRequest $lesson)
    {
        try {
            $newLesson = $this->lessonService->create($lesson);
            return response()->json([
                "success" => true,
                "data" => $newLesson
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(int $id, LessonRequest $lesson)
    {
        try {
            $updateLesson = $this->lessonService->update($id, $lesson);
            return response()->json([
                "success" => true,
                "data" => $updateLesson
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
            $this->lessonService->delete($id);
            return response()->json([
                "success" => true,
                "msg" => "Lesson deleted successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}