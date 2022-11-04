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
  .form2{
    margin-top:15px;
    margin-left:20px;
    overflow: auto;
  white-space: nowrap;
  
  }
  .table{
    margin:10px;
  }
  .table th{
  color: #2baa4b;
  font-size:20px;
  }
  
</style>
@stop

@section('page-header')
User id update<small>{{ trans('app.manage') }}</small>
@stop

@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b> PC user update<b></h3>


      </div>


      <!-- /.box-header -->

      <div class="form" style="margin-top:15px">
        <form action="{{ route(ADMIN.'.pcuser.store') }}" method="post">
          {{ csrf_field() }}


          <span class="border border-success"></span>

          <div class="form-group">
            <input class="left" type="id" name="user_id" class="form-control" placeholder="user id">
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