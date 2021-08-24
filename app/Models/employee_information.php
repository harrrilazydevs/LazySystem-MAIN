<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee_information extends Model
{
    use HasFactory;

    public $table = 'employee_information';

    protected $fillable = [
        'fname'
    ];

  
}
