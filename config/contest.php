<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration du Concours
    |--------------------------------------------------------------------------
    |
    | Paramètres de dates et configuration du concours.
    | Modifiez ces valeurs pour gérer les périodes du concours.
    |
    */

    'enabled' => env('CONTEST_ENABLED', false),

    'start_date' => env('CONTEST_START_DATE', '2025-10-13'),

    'end_date' => env('CONTEST_END_DATE', '2025-11-18'),

    'results_date' => env('CONTEST_RESULTS_DATE', '2025-11-17'),

    /*
    |--------------------------------------------------------------------------
    | Messages du Concours
    |--------------------------------------------------------------------------
    */

    'messages' => [
        'not_started' => 'Le concours n\'a pas encore commencé.',
        'ended' => 'Le concours est terminé.',
        'results_available' => 'Les résultats sont maintenant disponibles.',
        'results_not_yet' => 'Les résultats ne sont pas encore disponibles.',
    ],

];
