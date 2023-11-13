<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;

use App\Jobs\GeneratePDFJob;
use App\Models\LeavesAvailed;
use App\Models\LeavesBalance;
use App\Models\ZipFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PdfExportController extends Controller
{

    public function monthList()
    {
        $directory = storage_path('zipped'); // Replace with the path to your directory
        $files = ZipFile::orderBy('id','desc')->paginate(10);
        $years = LeavesAvailed::select(DB::raw("Year(leave_date) as year"))->groupBy(DB::raw('year(`leave_date`)'))->get();
        return view('admin.export_form', compact('years','files'));
    }

    public function generatePDF(Request $request)
    {
        $balance = LeavesBalance::where(["year" => $request->year])->count();
        if (!$balance) {
            return redirect()->back()->with('error', "Leave balance Sheet is not uploaded for ({$request->year}) year");
        }
        $availed = LeavesAvailed::select(DB::raw("date_format(leave_date,'%Y-%c')"))->where(DB::raw("date_format(leave_date,'%Y-%c')"), $request->year . "-" . $request->month)->count();
        if (!$availed) {
            return redirect()->back()->with('error', "Leave availed Sheet is not uploaded for ({$request->month}) month");
        }
        dispatch(new GeneratePDFJob($request->year, $request->month));

        return redirect()->back()->with('success', 'PDFs are generating');
    }




    public function downloadList()
    {
        $files = ZipFile::orderBy('id','desc')->paginate(10);
        return view('admin.download_list', compact('files'));
    }

    public function zipDownload($path)
    {
        $file = storage_path('zipped/' . $path); // Replace with the path to your directory

        if (File::exists($file)) {
            return response()->download($file);
        } else {
            return redirect()->back()->with('error',"No File Exist");
        }
    }
}
