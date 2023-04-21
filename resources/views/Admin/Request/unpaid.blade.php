@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
                <h4 class="card-title">
                    <i class="material-icons">more_vert</i>
                    All UnPaid Requests
                </h4>
                <form method="get" action="{{route('adminSearchPayouts')}}">
                    <form class="navbar-form">
                        <div class="input-group no-border">
                          <input name="term" type="text" value="" class="form-control" placeholder="Search...">
                          <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                          </button>
                        </div>
                      </form>
                </form>
            </div>

        <div class="row ">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <?php $all_payments = \App\Models\payoutRequest::all(); ?>
                    <?php $all_payment = \App\Models\payoutRequest::where('is_payed', 0)->paginate(10); ?>
                    <?php $is_payed = \App\Models\payoutRequest::where('is_payed', 1)->paginate(10); ?>
                    <?php $not_payed = \App\Models\payoutRequest::where('is_payed', 0)->paginate(10); ?>
                        <div class="table-responsive">

                                @if(\Session::has('info'))
                                    <div class="alert alert-success">
                                        {{\Session::get('info')}}
                                    </div>
                                @endif




                                <div class="my-5">
                                    <a href="{{route('requestPayoutAll')}}">All Payments Request({{count($all_payments)}})</a>
                                    <a href="{{route('requestPayoutPaid')}}">All Paid Request({{count($is_payed)}})</a>
                                    <a class="active">All Un-Paid Request({{count($not_payed)}})</a>
                                </div>


                                <div class="text-left pg">
                                    {{$all_payment->links('partials.pagination')}}
                                </div>

                            <form id="selected_all" action="{{route('extractPayoutRequestID')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedextract">
                                <button class="btn bg-black waves-effect waves-light" id="s_d_i" disabled="disabled" type="submit">Extract</button>
                            </form>

                            <form id="selected_all" action="{{route('paidallPayoutRequestID')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedpaid">
                                <button class="btn bg-black waves-effect waves-light" id="s_d_i" disabled="disabled" type="submit">Mark as paid</button>
                            </form>

                            <form id="selected_all" action="{{route('clearPayoutRequestID')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn bg-black waves-effect waves-light" id="s_d_i" disabled="disabled" type="submit">Delete</button>
                            </form>

                            <table class="table table-hover table-responsive">

                                <thead>
                                <tr>
                                    <th>
                                        <div>
                                            <input class="filled-in" type="checkbox" id="b-all" onclick="toggle(this);" />
                                            <label for="b-all" style="padding: 0;margin: -10px 0px;"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>Amount</th>
                                    <th>All referral</th>
                                    <th>Payed referral</th>
                                    <th>Respond</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 1;
                                if(count($all_payments) > 0){ ?>
                                @foreach($all_payment as $ui)
                                    <tr>
                                        <td width="5%">
                                            <div id="checkie_id">
                                                <form autocomplete="off">
                                                    <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                                    <label for="b-{{$ui->id}}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td width="5%">{{$counter++}}</td>
                                        <?php $the_user = \App\Models\User::where('id', $ui->user_id)->first(); ?>
                                        <td><a href="{{route('adminUsEdit', $the_user->id)}}"> {{$ui->name ? $ui->name : '#'.$ui->name}}</a></td>
                                        <td>₦{{number_format($ui->amount, 2)}}</td>
                                        <?php
                                            $d_rf = \App\Models\User::where('referred_by_id', $ui->user_id)->get()->count();

                                            $d_rf = $d_rf;
                                        ?>
                                        <td>{{ $d_rf }}</td>
                                       {{-- <td>{{\App\Models\User::where('referred_by_id', Auth::user()->id)}}</td> --}}
                                        <?php
                                            $payed_rf = \App\Models\PaidMembers::where('referred_by_id', $ui->user_id)->get()->count();

                                            $payed_rf = $payed_rf;

                                        ?>
                                        <td>{{$payed_rf}}</td>
                                        <td>
                                            @if($ui->is_payed == 0)
                                                <a target="_blank" title="Delete User" href="{{route('requestPayoutID', $ui->id)}}" class="btn bg-green waves-effect" id="s_d_i_2">Make Payment</a>
                                            @else
                                                <b><a target="_blank" href="{{route('requestPayoutID', $ui->id)}}"> Paid - ₦{{number_format($ui->amount_paid, 2)}}</a></b>
                                            @endif

                                        </td>
                                        <td width="5%">
                                            <a title="Delete User" href="{{route('clearPayoutRequestSelectedID', $ui->id)}}" type="submit" class="btn bg-teal waves-effect" id="s_d_i">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach
                                <?php } ?>

                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$all_payment->links('partials.pagination')}}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
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

        var favorite = [];
        var check_stat = 0;
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        $('#b-all').on('click', function () {
            check_stat = 1;

        });

        $('#selected').val = '';
        $('#selectedpaid').val = '';
        $('#selectedextract').val = '';

        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
                $('#selectedpaid').val(favorite);
                $('#selectedextract').val(favorite);
            } else {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', true);
            }
        });


         function toggle(source) {
             checkboxes = document.querySelectorAll("input[type='checkbox']");
             for (var i = 0; i < checkboxes.length; i++) {
                 if (checkboxes[i] != source)
                     checkboxes[i].checked = source.checked;
                 //console.log(checkboxes[i].attr('id'));
             }
         }
    </script>
@stop
