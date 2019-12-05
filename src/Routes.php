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
            Route::get('folder/{folder?}', 'FolderController@index')->name('folder.index');
            Route::resource('folder', 'FolderController')->except('index');
            Route::resource('file', 'FileController')->except('index');
        });
    }
}