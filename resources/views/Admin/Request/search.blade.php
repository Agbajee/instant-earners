@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <form method="get" action="{{route('adminSearchPayouts')}}">
                            <div class="from_s_a">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" placeholder="Search Payouts (e.g Neon Emmanuel, 1000)" name="term"  class="form-control" value="{{\Session::has('search') ? \Session::get('search') : old('term')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <h2>Search Result For - {{$id}} ({{count($get_payout)}} search results found)</i> </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php $all_payments = $get_payout; ?>
                    <?php $all_payment = $get_payout; ?>
                    <div class="body">
                        <div class="table-responsive">
                            <div class="clearfix">

                                @if(\Session::has('info'))
                                    <div class="alert alert-success">
                                        {{\Session::get('info')}}
                                    </div>
                                @endif

                                <div class="text-left pg">
                                    {{$all_payment->links('partials.pagination')}}
                                </div>
                            </div>
                            <form id="selected_all" action="{{route('clearPayoutRequestID')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn bg-black waves-effect waves-light" id="s_d_i" disabled="disabled" type="submit">Delete</button>
                            </form>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th></th>
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
                                        <?php $d_rf = \App\Models\User::where('referred_by_id', Auth::user()->id)->get(); ?>
                                        <td>{{count($d_rf)}}</td>
                                       {{-- <td>{{\App\Models\User::where('referred_by_id', Auth::user()->id)}}</td>--}}
                                        <?php $payed_rf = \App\Models\PaidMembers::where('referred_by_id', $ui->user->id)->get(); ?>
                                        <td>{{count($payed_rf)}}</td>
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
        /*var favorite = [];
        var check_stat = 0;
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        $('#b-all').on('click', function () {
            check_stat = 1;


        });
*/
        $('#selected').val = '';
        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
            } else {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', true);
            }
        });


        /* function toggle(source) {
             checkboxes = document.querySelectorAll("input[type='checkbox']");
             for (var i = 0; i < checkboxes.length; i++) {
                 if (checkboxes[i] != source)
                     checkboxes[i].checked = source.checked;
                 //console.log(checkboxes[i].attr('id'));
             }
         }
     */
    </script>
@stop
