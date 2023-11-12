<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\LeavesAvailed;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class EmpLeaveAvailed implements ToModel,SkipsOnError, SkipsEmptyRows,WithCalculatedFormulas
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }


    public function model(Array $row){
        Log::info(
            'data',
            $row
        );

        return new LeavesAvailed([
            'emp_id' => $row[0],
            'name' => $row[1],
            'type' => $row[2],
            'action' => $row[3],
            'leave_date' =>  Carbon::create(1900, 1, 1)->addDays(((int)$row[4]) - 2),
            'debit' => $row[5],
            'count' => $row[6]
        ]);
    
    }
      /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        Log::error($e->getMessage());
    }
}
