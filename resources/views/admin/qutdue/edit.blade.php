@extends('admin.adminlayout')

@section('page-header')
Voucher <small>update ({{$item->order_no}})</small>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b> Quantity Due- {{$item->order_no}}<b></h3>
      </div>
      </div>
      </div>
      </div>
      @stop