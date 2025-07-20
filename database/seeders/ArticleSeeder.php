<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleSeoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory(20)->create();
        ArticleSeoSetting::factory(20)->create();
    }
}
