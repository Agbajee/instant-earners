@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        @if(\Session::has('info'))
            <div class="alert alert-success">
                {{\Session::get('info')}}
            </div>
        @endif

        <div class="card card-plain">
            <div class="card-header card-header-primary">
                <h4 class="card-title">
                    Complete Payment Request
                </h4>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="btn-group mt-5">
                        <a title="Edit User" class="btn btn-outline-warning mx-3" rel="tooltip" href="{{route('adminUsEdit', $request->user->id)}}">Edit user profile</a>
                        <a title="Delete User" rel="tooltip" href="{{route('clearPayoutRequestID2', $request->id)}}" type="submit" class="btn btn-outline-danger" id="s_d_i">Delete Request</a>
                    </div>
                    <form method="post" action="{{route('clearUserBalance', $request->id)}}">
                        @csrf
                        <br>
                        <br>
                        <button class="btn btn-success">Total Amount Paid : {{$request->amount_paid ? '₦ '.number_format($request->amount_paid, 2) : ' ₦ '.number_format(0, 2)}}</button></b>
                        <button class="btn btn-info">Status : {{$request->is_payed ? 'Paid' : 'Pending'}}</button></b>

                        <br>
                        <div class="card card-plain">
                            <div class="card-header card-header-primary">
                                <div class="card-title">
                                    <h4>Payment Request from {{$request->user->fullname}}</h4>
                                    @if($request->from_account != 3)
                                    <p><b>Referral Amount requested</b> ₦{{number_format($request->amount, 2)}}</p>
                                    @else
                                    <p><b>Card/Data requested</b> ₦{{number_format($request->amount, 2)}}</p>
                                    @endif
                                </div>
                            </div>
                            @if($request->w_option ==1)
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <td>
                                        Account Name:
                                    </td>
                                    <td>
                                        Account Number:
                                    </td>
                                    <td>
                                        Bank Name:
                                    </td>
                                    <td>
                                        Facebook URL:
                                    </td>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                        {{base64_decode($request->account_name)}}
                                        </td>
                                        <td>
                                        {{base64_decode($request->account_number)}}
                                        </td>
                                        <td>
                                        {{base64_decode($request->bank_name)}}
                                        </td>
                                        <td>
                                            <b>
                                            <a href="{{(base64_decode($request->facebook_profile_link))}}">

                                        {{base64_decode($request->facebook_profile_link)}}

                                            </a></b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            @else
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <td>
                                        Wallet Name:
                                    </td>
                                    <td>
                                        wallet Id:
                                    </td>
                                    <td>
                                        Facebook URL:
                                    </td>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                        {{$request->wallet}}
                                        </td>
                                        <td>
                                        {{$request->wallet_id}}
                                        </td>
                                        <td>
                                            <b>
                                            <a href="{{(base64_decode($request->facebook_profile_link))}}">

                                        {{base64_decode($request->facebook_profile_link)}}

                                            </a></b>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                            @endif
                            <div class="card-footer">
                                <?php $user = \App\Models\User::where('id', $request->user->id)->get(); ?>

                                <p class="btn btn-outline-primary"><b>Referral</b>
                                    ₦{{number_format($user[0]->balance, 2)}}
                                </p>

                                <p class="btn btn-outline-primary"><b>Indirect Ref</b>
                                    ₦{{number_format($user[0]->indirect_ref)}}
                                </p>

                                <p class="btn btn-outline-success"><b>Total Ref</b>
                                    ₦{{number_format($user[0]->balance + $user[0]->indirect_ref)}}
                                </p>


                                <p class="btn btn-outline-primary"><b>Activity </b>
                                    ₦{{number_format($user[0]->allowi_balance, 2)}}
                                </p>

                                <p class="btn btn-outline-success"><b>Total Activity</b>
                                    ₦{{number_format($user[0]->allowi_balance + $user[0]->mines)}}
                                </p>
                            </div>
                        </div>

                        @if($request->is_payed == 0)
                            @if($request->from_account != 3)
                            <div class="form-group">
                                <div class="form-line">
                                    <label class="bmd-label-floating">Amount to be Paid</label>
                                    <input type="text" value="{{ $request->amount }}" class="form-control" id="source" name="pay_user_balance" required>
                                </div>
                            </div>

                            @else
                            <div class="form-group">
                                <div class="form-line">
                                    <label class="bmd-label-floating">Amount</label>
                                    <input required type="number" value="{{ $request->amount }}" class="form-control" id="source" name="pay_user_activities_balance" required>
                                </div>
                            </div>
                            @endif

                            <input type="hidden" value="0" class="form-control" id="source" name="charges" required>

                            @if(\Session::has('amount_big'))
                                <div class="alert alert-danger">
                                    <i class="material-icons text-white">error</i>
                                    {{\Session::get('amount_big')}}
                                </div>
                            @endif

                            <button type="submit" class="btn bg-gradient-primary">Make Payment</button>
                        @endif

                        <br>
                        <br>

                    </form>
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
    </script>
@stop
