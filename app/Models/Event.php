<?php

namespace App\Models;

use App\Models\Concerns\HasInteractions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory, HasInteractions;

    public const STATUSES = ['published' => 'Publicado', 'cancelled' => 'Cancelado'];

    protected $fillable = [
        'user_id', 'title', 'description', 'starts_at', 'ends_at', 'location_name',
        'address', 'city', 'latitude', 'longitude', 'price', 'max_attendees', 'image', 'status',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at'   => 'datetime',
            'price'     => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUpcoming(Builder $q): void
    {
        $q->where('starts_at', '>=', now());
    }

    public function scopePast(Builder $q): void
    {
        $q->where('starts_at', '<', now());
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function getIsPastAttribute(): bool
    {
        return $this->starts_at->isPast();
    }

    public function getIsFreeAttribute(): bool
    {
        return ! $this->price || (float) $this->price == 0.0;
    }

    public function getIsCancelledAttribute(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->title;
    }

    public function getShowUrlAttribute(): string
    {
        return route('events.show', $this);
    }
}