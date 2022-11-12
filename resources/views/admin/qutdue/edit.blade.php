@extends('admin.adminlayout')

@section('page-header')
Quantity Due <small>update ({{$item->order_no}})</small>
@stop


@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b> Quantity Due- {{$item->order_no}}<b></h3>
      </div>
      
      


      <form action="{{ route(ADMIN.'.qutdue.update',$item->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body" style="margin:10px;">

          <span class="border border-success"></span>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>order Number</label>
                <input disabled name="order_no" value="{{$item->order_no}}" class="form-control" placeholder="Order no">
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Quantity Due (Before) </label>
                <input value="{{$item->old_qty_due}}" class="form-control" disabled>
              </div>
            </div>

</div>

@if($item->db_status == 'verify')

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Quantity Due (Rollback) </label>
      <input type="text" value="{{$item->rl_qty_due}}" name="rl_qty_due" class="form-control">
    </div>
  </div>
  </div>
          @endif

          @if($item->db_status == 'rollback')

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Quantity Due (Rollback) </label>
      <input type="text" value="{{$item->rl_qty_due}}" disabled class="form-control">
    </div>
  </div>


  </div>


<!-- <div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Quantity Due (Commit) </label>
      <input type="text" value="{{$item->cm_qty_due}}" name="cm_qty_due" class="form-control">
    </div>
  </div>

  </div> -->
          @endif


 
          @if($item->db_status == 'commit')

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Quantity Due (Rollback) </label>
      <input type="text" value="{{$item->rl_qty_due}}" readonly class="form-control">
    </div>
  </div>


  <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Quantity Due (Commit) </label>
                <input type="text" value="{{$item->rl_qty_due}}" readonly class="form-control">
              </div>
            </div>

            </div>
          @endif 



          </div>

<div class="box-footer" style="background-color:#f5f5f5;border-top:1px solid #d2d6de;">
  @if($item->db_status == 'verify')
  <button type="submit" class="btn btn-info" style="width:100px;">Do Rollback</button>
  @endif
  @if($item->db_status == 'rollback')
  <button type="submit" class="btn btn-info" style="width:100px;">Do Commit</button>
  @endif
</div>



</form>



</div>
</div>
</div>





          @stop