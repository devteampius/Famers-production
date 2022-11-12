@extends('admin.adminlayout')



section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Trial balance<b></h3>


      </div>
      <div class="form" style="margin-top:15px">
        <form action="{{ route(ADMIN.'.qutdue.store') }}" method="post">
          {{ csrf_field() }}


          <span class="border border-success"></span>

          <div class="form-group">
            <input class="left" type="id" name=" order_no" class="form-control" placeholder="order number">
          </div>

          <div class="form-group">
            <button type="submit" class="verify bg-success">Verify</button>
          </div>
          </form>
          </div>
     
          </div>
          </div>
          </div>

          @stop