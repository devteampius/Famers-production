<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoiceline extends Model
{
    //
    protected $fillable = ['from_invoice_dt', 'to_invoice_dt', 'userid', 'db_status'];
}
