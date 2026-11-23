@props(['model'])
@php
    $user  = auth()->user();
    $type  = $model->getMorphClass();
    $likes = $model->likes_count ?? $model->likes()->count();
    $coms  = $model->comments_count ?? $model->comments()->count();
    $liked = $model->isLikedBy($user);
    $faved = $model->isFavoritedBy($user);
@endphp
<div class="row interactions">
    @auth
        <form method="POST" action="{{ route('likes.toggle', [$type, $model->id]) }}">
            @csrf
            <button class="btn {{ $liked ? '' : 'btn-outline' }}">{{ $liked ? '❤️' : '🤍' }} {{ $likes }}</button>
        </form>
        <form method="POST" action="{{ route('favorites.toggle', [$type, $model->id]) }}">
            @csrf
            <button class="btn {{ $faved ? '' : 'btn-outline' }}">{{ $faved ? '⭐ Guardado' : '☆ Guardar' }}</button>
        </form>
    @else
        <span class="muted">🤍 {{ $likes }}</span>
    @endauth
    <span class="muted">💬 {{ $coms }}</span>
</div>