<?php

namespace DcodeGroup\Fileman;

use Illuminate\Support\Facades\Route;

class Routes
{
    public static function get()
    {
        Route::group([
            'as' => 'fileman.',
            'namespace' => '\DcodeGroup\Fileman\Http\Controllers',
        ], function () {
            Route::resource('folder', 'FolderController');
            Route::resource('file', 'FileController')->except('index');
        });
    }
}