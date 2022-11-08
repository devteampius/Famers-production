@extends('admin.adminlayout')

@section('css')
  <style>
  table.table .actions {
      width: 100px;
      text-align: center;
  }
.bg-danger {
    background-color: #b53232;
}

.h4, h4 {
    font-size: 26px;
}




  </style>
@stop


@section('page-header')
    Hangup allocation <small>{{ trans('app.manage') }}</small>
@stop


@section('content')

	<div class="row">
	  <div class="col-xs-12">
	    <div class="box" style="border:1px solid #d2d6de;" >

	      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
          <h3><b>Hangup allocation<b></h3>
           
          </a>
	      </div>
<br>

	      <!-- /.box-header -->
	
       <div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-primary text-black">
<div class="inner">
<h5>Hangup allocation</h5>
<h4>Qty Due</h4>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="{{ route(ADMIN.'.qutdue.index') }}" class="small-box-footer"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>
</div>
 


       <div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-danger text-black">
<div class="inner">
<h5>Hangup allocation</h5>
<h4>unable to deallocate</h4>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="{{ route(ADMIN.'.hangupdeallocate.index') }}" class="small-box-footer"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>
</div>
</div>



@stop
