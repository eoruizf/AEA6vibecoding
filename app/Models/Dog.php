<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Dog extends Model
{
    use HasFactory;

    public const SEX_MALE   = 'male';
    public const SEX_FEMALE = 'female';
    public const SEXES = [self::SEX_MALE, self::SEX_FEMALE];

    protected $fillable = [
        'user_id', 'name', 'description', 'date_of_birth', 'breed',
        'sex', 'weight', 'photos', 'is_neutered', 'color', 'microchip_number',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'weight'        => 'decimal:2',
            'photos'        => 'array',
            'is_neutered'   => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlsAttribute(): array
    {
        return collect($this->photos ?? [])
            ->map(fn ($path) => Storage::disk('public')->url($path))
            ->all();
    }


    public function getSexLabelAttribute(): string
    {
        return $this->sex === self::SEX_MALE ? 'Macho' : 'Hembra';
    }

    public function getAgeAttribute(): ?string
    {
        if (! $this->date_of_birth) {
            return null;
        }
        $d = $this->date_of_birth->diff(now());

        return $d->y > 0
            ? $d->y . ($d->y === 1 ? ' año' : ' años')
            : $d->m . ($d->m === 1 ? ' mes' : ' meses');
    }
}