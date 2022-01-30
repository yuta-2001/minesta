<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'post_photo',
        'caption',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes() 
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Public function likedBy($user)
    // {
    //     return Like::where('user_id', $user->id)->where('post_id', $this->id);
    // }
}
