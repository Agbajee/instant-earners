@extends('newlook3.main')
@section('content')

<!-- Start Content-->
<div class="content-wrapper">
    <div class="container-full">
        <!-- Main content -->
            <section class="content mt-50">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class=" box box-body bg-primary-light rounded-0">
                                    <div class="summary">
                                        <p>All Codes</p>
                                        <h3>{{$dd1->count()}}</h3>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted " href="{{ url('/vendo') }}">View  <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class=" box box-body bg-secondary-light rounded-0">
                                    <div class="summary">
                                        <p>Used</p>
                                        <h3>{{$is_used->count()}}</strong>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-danger" href="{{ url('/vendor/couponused/1') }}">View <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class=" box box-body bg-warning-light rounded-0">
                                    <div class="summary">
                                        <p>Un-Used</p>
                                        <h3>{{$is_not_used->count()}}</h3>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-muted text-primary" href="{{ url('/vendor/couponused/2') }}">View <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{$dd->links('partials.adminPagination')}}
                    <div class="col-lg-12">
                        <div class="box bg-success-light">
                            <div class="box-header with-border">
                                <form id="selected_all" class="my-3" action="{{route('vendorcouponExportSelected')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selectedcoupon">
                                    <button class="btn btn-primary btn-py-2 px-4 waves-effect waves-light rounded-0" disabled="disabled" type="submit">Export</button>
                                </form> 
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped invoice-archive">
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
                                                <th>S/N</th>
                                                <th>Code</th>
                                                <th>Plan</th>
                                                <th>Used By</th>
                                                <th>Bonus Received By</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $counter = 1; @endphp
                                            @forelse($dd as $ui)
                                            <tr>
                                                <td>
                                                    <div id="checkie_id">
                                                        <form autocomplete="off">
                                                        <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                                        <label for="b-{{$ui->id}}"></label>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td>{{$counter++}}</td>
                                                <td><b>{{$ui->coupon_code}}</b></td>
                                                @php $plan_name = \App\Models\Plan::where('id', $ui->plan)->first()->name; @endphp
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
                                            @empty
                                            <tr>
                                                <p class="text-center text-danger">No codes yet</p>
                                            </tr>
                                            @endforelse
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
                    </div>
                   

                </div>
            </section>
    </div>
</div>
@stop

@section('js')
    <script>
        console.log('header');
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