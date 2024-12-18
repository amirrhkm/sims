<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowingRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'items',
        'status',
        'remarks',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'items' => 'array',
        'status' => 'string',
        'remarks' => 'string',
    ];

    /**
     * Get the user that owns the borrowing request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted items with inventory details.
     *
     * @return array
     */
    public function getFormattedItemsAttribute(): array
    {
        $formattedItems = [];
        $items = is_string($this->items) ? json_decode($this->items, true) : $this->items;

        if (!is_array($items)) {
            return [];
        }

        foreach ($items as $item) {
            $inventory = Inventory::find($item['id']);
            if ($inventory) {
                $formattedItems[] = [
                    'name' => $inventory->name,
                    'quantity' => $item['quantity'],
                    'category' => $inventory->category,
                ];
            }
        }

        return $formattedItems;
    }

    /**
     * Scope a query to only include current user's requests.
     */
    public function scopeCurrentUser($query)
    {
        return $query->where('user_id', auth()->id());
    }

    /**
     * Check if the request is within valid date range.
     */
    public function isValidDateRange(): bool
    {
        return $this->start_time < $this->end_time;
    }
}
