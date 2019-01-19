<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DealuxeInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dealuxe:install {--force : Don\'t ask for confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for the app';

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
        if($this->option('force')){
            $this->proceed();
        }else{
            if($this->confirm('Are you sure to delete all current data and install the default one ?'))
            {
                $this->proceed();
            }
        }
    }

    private function proceed(){
        // storage link
        $this->callSilent('storage:link');
        // default images path
        $path = 'design/images/default';

        // delete default images in storage directory
        $successDelete = File::deleteDirectory(public_path("storage/{$path}"));

        if($successDelete){
            $this->info("\"storage/{$path}\" has been deleted successfully");
        }else{
            $this->error("failed to delete \"{$path}\"");
        }
        // copy the default images to storage directory
        $successCopy = File::copyDirectory(public_path($path), public_path("/storage/{$path}"));
        if($successCopy){
            $this->info("\"{$path}\" has been copied successfully");
        }else{
            $this->error("cannot copy \"{$path}\" to storage/\"{$path}\"");
        }

        $this->call('migrate:fresh');

        $this->call('db:seed');

        $this->info('Dummy Data Installed Successfully');
    }
}
