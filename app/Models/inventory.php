<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
    ];
}