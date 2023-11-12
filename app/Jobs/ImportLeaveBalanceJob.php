<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\EmpLeaveBalance;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ImportLeaveBalanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $file_path;
    public $year;

    /**
     * Create a new job instance.
     */
    public function __construct($file_path,$year)
    {
        $this->file_path = $file_path;
        $this->year = $year;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Excel::import(new EmpLeaveBalance($this->year), $this->file_path);
        
    }
}
