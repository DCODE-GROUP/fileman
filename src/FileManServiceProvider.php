<?php

namespace DcodeGroup\Fileman;

use DcodeGroup\Fileman\Commands\ImportFiles;
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

            $this->commands([
                ImportFiles::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/fileman.php' => config_path('fileman.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../dist/' => public_path('vendor/fileman'),
            ], 'styles');

            if (!class_exists('CreateFileManagerTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_filemanager_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_filemanager_tables.php'),
                ], 'migrations');
            }

        }

        $this->loadViewsFrom(__DIR__.'/resources/views', 'fileman');
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
