@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="row">
        <div class="col-12">
            <div class="card-body">

            <form method="post" action="{{route('bundleCreatePost')}}">
                @csrf
                <div class="row">
                    <div class="col-sm-12 my-3">
                        <label>Name</label>
                        <input class="form-control" placeholder="Name" name="name">
                    </div>

                    <div class="col-sm-6 my-3">
                        <label>Link</label>
                        <input class="form-control" value="https://" name="link">
                    </div>

                    <div class="col-sm-6 my-3">
                        <label>Amount (Unit Points)</label>
                        <input class="form-control" placeholder="Amount (IP Points)" name="points">
                    </div>
 
                    <div class="col-sm-6 my-3">
                        <label>Numbers of Day</label>
                        <input class="form-control" placeholder="10" name="days">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ">Create</button>
            </form>
                
            </div>
        </div>
    <!-- #END# Browser Usage -->
    </div>
</div>
@stop

@section('scripts')
@stop