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

    public function full_name()
    {
        if($this->middle_name === null || $this->middle_name === '') {
            return $this->first_name . ' ' . $this->last_name;
        } else {
            return $this->first_name . ' ' . substr($this->middle_name, 0, 1) . '. ' . $this->last_name;
        }
    }

    public function account_info()
    {
        return $this->hasOne('App\Accounts', 'user_id', 'id');
    }
}
