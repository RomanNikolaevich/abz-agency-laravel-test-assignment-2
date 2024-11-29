<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Defaults
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default number of items per page when paginating
    | results. This value can be used throughout your application to maintain
    | consistency, and can be easily adjusted if you need to change the default.
    |
    */

    'default_users_per_page' => env('PAGINATION_DEFAULT_USERS_PER_PAGE', 6),

];
