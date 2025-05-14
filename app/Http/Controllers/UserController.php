<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}
    public function update(UserUpdateRequest $user, int $user_id)
    {
        try {
            $userUpdated =  $this->userService->update($user, $user_id);
            return response()->json([
                "success" => true,
                "user" => $userUpdated
            ]);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
