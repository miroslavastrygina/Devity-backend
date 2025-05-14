<?php

namespace App\Services;

use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use Exception;

class UserService
{
    public function update(UserUpdateRequest $user, int $user_id): User|Exception
    {
        $userUpdated = User::findOrFail($user_id);
        $userData = $user->validated();
        $userUpdated->update($userData);
        $userUpdated->save();

        return $userUpdated;
    }
}
