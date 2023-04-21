@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary">
            Editing : {{$data->name}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <form method="post" action="{{route('editPlanPost', $data->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-3">
                                <label>Name</label>
                                <input class="form-control" placeholder="Name" name="name" value="{{ $data->name }}">
                            </div>

                            <div class="col-md-6 my-3">
                                <label>Amount</label>
                                <input class="form-control" placeholder="Amount" name="amount" value="{{ $data->amount }}">
                            </div>

                            <div class="col-md-6 my-3">
                                <label>Referral Bonus</label>
                                <input class="form-control" placeholder="Referral Bonus" name="referral_bonus" value="{{ $data->referral_bonus }}">
                            </div>

                            <div class="col-md-6 my-3">
                                <label class="bmd-label-floating">Indirect Referral Bonus</label>
                                <input class="form-control" name="indirect_referral_bonus" value="{{ $data->indirect_ref}}">
                            </div>

                            <div class="col-md-6 my-3">
                                <label>Registration Bonus</label>
                                <input class="form-control" placeholder="Registration Bonus" name="registeration_bonus" value="{{ $data->registeration_bonus }}">
                            </div>

                            <div class=" col-md-6 my-3">
                                <label class="bmd-label-floating">Share Post Bonus</label>
                                <input class="form-control" name="post_bonus" value="{{ $data->sponsored }}">
                            </div>

                            <div class=" col-md-6 my-3">
                                <label class="bmd-label-floating">Daily Login Bonus</label>
                                <input class="form-control" name="login_bonus" value="{{ $data->login }}">
                            </div>

                            <div class=" col-md-6 my-3">
                                <label class="bmd-label-floating">Minimum Non Ref</label>
                                <input class="form-control" name="min_noref" value="{{ $data->min_noref }}">
                            </div>

                            <div class=" col-md-6 my-3">
                                <label class="bmd-label-floating">Minimum Ref</label>
                                <input class="form-control" name="min_ref" value="{{ $data->min_ref }}">
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Edit Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
