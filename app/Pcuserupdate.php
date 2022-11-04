<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pcuserupdate extends Model
{
    //
    protected $fillable = ['user_id', 'old_first_name', 'old_goes_by_name','userid','db_status','old_last_name'];
}

