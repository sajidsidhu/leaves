<?php

namespace App\Jobs;

use PDF;
use App\Models\LeavesAvailed;
use App\Models\LeavesBalance;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GeneratePDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $year;
    public $month;
    /**
     * Create a new job instance.
     */
    public function __construct($year,$month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $employees = LeavesAvailed::where(DB::raw("date_format(leave_date,'%Y-%c')"),$this->year."-".$this->month)->groupByRaw("emp_id,date_format(leave_date,'%Y')")->get();
        foreach($employees as $emp){
            $data['availed'] = LeavesAvailed::where('emp_id',$emp->emp_id)->where(DB::raw("date_format(leave_date,'%Y-%c')"),$this->year."-".$this->month)->groupByRaw("date_format(leave_date,'%Y-%c-%d')")->get();
            $data['balance'] = LeavesBalance::where(["year"=>$this->year,"emp_id"=>$emp->emp_id])->first();
            $pdf = PDF::loadView('admin.pdf.report', $data)->setPaper('a4', 'landscape');
            $userFolder = storage_path("export/" . now()->format('Y-m-d'));
            File::makeDirectory($userFolder, 0755, true, true);
            $pdf->save($userFolder .'/'. trim($emp->emp_id).'-report.pdf');
        }
    }
}
