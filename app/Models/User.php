<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'username', 'email', 'token', 'role'
    ];
    protected $hidden = ['password', 'token', 'role', 'updated_at'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

}
