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
            /*
             * Files
             */
            Route::post('folder/{parent}/file', 'FileController@store')->name('file.store');
            Route::get('folder/{parent}/file/create', 'FileController@create')->name('file.create');
            Route::get('folder/{parent}/file/{file}', 'FileController@show')->name('file.show');
            Route::put('folder/{parent}/file/{file}', 'FileController@update')->name('file.update');
            Route::delete('folder/{parent}/file/{file}', 'FileController@destroy')->name('file.destroy');
            Route::get('folder/{parent}/file/{file}/edit', 'FileController@edit')->name('file.edit');

            /*
             * Folders
             */
            Route::post('folder/{parent}', 'FolderController@store')->name('folder.store');
            Route::get('folder/{parent}/create', 'FolderController@create')->name('folder.create');
            Route::put('folder/{parent}/{folder}', 'FolderController@update')->name('folder.update');
            Route::delete('folder/{parent}/{folder}', 'FolderController@destroy')->name('folder.destroy');
            Route::get('folder/{parent}/{folder}/edit', 'FolderController@edit')->name('folder.edit');
            Route::get('folder/{folder?}', 'FolderController@index')->name('folder.index');
        });
    }
}