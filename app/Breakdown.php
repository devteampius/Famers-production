<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    //
    protected $fillable = ['from_dt', 'to_dt', 'userid', 'db_status'];
}
