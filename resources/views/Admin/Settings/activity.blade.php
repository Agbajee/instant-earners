@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row card card-body blur shadow-blur overflow-hidden my-4">
            <div class="col-md-12">

                <form method="post" action="{{route('siteActivity')}}">
                    @csrf
                    <div class="row">
                        <h4 class="text-center opacity-7 text-secondary text-sm"> Bonus on Signup and Logins</h4>
                        <div class="col">
                            <div class="form-group">
                                <label >Registration</label>
                                <input class="form-control"  name="registration"  value="{{ $activity->registration }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Login</label>
                                <input class="form-control"  name="login"  value="{{ $activity->login }}">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <h4 class="text-center opacity-7 text-secondary text-sm"> Posts Bonus</h4>
                        <div class="col">
                            <div class="form-group">
                                <label >Comment</label>
                                <input class="form-control"  name="comment"  value="{{ $activity->comment }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Reading</label>
                                <input class="form-control"  name="reading"  value="{{ $activity->reading }}">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <h4 class="text-center opacity-7 text-secondary text-sm"> Activities</h4>
                        <div class="col">
                            <div class="form-group">
                                <label >Referral Bonus</label>
                                <input class="form-control"  name="referral"  value="{{ $activity->referral }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Indirect Ref Bonus</label>
                                <input class="form-control"  name="referral"  value="{{ $activity->referral_by_referral }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Sponsored Post</label>
                                <input class="form-control"  name="sponsored"  value="{{ $activity->sponsored }}">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <h4 class="text-center opacity-7 text-secondary text-sm"> Minimum payout</h4>
                        <div class="col">
                            <div class="form-group">
                                <label >Non-Affiliate <span class="text-xxs text-info">minimum withdrawal</span> </label>
                                <input class="form-control"  name="payment_for_non_referral"  value="{{ $activity->payment_for_non_referral }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Affiliate <span class="text-xxs text-info">minimum withdrawal</span></label>
                                <input class="form-control"  name="payment_for_referral"  value="{{ $activity->payment_for_referral }}">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <h4 class="text-center opacity-7 text-secondary text-sm">Control Post Earnings</h4>
                        <div class="col">
                            <div class="form-group">
                                <label>Post per-day</label>
                                <input class="form-control"  name="no_of_post_view" value="{{ $activity->no_of_post_view }}">
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label >Comments perday</label>
                                <input class="form-control"  name="no_of_comment" value="{{ $activity->no_of_comment }}">
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                </form>

            </div>
        </div>

    </div>
@stop

@section('scripts')
@stop
