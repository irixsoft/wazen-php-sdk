<?php

return [
    'api_key' => env('WAZEN_API_KEY'),
    'base_url' => env('WAZEN_BASE_URL', 'https://wazen.dev/api/v1'),
    'timeout' => env('WAZEN_TIMEOUT', 30),
];
