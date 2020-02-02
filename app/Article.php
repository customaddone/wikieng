<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        // fillableちゃんと入れる
        'title', 'user_id', 'article', 'summary', 'status'
    ];
}
