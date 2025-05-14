<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        Log::info($loginRequest->all());
        $validationData = $loginRequest->validated();
        $user = User::where("email", $validationData['login'])->first();

        if (
            $user &&
            Hash::check($validationData['password'], $user->password)
        ) {
            $token = $user->createToken("auth_token")->plainTextToken;

            return response()->json(["token" => $token]);
        }

        throw new Exception("Неверный пароль", 401);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $registerData = $registerRequest->validated();
        $registerData['password'] = Hash::make($registerData['password']);
        $user = User::create($registerData);
        $token = $user->createToken("auth_token")->plainTextToken;
        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }
}
