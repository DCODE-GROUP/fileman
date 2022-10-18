<?php

namespace DcodeGroup\Fileman;

use DcodeGroup\Fileman\Http\Controllers\FileController;
use DcodeGroup\Fileman\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

class Routes
{
    public static function get()
    {
        Route::group([
            'as' => 'fileman.',
        ], function () {
            /*
             * Files
             */
            Route::post('folder/{parent}/file', [FileController::class, 'store'])->name('file.store');
            Route::get('folder/{parent}/file/create', [FileController::class, 'create'])->name('file.create');
            Route::get('folder/{parent}/file/{file}', [FileController::class, 'show'])->name('file.show');
            Route::put('folder/{parent}/file/{file}', [FileController::class, 'update'])->name('file.update');
            Route::delete('folder/{parent}/file/{file}', [FileController::class, 'destroy'])->name('file.destroy');
            Route::get('folder/{parent}/file/{file}/edit', [FileController::class, 'edit'])->name('file.edit');

            /*
             * Folders
             */
            Route::post('folder/{parent}', [FolderController::class, 'store'])->name('folder.store');
            Route::get('folder/{parent}/create', [FolderController::class, 'create'])->name('folder.create');
            Route::put('folder/{parent}/{folder}', [FolderController::class, 'update'])->name('folder.update');
            Route::delete('folder/{parent}/{folder}', [FolderController::class, 'destroy'])->name('folder.destroy');
            Route::get('folder/{parent}/{folder}/edit', [FolderController::class, 'edit'])->name('folder.edit');
            Route::get('folder/{folder?}', [FolderController::class, 'index'])->name('folder.index');
        });
    }
}