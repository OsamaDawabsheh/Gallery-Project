<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }

    public function avg()
    {
        return $this->hasOne(RateAvg::class);
    }


    public function comment()
    {
        return $this->hasMany(comment::class);
    }



    protected $fillable = [
        'title',
        'description',
        'position',
        'image_path',
        'state',
        'user_id'
    ];
}
