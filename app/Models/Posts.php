<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'image',
    ]; 

    public function comments()
{
    return $this->hasMany(\App\Models\Comment::class, 'blog_id')->orderBy('blog_comment.id', 'desc');
    
}

}
