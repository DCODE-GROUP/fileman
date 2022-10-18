<?php

namespace DcodeGroup\Fileman\Commands;

use DcodeGroup\Fileman\Services\FilemanService;
use DcodeGroup\Fileman\Services\FolderService;
use Illuminate\Console\Command;

class ImportFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fileman:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import your files from an S3 Bucket';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bucketName = config('filesystems.disks.s3.bucket');
        $this->info("Please wait indexing bucket $bucketName...");
        FilemanService::import();
        $this->info("Import complete.");
    }
}
