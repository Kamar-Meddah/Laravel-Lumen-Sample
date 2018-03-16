<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'content', 'post_id', 'updated_at'
    ];
    protected $hidden = [
        'created_at'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
