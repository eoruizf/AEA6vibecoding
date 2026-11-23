<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ResolvesInteractable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    use ResolvesInteractable;

    public function index(Request $request): View
    {
        $favorites = $request->user()->favorites()->with('favoritable')->latest()->get();

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Request $request, string $type, int $id): RedirectResponse
    {
        $this->resolveInteractable($type, $id)->toggleFavorite($request->user());

        return back();
    }
}