<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treads extends Model
{

    protected $guarded = [];
   /* public function scopeWithtread($query)
    {
        return $query->with('tread')->where('status', '==',  1);
    }*/

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
/*
    public function commentUser()
    {
        return $this->belongsTo(User::class);
    }*/
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id')->where('status', '1');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, CategoryTread::class, 'tread_id', 'cat_id', 'id');
    }


    public function commentsCount()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status', '1');
    }
}
