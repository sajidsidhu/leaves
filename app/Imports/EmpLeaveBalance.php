<?php

namespace App\Imports;

use App\Models\LeavesBalance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmpLeaveBalance implements ToModel, SkipsOnError, SkipsEmptyRows
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
        return new LeavesBalance([
            'emp_id' => $row[0],
            'name' => $row[1],
            'region' => $row[2], // Assuming you have a 'category_id' column in the Excel sheet
            'year' => $this->year,
            'coff' => $row[3],
            'el' => $row[4],
            'lwp' => $row[5],
            'rh' => $row[6],
            'sl' => $row[7],
            'wfh' => $row[8],
        ]);
    }

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
}
