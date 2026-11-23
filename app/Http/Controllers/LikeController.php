<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ResolvesInteractable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    use ResolvesInteractable;

    public function toggle(Request $request, string $type, int $id): RedirectResponse
    {
        $this->resolveInteractable($type, $id)->toggleLike($request->user());

        return back();
    }
}