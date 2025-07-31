<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'blog_comment';

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    // Each comment belongs to a user (optional if guest)
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Each comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
