<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
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

    public function votes()
    {
        return $this->hasMany('App\Votes', 'candidate_id', 'id');
    }

    public function student_info()
    {
        return $this->belongsTo('App\Students', 'student_id', 'id');
    }

    public function position_info()
    {
        return $this->belongsTo('App\Positions', 'position_id', 'id');
    }

    public function party_info()
    {
        return $this->belongsTo('App\Parties', 'party_id', 'id');
    }
}
