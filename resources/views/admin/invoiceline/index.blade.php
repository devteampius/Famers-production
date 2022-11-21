@extends('admin.adminlayout')

@section('css')
<style>
.bg-success {
    background-color: #80ac6f;
}
.form{
    margin-left: 25px;
}    
.left{
    background-color: lightgray;
}
</style>
@stop
@section('page-header')
Invoice line count month wise <small></small>
@stop


@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Invoice line count month wise<b></h3>


      </div>


<div class="form" style="margin-top:15px">
        <form action="{{ route(ADMIN.'.invoiceline.store') }}" method="post">
          {{ csrf_field() }}


          <span class="border border-success"></span>

          <div class="form-group">
            <input class="left" type="id" name=" from_invoice_dt" class="form-control" placeholder="From">
          </div>

          <div class="form-group">
            <input class="left" type="id" name=" to_invoice_dt" class="form-control" placeholder="To">
          </div>

          <div class="form-group">
            <button type="submit" class="verify bg-success">Enter</button>
          </div>
          </form>
          </div>
          </div>
          </div>
          </div>
@stop