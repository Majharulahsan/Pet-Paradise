<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Firebase services. Get these values from your
    | Firebase Console at https://console.firebase.google.com/
    |
    */

    'project_id' => env('FIREBASE_PROJECT_ID', 'pet-paradise-77c4d'),

    'api_key' => env('FIREBASE_API_KEY', 'YOUR_FIREBASE_API_KEY_HERE'),

    /*
    |--------------------------------------------------------------------------
    | Firestore Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Firestore database operations.
    |
    */

    'firestore' => [
        'url' => env('FIRESTORE_URL', "https://firestore.googleapis.com/v1/projects/" . env('FIREBASE_PROJECT_ID', 'pet-paradise-77c4d') . "/databases/(default)/documents"),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Firebase Authentication.
    |
    */

    'auth' => [
        'url' => env('FIREBASE_AUTH_URL', 'https://identitytoolkit.googleapis.com/v1'),
    ],
];