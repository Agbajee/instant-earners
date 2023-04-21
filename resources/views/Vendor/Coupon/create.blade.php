@extends('Layouts.admin')
@section('content')
    <div class="container-fluid">

        @if(\Session::has('info'))
            <div class="alert bg-green">
                {{\Session::get('info')}}
            </div>
        @endif


        @if(\Session::has('error2'))
             <div class="alert bg-red">
                  {{\Session::get('error2')}}
             </div>
        @endif

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Create New Coupon</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="the_sc">
                            <form method="post" action="{{route('couponCreatePost')}}">
                                @csrf
								<label>How Many do you want to generate ?</label>
								<select name="size" class="form-control">
									<option value="1">1</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="200">200</option>
									<option value="500">500</option>
									<option value="1000">1000</option>
								</select>
								<label>Vendor</label>
								<select name="vendor" class="form-control">
								    <?php $vendor = \App\Models\User::where('is_vendor', '1')->get(); ?>
								    @foreach($vendor as $row)
									<option value="{{ $row->id }}">{{ $row->username }}</option>
									@endforeach
								</select>
								<label>Prefix</label>
								<input class="form-control" placeholder="Prefix" name="prefix">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Generate Coupon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
@stop

@section('scripts')
@stop