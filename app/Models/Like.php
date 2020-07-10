<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likeable';
    protected $fillable = ['user_id'];

    # полиморфная связь для нескольких моделей
    public function likeable()
    {
        return $this->morphTo();
    }
    # чей лайк
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
