<?php

namespace DcodeGroup\FileMan;

use Illuminate\Support\Facades\Route;

class Routes
{
    public static function get()
    {
        Route::group([
            'as' => 'fileman.',
            'namespace' => '\DcodeGroup\FileMan\Http\Controllers',
        ], function () {
            Route::get('folder/{folder?}', 'FolderController@index')->name('folder.index');
            
//            Route::resource('folder', 'FolderController');
            Route::resource('file', 'FileController')->except('index');
        });
    }
}