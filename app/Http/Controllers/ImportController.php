<?php

namespace App\Http\Controllers;

use App\Jobs\ImporLeaveAvailedJob;
use App\Jobs\ImportLeaveBalanceJob;
use Illuminate\Http\Request;
use view;

class ImportController extends Controller
{
    public function importBalanceSheetForm()
    {
        return view('admin.import_balance_sheet'); //Excel::import(new EmpLeaveBalance, request()->file('balance_sheet'));
    }

    public function importAvailedSheetForm()
    {
        return view('admin.leave_availed_sheet'); //Excel::import(new EmpLeaveBalance, request()->file('balance_sheet'));
    }

    public function importBalanceSheet(Request $request)
    {
        if (request()->file('balance_sheet')) {
            $path = $request->balance_sheet->store('uploads');
            ImportLeaveBalanceJob::dispatch($path, $request->year);
            return back()->with('status', "Balance Sheet is being process to import");
        } elseif ($request->file('leave_availed')) {
            $path = $request->leave_availed->store('uploads');
            ImporLeaveAvailedJob::dispatch($path);
            return back()->with('status', "Availed Leave Sheet is being process to import");
        }
        return back()->with('error', "No Sheet Selected to Upload");
    }
}
