<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
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

    public function voter_info()
    {
        return $this->belongsTo('App\Accounts', 'account_id', 'id');
    }

    public function candidate_info()
    {
        return $this->belongsTo('App\Candidates', 'candidate_id', 'id');
    }
}
