<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset_code extends Model
{
    //user type: applicant,admin,company; status: invalid, valid
    protected $fillable = ['ref_id','user_type','status','code'];
}
