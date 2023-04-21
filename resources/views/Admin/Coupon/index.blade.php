@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col">

        <div class="card card-modern">
            <div class="card-body">
                <div class="datatables-header-footer-wrapper">
                    <div class="datatable-header">
                        <div class="row align-items-center mb-3">
                            <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <a href="{{ url('/admin/coupon/create') }}" class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4">+ Add Coupon</a>
                            </div>

                            <div class="col-12 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                    <label class="ws-nowrap me-3 mb-0">General Stats:</label>
                                    <select class="form-control select-style-1 filter-by">
                                        <a href="{{ url('/admin/coupon') }}"><option selected>All({{$dd1->count()}})</option></a>
                                        <a href="{{ url('/admin/couponused/1') }}"><option>Used({{ $is_used->count() }})</option></a>
                                        <a href="{{ url('/admin/couponused/2') }}"><option>Un-Used({{$is_not_used->count()}})</option></a>
                                    </select>
                                </div>
                            </div>

                            <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                    <label class="ws-nowrap me-3 mb-0">Filter By:</label>
                                    <select class="form-control select-style-1 filter-by" name="filter-by">
                                        <option value="all" selected>All</option>
                                        <option value="1">S/N</option>
                                        <option value="2">Code</option>
                                        <option value="3">Plan</option>
                                        <option value="4">Status</option>
                                        <option value="5">Vendor </option>
                                        <option value="5">User</option>
                                        <option value="5">Referral</option>
                                        <option value="5">Created</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                    <label class="ws-nowrap me-3 mb-0">Show:</label>
                                    <select class="form-control select-style-1 results-per-page" name="results-per-page">
                                        <option value="12" selected>12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                <form id="selected_all" action="{{route('couponTrashSelected2')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selected">
                                    <button title="This will delete selected coupons" rel="tooltip" class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </div>

                            <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                <form id="selected_all" action="{{route('couponExportSelected')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selectedcoupon">
                                    <button class="btn btn-sm btn-info"  type="submit">Export</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">

                        <thead>
                            <tr>
                                <th width="3%">
                                    <div id="checkie_id">
                                        <form autocomplete="off">
                                            <input id="b-select" type="checkbox" class="select-all checkbox-style-1 p-relative top-2 filled-in sp" value="" />
                                        </form>
                                    </div>
                                </th>
                                <th width="3%">S/N</th>
                                <th width="37%">Code</th>
                                <th width="5%">Plan</th>
                                <th width="15%">Vendor</th>
                                <th width="15%">User</th>
                                <th width="15%">Referral</th>
                                <th width="10%">Created</th>
                                <th width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @if(count($dd1) > 0)
                            @foreach($dd as $ui)
                            <tr>
                                <td width="30">
                                    <div id="checkie_id">
                                        <form autocomplete="off">
                                            <input type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" class="checkbox-style-1 p-relative top-2 filled-in sp"  />
                                            <label for="b-{{$ui->id}}"></label>
                                        </form>
                                    </div>
                                </td>
                                <td><a href="ecommerce-coupons-form.html"><strong>{{$counter++}}</strong></a></td>
                                <td><a href="ecommerce-coupons-form.html"><strong>{{$ui->coupon_code}}</strong></a></td>
                                @php $plan_name = \App\Models\Plan::where('id', $ui->plan)->first()->name; @endphp
                                <td><a href="{{ route('plan') }}"><b>{{$plan_name}}</b></a></td>
                                <td>
                                    @if(!empty($ui->vendor_id))
                                        <a href="{{ url('/') }}/admin/users/edit/{{ $ui->vendor_id }}"> {{ get_vendor_name($ui->vendor_id) }}</a>
                                    @endif
                                </td>
                                <td>
                                    @if($ui->user)
                                        <a href="{{route('adminUsEdit', $ui->user->id)}}"> {!! Str::limit($ui->user['username']) !!}</a>
                                    @else
                                    <span class="ecommerce-status active">Un-used</span>
                                    @endif
                                </td>
                                <td>@if($ui->user) <a href="{{ url('/') }}/admin/users/edit/{{ get_referral_by_bonus_by_id($ui->user_id) }}">{{ get_referral_by_bonus_by_name($ui->user_id) }} </a> @endif </td>
                                <td>{{$ui->created_at->diffForHumans()}}</td>
                                <td ><a onclick="confirmAction(event)" href="{{route('couponTrashSelected', $ui->id)}}" class="btn btn-danger btn-sm">Trash</a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    <hr class="solid mt-5 opacity-4">
                    <div class="datatable-footer">
                        <div class="row align-items-center justify-content-between mt-3">
                            <div class="col-md-auto order-1 mb-3 mb-lg-0">
                                <div class="d-flex align-items-stretch">
                                    <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                                        <select class="form-control select-style-1 bulk-action" name="bulk-action" style="min-width: 170px;">
                                            <option value="" selected>Bulk Actions</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <a href="ecommerce-coupons-form.html" class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Apply</a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-auto text-center order-3 order-lg-2">
                                <div class="results-info-wrapper"></div>
                            </div>
                            <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                <div class="pagination-wrapper">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- end: page -->
@stop

@section('scripts')
    <script>

        $('#s_d_i').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

        function confirmAction (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        }

        $('#selected').val = '';
        $('#selectedcoupon').val = '';
        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
                $('#selectedcoupon').val(favorite);
            } else {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', true);
            }
        });


		$('#b-select').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });


		$('#b-select').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@stop
