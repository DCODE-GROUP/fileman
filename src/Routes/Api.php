<?php

namespace DcodeGroup\Fileman\Routes;

use DcodeGroup\Fileman\Http\Controllers\Api\FileController;
use DcodeGroup\Fileman\Http\Controllers\Api\FolderController;
use DcodeGroup\Fileman\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

class Api
{
    public static function get(): void
    {
        Route::group([
            'as' => config('fileman.api_route_name').'.',
        ], function () {
            // files
            Route::put('/'.config('fileman.api_route_path').'/folder/{parent}/file/{file}', [FileController::class, 'update'])->name('file.update');
            Route::get('/'.config('fileman.api_route_path').'/folder/{parent}/search', SearchController::class)->name('file.search');
            Route::delete('/'.config('fileman.api_route_path').'/folder/{parent}/file/{file}', [FileController::class, 'destroy'])->name('file.destroy');
            // folders
            Route::post('/'.config('fileman.api_route_path').'/folder/{parent}/folder', [FolderController::class, 'store'])->name('folder.store');
            Route::put('/'.config('fileman.api_route_path').'/folder/{folder}', [FolderController::class, 'update'])->name('folder.update');
            Route::delete('/'.config('fileman.api_route_path').'/folder/{folder}', [FolderController::class, 'destroy'])->name('folder.destroy');
        });
    }
}
