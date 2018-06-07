<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accounts extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user_info()
    {
        if($this->type === 'Administrator') {
            return $this->belongsTo('App\Administrators', 'user_id', 'id');
        } else {
            return $this->belongsTo('App\Students', 'user_id', 'id');
        }
    }
}
