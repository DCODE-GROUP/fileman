<?php

namespace DcodeGroup\Fileman\Routes;

use DcodeGroup\Fileman\Http\Controllers\FileController;
use DcodeGroup\Fileman\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

class Web
{
    public static function get()
    {
        Route::group([
            'as' => config('fileman.route_name').'.',
        ], function () {
            /*
             * Files
             */
            Route::post('/'.config('fileman.route_path').'/folder/{parent}/file', [FileController::class, 'store'])->name('file.store');
            Route::get('/'.config('fileman.route_path').'/folder/{parent}/file/create', [FileController::class, 'create'])->name('file.create');
            Route::get('/'.config('fileman.route_path').'/folder/{parent}/file/{file}', [FileController::class, 'show'])->name('file.show');
            Route::put('/'.config('fileman.route_path').'/folder/{parent}/file/{file}', [FileController::class, 'update'])->name('file.update');
            Route::delete('/'.config('fileman.route_path').'/folder/{parent}/file/{file}', [FileController::class, 'destroy'])->name('file.destroy');
            Route::get('/'.config('fileman.route_path').'/folder/{parent}/file/{file}/edit', [FileController::class, 'edit'])->name('file.edit');

            /*
             * Folders
             */
            Route::post('/'.config('fileman.route_path').'/folder/{parent}', [FolderController::class, 'store'])->name('folder.store');
            Route::get('/'.config('fileman.route_path').'/folder/{parent}/create', [FolderController::class, 'create'])->name('folder.create');
            Route::put('/'.config('fileman.route_path').'/folder/{parent}/{folder}', [FolderController::class, 'update'])->name('folder.update');
            Route::delete('/'.config('fileman.route_path').'/folder/{parent}/{folder}', [FolderController::class, 'destroy'])->name('folder.destroy');
            Route::get('/'.config('fileman.route_path').'/folder/{parent}/{folder}/edit', [FolderController::class, 'edit'])->name('folder.edit');
            Route::get('/'.config('fileman.route_path').'/folder/{folder?}', [FolderController::class, 'index'])->name('folder.index');
        });
    }
}
