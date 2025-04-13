<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use Exception;
use Illuminate\Http\Request;
use App\Services\GroupService;

class GroupController extends Controller
{
    public function __construct(private readonly GroupService $groupService) {}

    public function index()
    {
        try {
            $groups = $this->groupService->index();
            return response()->json([
                "success" => true,
                "data" => $groups
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
            $group = $this->groupService->show($id);
            return response()->json([
                "success" => true,
                "data" => $group
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function create(GroupRequest $group)
    {
        try {
            $newGroup = $this->groupService->create($group);
            return response()->json([
                "success" => true,
                "data" => $newGroup
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }

    public function update(GroupRequest $group, int $id)
    {
        try {
            $updatedGroupe = $this->groupService->update($id, $group);
            return response()->json([
                "success" => true,
                "data" => $updatedGroupe
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
            $this->groupService->delete($id);
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

    public function attachToGroup(Request $request, int $group_id)
    {
        $user = $request->user();
        try {
            $user->attachToGroup($group_id);
            return response()->json([
                "success" => true,
                "msg" => "Вы успешно присоединились к группе"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}