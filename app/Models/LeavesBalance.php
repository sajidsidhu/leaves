<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesBalance extends Model
{
    use HasFactory;
    public $table = "leaves_balance";

    public $guarded = ['id'];
}
