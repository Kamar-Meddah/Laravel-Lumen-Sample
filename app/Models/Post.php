<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'content', 'category_id', 'created_at','slug'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id');
    }

}
