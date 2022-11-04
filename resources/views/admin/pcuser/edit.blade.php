@extends('admin.adminlayout')

@section('page-header')
Pc user<small>update ({{'$item->user_id'}})</small>
@stop

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Farmers Producation Pc user update - {{$item->user_id}}<b></h3>
      </div>



      <form action="{{ route(ADMIN.'.pcuser.update',$item->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body" style="margin:10px;">

          <span class="border border-success"></span>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>User id</label>
                <input disabled name="user_id" value="{{$item->user_id}}" class="form-control" placeholder="user id">
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>First name (old) </label>
                <input value="{{$item->old_first_name}" class="form-control" disabled>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Middle name (old) </label>
                <input value="{{$item->old_goes_by_name}}" class="form-control" disabled>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>last name (old) </label>
                <input value="{{$item->old_last_name}}" class="form-control" disabled>
              </div>
            </div>


          </div>


          @if($item->db_status == 'verify')

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>First name (Rollback) </label>
      <input type="text" value="{{$item->rl_first_name}}" name="rl_first_name" class="form-control">
    </div>
  </div>



  <div class="col-md-4">
    <div class="form-group">
      <label>Middle name (Rollback) </label>
      <input type="text" value="{{$item->rl_goes_by_name}}" name="rl_goes_by_name" class="form-control">
    </div>
  </div>


  <div class="col-md-4">
    <div class="form-group">
      <label>Last name (Rollback) </label>
      <input type="text" value="{{$item->rl_last_name}}" name="rl_last_namee" class="form-control">
    </div>
  </div>


</div>
@endif


@stop