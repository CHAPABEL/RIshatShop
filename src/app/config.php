<?php
return [
    'db' => [
        'host' => getenv('DB_HOST') ?: 'rs_db',
        'name' => getenv('DB_NAME') ?: 'shopdb',
        'user' => getenv('DB_USER') ?: 'shopuser',
        'pass' => getenv('DB_PASS') ?: 'shoppass',
        'charset' => 'utf8mb4',
    ]
];
