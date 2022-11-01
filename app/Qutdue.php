<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qutdue extends Model
{
    //
    protected $fillable = ['order_no', 'old_qty_due', 'userid'];
}
