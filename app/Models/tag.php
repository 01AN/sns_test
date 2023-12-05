<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;
    
    public function tweets()
    {
        return $this->belongsToMany('App\Models\Tweet')->withTimestamps(); 
    }

    public function getTag(Int $tweet_id)
    {
        return $this->with('user')->where('id', $tweet_id)->first();
    }

}
