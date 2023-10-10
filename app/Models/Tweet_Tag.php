<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet_Tag extends Model
{
    use HasFactory;

    //
    public function tweetTag()
    {
        return User::find($this->user);
    }

}
