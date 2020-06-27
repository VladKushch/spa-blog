<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id',
    ];

    public function scopeUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id','DESC');
    }
}
