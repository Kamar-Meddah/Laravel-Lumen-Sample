<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'post_id', 'created_at','path'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }

}
