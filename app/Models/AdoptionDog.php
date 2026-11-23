<?php

namespace App\Models;

use App\Models\Concerns\HasInteractions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AdoptionDog extends Model
{
    use HasFactory, HasInteractions;

    public const SEXES = ['male' => 'Macho', 'female' => 'Hembra'];
    public const SIZES = ['small' => 'Pequeño', 'medium' => 'Mediano', 'large' => 'Grande'];
    public const STATUSES = ['available' => 'Disponible', 'reserved' => 'Reservado', 'adopted' => 'Adoptado'];

    protected $fillable = [
        'user_id', 'name', 'description', 'date_of_birth', 'breed', 'sex', 'size',
        'weight', 'color', 'city', 'is_neutered', 'is_vaccinated', 'is_microchipped',
        'good_with_kids', 'good_with_dogs', 'adoption_requirements', 'status', 'photos',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth'   => 'date',
            'weight'          => 'decimal:2',
            'photos'          => 'array',
            'is_neutered'     => 'boolean',
            'is_vaccinated'   => 'boolean',
            'is_microchipped' => 'boolean',
            'good_with_kids'  => 'boolean',
            'good_with_dogs'  => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlsAttribute(): array
    {
        return collect($this->photos ?? [])
            ->map(fn ($p) => Storage::disk('public')->url($p))
            ->all();
    }

    public function getSexLabelAttribute(): string
    {
        return self::SEXES[$this->sex] ?? $this->sex;
    }

    public function getSizeLabelAttribute(): ?string
    {
        return $this->size ? (self::SIZES[$this->size] ?? $this->size) : null;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getStatusClassAttribute(): string
    {
        return ['available' => 'badge-ok', 'reserved' => 'badge-warn', 'adopted' => 'badge-off'][$this->status] ?? '';
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

    // Li kat-st3mlo "Favoritos" w ay page mshtaraka
    public function getDisplayTitleAttribute(): string
    {
        return $this->name;
    }

    public function getShowUrlAttribute(): string
    {
        return route('adoption-dogs.show', $this);
    }
}