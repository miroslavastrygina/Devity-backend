<?php

return [

    'jdoodle' => [
        'client_id' => env('JDOODLE_CLIENT_ID'),
        'client_secret' => env('JDOODLE_CLIENT_SECRET'),
        'execute_url' => env('JDOODLE_EXECUTE_URL', 'https://api.jdoodle.com/v1/execute'),
        'csharp' => [
            'language' => env('JDOODLE_CSHARP_LANGUAGE', 'csharp'),
            'version_index' => env('JDOODLE_CSHARP_VERSION_INDEX', '3'),
        ],
    ],

];
