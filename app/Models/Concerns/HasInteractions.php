<?php

namespace App\Models\Concerns;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasInteractions
{
    public static function bootHasInteractions(): void
    {
        // Mlli tms7 l-model, tms7 comments/likes/favorites dyalo
        static::deleting(function ($model) {
            $model->comments()->delete();
            $model->likes()->delete();
            $model->favorites()->delete();
        });
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Kay-jib counts + wach user dar like/favorite f query wa7da (bla N+1)
    public function scopeWithInteractions(Builder $query, ?User $user = null): void
    {
        $id = $user?->id ?? 0;

        $query->withCount(['likes', 'comments'])->withExists([
            'likes as liked_by_me'         => fn ($q) => $q->where('user_id', $id),
            'favorites as favorited_by_me' => fn ($q) => $q->where('user_id', $id),
        ]);
    }

    public function isLikedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }
        if (array_key_exists('liked_by_me', $this->attributes)) {
            return (bool) $this->attributes['liked_by_me'];
        }

        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }
        if (array_key_exists('favorited_by_me', $this->attributes)) {
            return (bool) $this->attributes['favorited_by_me'];
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function toggleLike(User $user): bool
    {
        $like = $this->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();

            return false;
        }
        $this->likes()->firstOrCreate(['user_id' => $user->id]);

        return true;
    }

    public function toggleFavorite(User $user): bool
    {
        $fav = $this->favorites()->where('user_id', $user->id)->first();
        if ($fav) {
            $fav->delete();

            return false;
        }
        $this->favorites()->firstOrCreate(['user_id' => $user->id]);

        return true;
    }
}