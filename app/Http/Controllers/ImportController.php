<?php

namespace App\Http\Controllers;

use view;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\LeavesAvailed;
use App\Imports\EmpLeaveAvailed;
use App\Imports\EmpLeaveBalance;
use App\Jobs\ImporLeaveAvailedJob;
use App\Jobs\ImportLeaveBalanceJob;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importBalanceSheetForm()
    {
        return view('admin.import_balance_sheet');//Excel::import(new EmpLeaveBalance, request()->file('balance_sheet'));
    }
    
    public function importAvailedSheetForm()
    {
        return view('admin.leave_availed_sheet');//Excel::import(new EmpLeaveBalance, request()->file('balance_sheet'));
    }

    public function importBalanceSheet(Request $request){
        // LeavesAvailed::create([
        //     'emp_id' => "name",
        //     'name' => "sa",
        //     'type' => "t",
        //     'action' => "ac",
        //     'leave_date' => "2023-10-12",
        //     'debit' => 0.5,
        //     'count' => 1
        // ]);
        // return Carbon::create(1900, 1, 1)->addDays(44944);
        if(request()->file('balance_sheet')){
            $path = $request->balance_sheet->store('uploads');
                ImportLeaveBalanceJob::dispatch($path,$request->year);
                //     Excel::import(new EmpLeaveBalance($request->year), request()->file('balance_sheet'));
                //     return back()->with('success',"Balance Sheet has been Upload");
            }elseif($request->file('leave_availed')){
                $path = $request->leave_availed->store('uploads');
                ImporLeaveAvailedJob::dispatch($path);
            // Excel::import(new EmpLeaveAvailed(20), request()->file('leave_availed'));
        //     return back()->with('success',"Availed Leave Sheet has been Upload");
        }
    }
}
