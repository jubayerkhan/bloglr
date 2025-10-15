<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'author', 'description', 'image', 'user_id'];

    public function user()
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
}


