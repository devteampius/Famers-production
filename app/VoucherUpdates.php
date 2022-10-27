<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherUpdates extends Model
{
    //
    protected $fillable = ['vou_number', 'old_paid_status', 'old_paid_amt','userid','db_status','old_paid_date'];
}
