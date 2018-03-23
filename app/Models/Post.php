<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'content', 'category_id', 'slug','updated_at'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id')->select(['id','title','slug']);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select(['username','id']);
    }


}
