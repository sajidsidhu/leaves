<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavesAvailed extends Model
{
    public $table = "leavs_availed";
    
    use HasFactory;

    public $guarded = ["id"];
}
