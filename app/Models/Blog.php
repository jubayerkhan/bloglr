<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    protected $fillable = ['title', 'author', 'description', 'image', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function scopeSearch($query, $term){
        if($term){
            $term = "%$term%";
            $query->where('title', 'like', $term)
                  ->orWhere('author', 'like', $term);
        }
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'blog_user_likes')->withTimestamps();
    }
}


