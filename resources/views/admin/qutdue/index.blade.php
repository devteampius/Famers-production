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
Hangup allocation <small></small>
@stop


@section('content')

<div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Quantity Due<b></h3>


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


          <div class="row">
  <div class="col-xs-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Updated Order number's<b></h3>


      </div>
      
      <div class="form2" style="margin-bottom:15px">
        <form action="{{ route(ADMIN.'.qutdue.store') }}" method="post">
          {{ csrf_field() }}

          <span class="border border-success"></span>
          <div class="table-responsive" style="overflow-x:scroll !important;">

<table class="table">
<tr>
<th>Si.no</th>
<th>Order number</th>
<th>Status</th>
<th>Updated by</th>
<th>Updated at</th>
<th>Action</th>
</tr>
@foreach ($items as $r)
<tr>
<td>{{$r->id}}</td>
<td>{{$r->order_no}}</td>
<td>{{$r->db_status}}</td>
<td>{{$r->name}}</td>
<td>{{$r->updated_at}}</td>
<td>


<a href="{{  route(ADMIN.'.qutdue.edit',$r->id),'db_status == verify' }}" class="btn btn-success">Edit</a>
<a href="{{  route(ADMIN.'.qutdue.edit',$r->id) }}" class="btn btn-primary">view</a>
</td>
</tr>
@endforeach
</table>
</div>
{{ $items->links()}}
</div>
</div>
<div>
<div>
</form>

@stop