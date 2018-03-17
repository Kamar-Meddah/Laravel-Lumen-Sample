<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'post_id', 'updated_at','path'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
