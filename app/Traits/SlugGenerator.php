<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait SlugGenerator  {
    public function slugGenerator($value){
        return Str::slug($value);
    }
}