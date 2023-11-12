<?php

namespace App\Http\Controllers;

use App\Imports\EmpLeaveAvailed;
use view;
use Illuminate\Http\Request;
use App\Imports\EmpLeaveBalance;
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
        if(request()->file('balance_sheet')){
            Excel::import(new EmpLeaveBalance($request->year), request()->file('balance_sheet'));
            return back()->with('success',"Balance Sheet has been Upload");
        }elseif($request->file('leave_availed')){
            Excel::import(new EmpLeaveAvailed, request()->file('leave_availed'));
            return back()->with('success',"Availed Leave Sheet has been Upload");
        }
    }
}
