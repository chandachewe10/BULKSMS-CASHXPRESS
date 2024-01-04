<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name' ,
        'user_id',
        'phone',
        'email',
        'address',
        'company', 
        'nationality',
        'user_id',
        'tag'            
    ];
}


