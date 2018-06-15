<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parties extends Model
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

    public function candidates()
    {
        return $this->hasMany('App\Candidates', 'party_id', 'id');
    }
}
