<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Concerns\HasInteractions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

trait ResolvesInteractable
{
    // 'event' + 5 => Event #5 (ghir models li 3ndhom HasInteractions)
    protected function resolveInteractable(string $type, int $id): Model
    {
        $class = Relation::getMorphedModel($type);

        abort_unless($class && in_array(HasInteractions::class, class_uses_recursive($class)), 404);

        return $class::findOrFail($id);
    }
}