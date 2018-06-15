<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrators extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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

    public function account_info()
    {
        return $this->hasOne('App\Accounts', 'user_id', 'id');
    }
}
