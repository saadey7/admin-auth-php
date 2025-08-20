<?php

return [
    /*
     * Firebase JSON file path (set in each project via .env)
     */
    'firebase_json' => env('ADMIN_FIREBASE_JSON', base_path('firebase.json')),

    /*
     * Admin guard and redirect
     */
    'guard' => 'admin',
    'redirect_to' => env('ADMIN_DASHBOARD', '/admin'),
];