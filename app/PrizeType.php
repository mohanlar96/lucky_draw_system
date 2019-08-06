<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrizeType extends Model
{
    public function admin()
    {
        return $this->hasOne('App\User','user_id','id');
    }
    public function user()
    {
        return $this->hasOne('App\User','number','winning_number');
    }
}
