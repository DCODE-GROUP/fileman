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
            Route::get('folder/{parent}/file/create', 'FileController@create')->name('file.create');
            Route::post('folder/{parent}/file', 'FileController@store')->name('file.store');

            Route::get('folder/{parent}/create', 'FolderController@create')->name('folder.create');
            Route::post('folder/{parent}', 'FolderController@store')->name('folder.store');

            Route::get('folder/{folder?}', 'FolderController@index')->name('folder.index');
        });
    }
}