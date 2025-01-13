<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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

    /**
     * Get all activities for the borrowing request.
     */
    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    /**
     * Log an activity for this borrowing request.
     */
    public function logActivity(string $type, string $description, array $properties = []): void
    {
        $this->activities()->create([
            'type' => $type,
            'description' => $description,
            'causer_id' => auth()->id(),
            'properties' => $properties
        ]);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Log when a new borrowing request is created
        static::created(function ($borrowingRequest) {
            $borrowingRequest->logActivity(
                'borrowing_request_created',
                'New borrowing request submitted',
                ['items' => $borrowingRequest->items]
            );
        });

        // Log when the status is updated (e.g., approved)
        static::updated(function ($borrowingRequest) {
            if ($borrowingRequest->isDirty('status')) {
                $borrowingRequest->logActivity(
                    'borrowing_request_' . strtolower($borrowingRequest->status),
                    "Borrowing request {$borrowingRequest->status}",
                    [
                        'old_status' => $borrowingRequest->getOriginal('status'),
                        'new_status' => $borrowingRequest->status,
                    ]
                );
            }
        });
    }
}
