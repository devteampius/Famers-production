@extends('admin.adminlayout')

@section('css')
  <style>
  table.table .actions {
      width: 100px;
      text-align: center;
  }

.bg-success {
  background-color:#80ac6f;
}
.left{
  background-color:#daebea;
}

.form{
   margin-left: 25px;
}
.commit{
   background-color:#2baa4b;
}



  </style>
@stop

@section('page-header')
    Voucher <small>{{ trans('app.manage') }}</small>
@stop

@section('content')

	<div class="row">
	  <div class="col-xs-12">
	    <div class="box" style="border:1px solid #d2d6de;" >

	      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
          <h3><b>Farmers Producation voucher update<b></h3>
           
          </a>
	      </div>
<br>

	      <!-- /.box-header -->
	
        <div class="form">
 <form action="#">
      <input class="left" type="id" name="Voucher no" placeholder="Voucher no">
      <button class="verify bg-success">Verify</button>
      <span class="border border-success"></span>
    
      <br>
      <br>
      <input class="left" type="text" name="Date" placeholder="Voucher pay Date">
      <br>
      <br>
       <input class="left" type="text" name="name" placeholder="Payment Status">
       <br>
      <br>
      <button class="verify  bg-primary text-black">rollback tran</button>
       <br>
      <br>
      <button class="commit">commit tran</button>
      <br>
      <br>

@stop
