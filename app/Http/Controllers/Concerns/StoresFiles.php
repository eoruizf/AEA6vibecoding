<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait StoresFiles
{
    protected function storeFiles(Request $request, string $field, string $dir): array
    {
        $paths = [];
        foreach ((array) $request->file($field, []) as $file) {
            $paths[] = $file->store($dir, 'public');
        }

        return $paths;
    }

    protected function deleteFiles(array|string|null $paths): void
    {
        foreach ((array) $paths as $path) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}