@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                
                <div class="col-12">
                    <div class="card-body">
                        <form method="post" action="{{route('planCreatePost')}}">
                        @csrf
                            <div class="row">
                                <div class="col-md-6 my-3">
                                    <label class="bmd-label-floating">Name</label>
                                    <input class="form-control" name="name" required>
                                </div>
                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Amount</label>
                                    <input class="form-control" name="amount" required>
                                </div>
         
                                <div class="col-md-6 my-3">
                                    <label class="bmd-label-floating">Referral Bonus</label>
                                    <input class="form-control" name="referral_bonus" required>
                                </div>

                                <div class="col-md-6 my-3">
                                    <label class="bmd-label-floating">Indirect Referral Bonus</label>
                                    <input class="form-control" name="indirect_referral_bonus" required>
                                </div>

                                <div class="col-md-6 my-3">
                                    <label class="bmd-label-floating">Indirect 2 bonus</label>
                                    <input class="form-control" name="indirect_referral_2" required>
                                </div>

                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Reg Bonus</label>
                                    <input class="form-control" name="registeration_bonus" required>
                                </div>

                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Share Post Bonus</label>
                                    <input class="form-control" name="post_bonus" required>
                                </div>
                                
                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Daily Login Bonus</label>
                                    <input class="form-control" name="login_bonus" required>
                                </div>

                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Minimum Non Ref</label>
                                    <input class="form-control" name="min_noref" required>
                                </div>
                                
                                <div class=" col-md-6 my-3">
                                    <label class="bmd-label-floating">Minimum Ref</label>
                                    <input class="form-control" name="min_ref" required>
                                </div>
                            </div>
                                
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Plan</button>

                        </form>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
    </div>
@stop

@section('scripts')
@stop