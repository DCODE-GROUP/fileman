<?php

namespace DcodeGroup\FileMan;

use Illuminate\Support\ServiceProvider;

class FileManServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/filemanager.php' => config_path('filemanager.php'),
            ], 'config');

            if (!class_exists('CreateFileManagerTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_filemanager_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_filemanager_tables.php'),
                ], 'migrations');
            }

        }

        $this->loadViewsFrom(__DIR__ . '/views', 'file-man');
    }

    /**
     * Register the API doc commands.
     *
     * @return void
     */
    public function register()
    {
    }
}