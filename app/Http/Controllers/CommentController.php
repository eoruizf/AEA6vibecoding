<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ResolvesInteractable;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    use ResolvesInteractable;

    public function store(Request $request, string $type, int $id): RedirectResponse
    {
        $data = $request->validate([
            'body' => ['required', 'string', 'max:1000'],
        ]);

        $model = $this->resolveInteractable($type, $id);
        $model->comments()->create(['user_id' => $request->user()->id, 'body' => $data['body']]);

        return back()->with('success', 'Comentario publicado.')->withFragment('comments');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comentario eliminado.')->withFragment('comments');
    }
}