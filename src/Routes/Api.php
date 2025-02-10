<?php

namespace DcodeGroup\Fileman\Routes;

use DcodeGroup\Fileman\Http\Controllers\Api\FileController;
use DcodeGroup\Fileman\Http\Controllers\Api\FolderController;
use DcodeGroup\Fileman\Http\Controllers\Api\SearchController;
use Illuminate\Support\Facades\Route;

Route::put('folder/{parent}/file/{file}', [FileController::class, 'update'])->name('file.update');
Route::get('folder/{parent}/search', SearchController::class)->name('file.search');
Route::delete('folder/{parent}/file/{file}', [FileController::class, 'destroy'])->name('file.destroy');
// folders
Route::post('folder/{parent}/folder', [FolderController::class, 'store'])->name('folder.store');
Route::put('folder/{folder}', [FolderController::class, 'update'])->name('folder.update');
Route::delete('folder/{folder}', [FolderController::class, 'destroy'])->name('folder.destroy');
