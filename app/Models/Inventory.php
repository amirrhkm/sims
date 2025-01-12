<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BorrowingRequest;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'category',
    ];


    public function isAvailable()
    {
        return $this->quantity > 0;
    }

    public function getTotalQuantityAttribute()
    {
        $borrowedQuantity = BorrowingRequest::where('status', 'approved')
            ->get()
            ->flatMap(function ($request) {
                return $request->formatted_items;
            })
            ->where('name', $this->name)
            ->sum('quantity');

        return $this->quantity + $borrowedQuantity;
    }
}
