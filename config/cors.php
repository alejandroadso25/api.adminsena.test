<?php

return [

    // Autoriza las peticiones del cliente web a las rutas versionadas del API.
    'paths' => ['v1/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:5173',
        'http://127.0.0.1:3000',
        'http://127.0.0.1:5173',
        'http://localhost:4173',
        // Orígenes usados por ClienteAdminSena durante desarrollo y en su virtual host.
        'http://localhost',
        'http://cliente.admin.sena.test',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
