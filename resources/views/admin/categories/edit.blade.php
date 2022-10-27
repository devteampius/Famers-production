@extends('admin.adminlayout')

@section('page-header')
Voucher <small>update ({{$item->vou_number}})</small>
@stop

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="box" style="border:1px solid #d2d6de;">

      <div class="box-header" style="background-color:#f5f5f5;border-bottom:1px solid #d2d6de;">
        <h3><b>Farmers Producation voucher update - {{$item->vou_number}}<b></h3>
      </div>






      <form action="{{ route(ADMIN.'.categories.update',$item->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="box-body" style="margin:10px;">

          <span class="border border-success"></span>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Number</label>
                <input disabled name="vou_number" value="{{$item->vou_number}}" class="form-control" placeholder="Voucher no">
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (old) </label>
                <input value="{{$item->old_paid_status}}" class="form-control" disabled>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Amount (old) </label>
                <input value="{{$item->old_paid_amt}}" class="form-control" disabled>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (old) </label>
                <input value="{{$item->old_paid_date}}" class="form-control" disabled>
              </div>
            </div>


          </div>


          @if($item->db_status == 'verify')

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_status}}" name="rl_paid_status" class="form-control">
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_date}}" name="rl_paid_date" class="form-control">
              </div>
            </div>


          </div>
          @endif


          @if($item->db_status == 'rollback')

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_status}}" disabled class="form-control">
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_date}}" disabled class="form-control">
              </div>
            </div>


          </div>


          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (Commit) </label>
                <input type="text" value="{{$item->cm_paid_status}}" name="cm_paid_status" class="form-control">
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (Commit) </label>
                <input type="text" value="{{$item->cm_paid_date}}" name="cm_paid_date" class="form-control">
              </div>
            </div>


          </div>
          @endif

          @if($item->db_status == 'commit')

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_status}}" disabled class="form-control">
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (Rollback) </label>
                <input type="text" value="{{$item->rl_paid_date}}" disabled class="form-control">
              </div>
            </div>


          </div>


          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Status (Commit) </label>
                <input type="text" value="{{$item->cm_paid_status}}" disabled class="form-control">
              </div>
            </div>



            <div class="col-md-4">
              <div class="form-group">
                <label>Voucher Payment Date (Commit) </label>
                <input type="text" value="{{$item->cm_paid_date}}" disabled class="form-control">
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