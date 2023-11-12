<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\EmpLeaveAvailed;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImporLeaveAvailedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $path;
    /**
     * Create a new job instance.
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new EmpLeaveAvailed(20), $this->path);
    }
}
