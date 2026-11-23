@props(['model'])
@php $type = $model->getMorphClass(); @endphp
<div id="comments" style="margin-top:24px">
    <h3>Comentarios</h3>

    @auth
        <form method="POST" action="{{ route('comments.store', [$type, $model->id]) }}">
            @csrf
            <textarea name="body" rows="3" maxlength="1000" placeholder="Escribe un comentario..." required></textarea>
            <br><br>
            <button class="btn">Comentar</button>
        </form>
    @else
        <p class="muted"><a href="{{ route('login') }}">Inicia sesión</a> para comentar.</p>
    @endauth

    @forelse($model->comments()->with('user')->latest()->get() as $c)
        <div class="comment">
            <div class="row">
                <x-avatar :user="$c->user" :size="28" />
                <strong>{{ $c->user->name }}</strong>
                <span class="muted">{{ $c->created_at->diffForHumans() }}</span>
                @can('delete', $c)
                    <form method="POST" action="{{ route('comments.destroy', $c) }}" onsubmit="return confirm('¿Eliminar comentario?')" style="margin-left:auto">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger">Eliminar</button>
                    </form>
                @endcan
            </div>
            <p style="margin:6px 0 0">{{ $c->body }}</p>
        </div>
    @empty
        <p class="muted">Todavía no hay comentarios.</p>
    @endforelse
</div>