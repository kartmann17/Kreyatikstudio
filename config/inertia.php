<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Side Rendering
    |--------------------------------------------------------------------------
    |
    | These options configures if and how Inertia uses Server Side Rendering
    | to pre-render the initial visits made to your application's pages.
    |
    | You can specify a custom SSR bundle path, or use a function that
    | returns the bundle path based on the current request.
    |
    | Do note that enabling these options will NOT automatically make SSR work,
    | as a separate build process is needed to generate the SSR bundle.
    |
    */

    'ssr' => [

        'enabled' => true,

        'url' => 'http://127.0.0.1:13714/render',

    ],

    /*
    |--------------------------------------------------------------------------
    | Testing
    |--------------------------------------------------------------------------
    |
    | When running tests, Inertia will use a mock implementation that
    | does not make any HTTP requests. This is useful when testing
    | your application's responses without having to worry about
    | the Inertia response structure.
    |
    */

    'testing' => [

        'ensure_pages_exist' => true,

        'page_paths' => [

            resource_path('js/Pages'),

        ],

    ],

];
