@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 px-4">
                <form method="post" action="{{route('couponCreatePost')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label>Number of Codes</label>
                            <select name="size" class="form-control">
                                <option value="1">1</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Vendor</label>
                            <select name="vendor" class="form-control">
                                <?php $vendor = \App\Models\User::where('is_vendor', '1')->get(); ?>
                                @foreach($vendor as $row)
                                <option value="{{ $row->id }}">{{ $row->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-6">
                            <label>Plan</label>
                            <select name="plan" class="form-control">
                                @php $vendor = \App\Models\Plan::get(); @endphp
                                @foreach($vendor as $row)
                                <option value="{{ $row->id }}">{{ $row->name }} - ₦ {{number_format($row->amount, 2)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label>Prefix</label>
                            <input class="form-control" placeholder="Prefix" name="prefix">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-4">Generate Coupon</button>
                </form>

            </div>
            <!-- #END# Browser Usage -->
    </div>
@stop

@section('scripts')

@stop
