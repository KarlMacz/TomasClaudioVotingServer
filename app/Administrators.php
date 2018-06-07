<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
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

    public function account()
    {
        return $this->hasOne('App\Accounts', 'user_id', 'id');
    }
}
