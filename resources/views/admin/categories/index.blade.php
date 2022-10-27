@extends('admin.adminlayout')

@section('css')
<style>
  table.table .actions {
    width: 100px;
    text-align: center;
  }

  .bg-success {
    background-color: #80ac6f;
  }

  .left {
    background-color: #daebea;
  }

  .form {
    margin-left: 25px;
  }

  .commit {
    background-color: #2baa4b;
  }
</style>
@stop

@section('page-header')
Voucher <small>{{ trans('app.manage') }}</small>
@stop

@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Farmers Producation voucher update<b></h3>


      </div>


      <!-- /.box-header -->

      <div class="form" style="margin-top:15px">
        <form action="{{ route(ADMIN.'.categories.store') }}" method="post">
          {{ csrf_field() }}


          <span class="border border-success"></span>

          <div class="form-group">
            <input class="left" type="id" name="vou_number" class="form-control" placeholder="Voucher no">
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