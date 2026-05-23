<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class JdoodleCompilerService
{
    public function executeCSharp(string $script, ?string $stdin = ''): array
    {
        $clientId = config('compiler.jdoodle.client_id');
        $clientSecret = config('compiler.jdoodle.client_secret');

        if (! $clientId || ! $clientSecret) {
            throw new RuntimeException('Не заданы JDOODLE_CLIENT_ID / JDOODLE_CLIENT_SECRET в .env');
        }

        $url = config('compiler.jdoodle.execute_url');
        $lang = config('compiler.jdoodle.csharp.language');
        $versionIndex = config('compiler.jdoodle.csharp.version_index');

        $response = Http::timeout(45)
            ->acceptJson()
            ->asJson()
            ->post($url, [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'script' => $script,
                'stdin' => $stdin ?? '',
                'language' => $lang,
                'versionIndex' => $versionIndex,
                'compileOnly' => false,
            ]);

        if (! $response->successful()) {
            throw new RuntimeException('JDoodle HTTP '.$response->status().': '.$response->body());
        }

        $data = $response->json();

        return [
            'output' => (string) ($data['output'] ?? ''),
            'status_code' => $data['statusCode'] ?? null,
            'memory' => $data['memory'] ?? null,
            'cpu_time' => $data['cpuTime'] ?? null,
            'compilation_status' => $data['compilationStatus'] ?? null,
            'error' => $data['error'] ?? null,
        ];
    }
}
