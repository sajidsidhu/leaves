<?php

namespace App\Jobs;

use ZipArchive;
use App\Models\ZipFile;
use Illuminate\Bus\Queueable;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateZipAndDownload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $folder_name;
    /**
     * Create a new job instance.
     */
    public function __construct($folder_name)
    {
        $this->folder_name = $folder_name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {       
        $folderToZip = $this->folder_name; // Replace with the path to your folder
        if (File::isDirectory($folderToZip)) {
            $zip = new ZipArchive();
            $userFolder = storage_path("zipped");
            File::makeDirectory($userFolder, 0755, true, true);
            $zipFileName = now()->format('Y-m-d-H-i-s').'.zip'; // Define the ZIP file name
                if ($zip->open("$userFolder/data-".$zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
                    // Create a recursive directory iterator
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($folderToZip),
                        RecursiveIteratorIterator::SELF_FIRST
                    );
        
                    foreach ($files as $file) {
                        if (!$file->isDir()) {
                            $filePath = $file->getRealPath();
                            $relativePath = substr($filePath, strlen($folderToZip) + 1);
                            $zip->addFile($filePath, $relativePath);
                        }
                    }
                    $zip->close();
                    ZipFile::create(['path' => "data-".$zipFileName]);
                }
            }else{
                Log::info("folder does not exist"); 
            }
    }
}
