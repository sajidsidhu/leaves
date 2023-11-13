<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use PDF;
use Illuminate\Http\Request;
use App\Models\LeavesAvailed;
use App\Models\LeavesBalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PdfExportController extends Controller
{
    
    
    public function monthList(){
        $years = LeavesAvailed::select(DB::raw("Year(leave_date) as year"))->groupBy(DB::raw('year(`leave_date`)'))->get();
        return view('admin.export_form',compact('years'));    
    }



    public function generatePDF(Request $request)
    {
         $data['availed'] = LeavesAvailed::where('emp_id',"GB125840")->where(DB::raw("date_format(leave_date,'%Y-%c')"),$request->year."-".$request->month)->groupByRaw("emp_id,date_format(leave_date,'%Y-%c-%d')")->get();
        $data['balance'] = $balance = LeavesBalance::where(["year"=>$request->year,["name","<>",null],["region","<>",null]])->first();
        $pdf = PDF::loadView('admin.pdf.report', $data)->setPaper('a4', 'landscape');
        
        $userFolder = storage_path("export/" . now()->format('Y-m-d'));
        File::makeDirectory($userFolder, 0755, true, true);
        $pdf->save($userFolder .'/'. trim($balance->emp_id).'-report.pdf');
        return "ok";
        return view('admin.pdf.report',$data);
        return $data['b'] = LeavesBalance::where(['emp_id'=>"GA080222","year"=>"2023"])->last();
    
    
        
        
        $balance = LeavesBalance::where(["year"=>$request->year])->count();
        if(!$balance){
            return redirect()->back()->with('error',"Leave balance Sheet is not uploaded for ({$request->year}) year");
        }
        $availed = LeavesAvailed::select(DB::raw("date_format(leave_date,'%Y-%c')"))->where(DB::raw("date_format(leave_date,'%Y-%c')"),$request->year."-".$request->month)->count();
        if(!$availed){
            return redirect()->back()->with('error',"Leave availed Sheet is not uploaded for ({$request->month}) month");
        }
        $pdf = PDF::loadView('pdf.view', $data);
        
        $userFolder = "storage/app/public/users/{$user->name}/" . now()->format('Y-m-d');
        File::makeDirectory($userFolder, 0755, true, true);
        $pdf->save($userFolder . '/report.pdf');
        
        return redirect()->back()->with('message', 'PDF generated successfully for ' . $user->name);
    }


    //
}
