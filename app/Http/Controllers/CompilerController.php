<?php

namespace App\Http\Controllers;

use App\Services\JdoodleCompilerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CompilerController extends Controller
{
    public function execute(Request $request, JdoodleCompilerService $compiler): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:100000',
            'language' => 'sometimes|string|in:csharp',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first(),
            ], 422);
        }

        if ($request->input('language', 'csharp') !== 'csharp') {
            return response()->json([
                'success' => false,
                'msg' => 'Поддерживается только csharp',
            ], 422);
        }

        try {
            $result = $compiler->executeCSharp($validator->validated()['code']);

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage(),
            ], 502);
        }
    }
}
