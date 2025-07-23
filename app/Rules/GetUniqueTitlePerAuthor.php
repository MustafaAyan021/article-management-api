<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetUniqueTitlePerAuthor implements ValidationRule
{
    public function __construct(
        protected int $authorId,
        protected ?int $articleId = null
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table('articles')
            ->where('author_id', $this->authorId)
            ->where('title', $value);

        if ($this->articleId) {
            $query->whereNot('id', $this->articleId);
        }

        if ($query->exists()) {
            $fail('An Article With This Title Already Exists In Your Articles');
        }
    }
}
