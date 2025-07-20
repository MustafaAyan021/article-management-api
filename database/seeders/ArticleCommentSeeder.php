<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleComment::factory(50)->create();
    }
}
