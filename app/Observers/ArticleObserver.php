<?php

namespace App\Observers;

use App\Models\Article;
use App\Traits\SlugGenerator;

class ArticleObserver
{
    use SlugGenerator;
    /**
     * Handle the Article "created" event.
     */
    public function creating(Article $article): void
    {
        $article->slug = $this->slugGenerator($article->title);
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updating(Article $article): void
    {
        if ($article->isDirty('title')) {
            $article->slug = $this->slugGenerator($article->title);
        }
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleting(Article $article)
    {
        return $article->tags()->delete();
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }
}
