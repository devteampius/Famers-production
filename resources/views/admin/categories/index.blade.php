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

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Updated Voucher number's<b></h3>


      </div>

<div class="form2" style="margin-bottom:15px">
        <form action="{{ route(ADMIN.'.categories.store') }}" method="post">
          {{ csrf_field() }}

          <span class="border border-success"></span>
          <div class="table-responsive" style="overflow-x:scroll !important;">

<table class="table">
<tr>
<th>Si.no</th>
<th>Voucher number</th>
<th>Status</th>
<th>Updated by</th>
<th>Updated at</th>
<th>Action</th>
</tr>
@foreach ($items as $r)
<tr>
<td>{{$r->id}}</td>
<td>{{$r->vou_number}}</td>
<td>{{$r->db_status}}</td>
<td>{{$r->name}}</td>
<td>{{$r->updated_at}}</td>
<td>
<a href="{{  route(ADMIN.'.categories.edit',$r->id) }}" class="btn btn-success">Edit</a>
<a href="{{  route(ADMIN.'.categories.edit',$r->cm_paid_status) }}" class="btn btn-primary">view</a>
</td>
</tr>
@endforeach
</table>
</div>
{{ $items->links()}}
</div>
</form>
@stop