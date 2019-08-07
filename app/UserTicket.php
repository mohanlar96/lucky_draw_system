<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    protected $fillable=['number','user_id'];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
