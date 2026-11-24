<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Concerns\HasInteractions;

class VeterinaryCenter extends Model
{
    use HasFactory, HasInteractions;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'latitude',
        'longitude',
        'image',
        'phone',
        'email',
        'website',
        'opening_hours',
        'services',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'services' => 'array',
        ];
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function getDisplayTitleAttribute(): string
    {
        return $this->name;
    }

    public function getShowUrlAttribute(): string
    {
        return route('veterinary-centers.show', $this);
    }
}
