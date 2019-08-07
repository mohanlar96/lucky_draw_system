<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrizeType extends Model
{
    public function admin()
    {
        return $this->hasOne('App\User','id','admin_id');
    }
    public function ticket()
    {
        return $this->hasOne('App\UserTicket','number','winning_number');
    }
}
