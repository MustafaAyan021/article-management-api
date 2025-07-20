<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'status',
        'metadata',
        'author_id',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array'
        ];
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Str::title($value),
        );
    }

    protected function summary(): Attribute
    {
      return Attribute::make(
        get: fn() => Str::limit($this->content, 50),
      );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seoSetting(){
        return $this->hasOne(ArticleSeoSetting::class);
    }

    public function comments(){
        return $this->hasMany(ArticleComment::class);
    }

    public function tags(){
        return $this->morphMany(Tag::class, 'tagable');
    }
}
