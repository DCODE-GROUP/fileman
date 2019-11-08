<?php

namespace DcodeGroup\FileMan;

use Illuminate\Support\Facades\Route;

class Helper
{
    public static function routes()
    {
        Route::group([
            'as' => 'file-man.',
            'namespace' => '\DcodeGroup\FileMan\Http\Controllers',
        ], function () {
            Route::get('folder/sync', 'FolderController@sync')->name('folder.sync');
            Route::resource('folder', 'FolderController');
            Route::resource('file', 'FileController')->except('index');
        });
    }
}