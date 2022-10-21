@extends('admin.adminlayout')

@section('page-header')
    Dashboard <small>Home</small>
@stop

@section('content')

    <div class="row" >
        <div class="col-md-12">
            <div class="panel panel-default"  >
                <div class="panel-body" >
                    Welcome {{ Auth::user()->name }} !!!
                </div>
            </div>
        </div>
    </div>

<!-- 
<div class="small-box bg-gradient-success">
  <div class="inner">
  
    <h2>Voucher Update</h2>
  </div>
  <div class="icon">
    <i class="fas fa-user-plus"></i>
  </div>
 <a href="{{ route(ADMIN.'.categories.index') }}" class="small-box-footer">
    More info <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
  </a>
</div> -->
<div class="row">

<div class="col-lg-3 col-6">

<div class="small-box bg-primary text-black">
<div class="inner">
<h3>Voucher</h3>
<h4>update</h4>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="{{ route(ADMIN.'.categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>
</div>



<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>Hang Up</h3>
<h4>allocation</h4>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
</div>
</div>
</div>


 


@stop
