@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendors</th>
                                    <th>All codes</th>
                                    <th>Un-Used</th>
                                    <th>Used</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @if(count($dd) > 0)
                                @foreach($dd as $ui)
                                @php
                                    $all= App\Models\CouponCodes::where('vendor_id', $ui->id)->count();
                                    $unused= App\Models\CouponCodes::where('vendor_id', $ui->id)->where('is_used', 0)->count();
                                    $used= App\Models\CouponCodes::where('vendor_id', $ui->id)->where('is_used', 1)->count();
                                    $used= App\Models\CouponCodes::where('vendor_id', $ui->id)->where('is_used', 1)->count();
                                @endphp
                                    <tr>
                                        <td width="5%">{{$counter++}}</td>
                                        <td>{{ $ui->username }}</td>
                                        <td>{{$all}}</td>
                                        <td>{{$unused}}</td>
                                        <td>{{$used}}</td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </div>
@stop

