@extends('newlook3.main')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="row mb-3">
            <div class="col-xl-4">
                <section class="card card-featured-left card-featured-primary mb-3">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fas fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">All Codes</h4>
                                    <div class="info">
                                        <strong class="amount">{{$dd1->count()}}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ url('/vendo') }}">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-4">
                <section class="card card-featured-left card-featured-secondary">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Used Codes</h4>
                                    <div class="info">
                                        <strong class="amount">{{$is_used->count()}}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ url('/vendor/couponused/1') }}">View all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-xl-4">
                <section class="card card-featured-left card-featured-quaternary">
                    <div class="card-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-quaternary">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Un-Used Codes</h4>
                                    <div class="info">
                                        <strong class="amount">{{$is_not_used->count()}}</strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a class="text-muted text-uppercase" href="{{ url('/vendor/couponused/2') }}">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
</div>

{{$dd->links('partials.adminPagination')}}

<div class="card card-mordern">
    <div class="card-body">
        <div class="datatables-header-footer-wrapper">
            
            <div class="datatable-header">
                <div class="row align-items-center mb-3">
                    <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                        <form id="selected_all" class="my-3" action="{{route('vendorcouponExportSelected')}}" method="post">
                            @csrf
                            <input type="hidden" name="selected" id="selectedcoupon">
                            <button class="btn btn-primary btn-md font-weight-semibold btn-py-2 px-4 waves-effect waves-light" disabled="disabled" type="submit">Export</button>
                        </form>                                
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
                </div>
            </div>
            
                
            <table class="table table-ecommerce-simple table-striped mb-5" id="datatable-ecommerce-list" style="min-width: 750px;">
                <thead>
                    <tr>
                        <th width="5%">
                            <div id="checkie_id">
                                <form autocomplete="off">
                                    <input class="filled-in sp" type="checkbox" id="b-select" />
                                    <label for="b-select" style="line-height: 0;padding: 0;height: 12px;"></label>
                                </form>
                            </div>
                        </th>
                        <th width="5%">S/N</th>
                        <th width="35%">Code</th>
                        <th width="10%">Plan</th>
                        <th width="15%">Used By</th>
                        <th width="15%">Bonus Received By</th>
                        <th width="15%">Created At</th>
                    </tr>
                </thead>
                <tbody>
                <?php $counter = 1; ?>
                @if(count($dd1) > 0)
                    @foreach($dd as $ui)
                    <tr>
                        <td width="5%">
                            <div id="checkie_id">
                                <form autocomplete="off">
                                <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                <label for="b-{{$ui->id}}"></label>
                                </form>
                            </div>
                        </td>
                        <td>{{$counter++}}</td>
                        <td><b>{{$ui->coupon_code}}</b></td>
                        @php $plan_name = \App\Plan::where('id', $ui->plan)->first()->name; @endphp
                        <td><b>{{$plan_name}}</b></td>
                        <td>
                            @if($ui->user)
                                <span class="ecommerce-status">{!! Str::limit($ui->user->username) !!}</span>
                            @else
                                <span class="ecommerce-status active">Un-used</span>
                            @endif
                        </td>
                        <td> @if($ui->user) {{ get_referral_by_bonus_by_name($ui->user_id) }} @endif </td>
                        <td>
                            {{$ui->created_at->diffForHumans()}}
                        </td>

                    </tr>
                    @endforeach
                @endif

                </tbody>
            </table>

            <div class="clearfix">
                <div class="text-left pg">
                    {{$dd->links('partials.pagination')}}
                </div>
            </div>
        </div>
    </div>
</div>
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
                $('.btn.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
                $('#selectedcoupon').val(favorite);
            } else {
                $('.btn.waves-effect.waves-light').attr('disabled', true);
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