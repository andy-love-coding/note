<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 
    ];

    // 一个类目，拥有多篇文章
    public function articles()
    {
        // return $this->hasMany(Article::class);
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
