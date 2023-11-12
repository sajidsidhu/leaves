<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\LeavesAvailed;
use App\Models\LeavesBalance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmpLeaveAvailed implements ToModel, SkipsOnError, SkipsEmptyRows,SkipsOnFailure
{

    use Importable;

    private $year;

    public function __construct($year)
    {
        $this->year = $year;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

    }

    public function model(array $row)
    {
        Log::info('row',$row);
        return new LeavesAvailed([
            'emp_id' => $row[0],
            'name' => $row[1],
            'type' => $row[2],
            'action' => $row[3],
            'leave_date' =>  Carbon::create(1900, 1, 1)->addDays(((int)$row[4]) - 2),
            'debit' => (float)$row[5]
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required',
        ];
    }

            // return new LeavesAvailed([
            //     'emp_id' => $row[0],
            //     'name' => $row[1],
            //     'type' => $row[2],
            //     'action' => $row[3],
            //     'leave_date' =>  Carbon::create(1900, 1, 1)->addDays(((int)$row[4]) - 2),
            //     'debit' => (float)$row[5],
            //     'count' => $row[6]
            // ]);
    public function startRow(): int
    {
        return 3; // Skip the first two rows (start from the third row)
    }

     /**
     * @param \Throwable $e
     */
    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
    
    public function onFailure(Failure ...$failures)
    {
        
    }
}
