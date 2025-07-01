<?php

return [
    'require_secret_key' => env('ADMIN_REQUIRE_SECRET_KEY', false),
    'secret_key' => env('ADMIN_SECRET_KEY', ''),
    'max_login_attempts' => env('ADMIN_MAX_LOGIN_ATTEMPTS', 5),
];