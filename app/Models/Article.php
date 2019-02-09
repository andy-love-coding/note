<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Paragraph;

class Article extends Model
{
    protected $fillable = [
        'title', 'category_id',
    ];

    // 一篇文章，拥有多个段落
    public function paragraphs()
    {
        // return $this->hasMany(Paragraph::class);
        return $this->hasMany(Paragraph::class, 'article_id', 'id');
    }
}
