@extends('layouts.admin')
@section('content')
<div class="container-fluid ">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Enable Payment
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="{{route('requestPayoutOpenPost')}}">
                        @php $the_payout = \App\Models\requestPayout::first(); @endphp
                        @csrf

                        <div class="collapse form-check form-switch">
                            <input name="status" value="1" 
                            type="checkbox" data-toggle="switchbutton"
                            @if ($the_payout->status) checked @endif 
                            data-offlabel="<i class='bx bx-power-off'></i> OFF" 
                            data-onlabel="<i class='bx bx-power-off'></i> ON" 
                            data-onstyle="primary" 
                            data-size="small"
                            data-offstyle="dark">
                            <label class="form-check-label" for="general">Access to Payment</label>
                        </div>

                        <div class="form-check form-switch">
                            <input name="wallet" value="1" 
                            type="checkbox" id="affiliate" 
                            data-toggle="switchbutton" 
                            data-size="small"
                            @if ($the_payout->wallet) checked @endif 
                            data-offlabel="<i class='bx bx-power-off'></i> OFF" 
                            data-onlabel="<i class='bx bx-power-off'></i> ON" 
                            data-onstyle="primary" data-offstyle="dark">
                            <label class="form-check-label" for="affiliate">Affiliate</label>
                        </div>

                        <div class="form-check form-switch">
                            <input name="allowi" value="1"
                            type="checkbox" id="activity" 
                            data-toggle="switchbutton" 
                            @if ($the_payout->allowi) checked @endif 
                            data-offlabel="<i class='bx bx-power-off'></i> OFF" 
                            data-onlabel="<i class='bx bx-power-off'></i> ON" 
                            data-onstyle="primary" data-offstyle="dark">
                            <label class="form-check-label" for="activity">Activity</label>
                        </div>

                        <div class="form-check form-switch">
                            <input name="allowi" value="1"
                            type="checkbox" id="activity" 
                            data-toggle="switchbutton" 
                            @if ($the_payout->salary) checked @endif 
                            data-offlabel="<i class='bx bx-power-off'></i> OFF" 
                            data-onlabel="<i class='bx bx-power-off'></i> ON" 
                            data-onstyle="primary" data-offstyle="dark">
                            <label class="form-check-label" for="activity">Salary</label>
                        </div>
{{-- 
                        <div class="form-group mt-3">
                            <label>Lucky Wheel Price Pool</label>
                            <input type="number" class="form-control" style="height: 50px" value="{{$the_payout->pool_price}}" name="pool_price" min="0" placeholder="amount to win from spin">
                        </div>

                        <div class="form-group">
                            <label>Cost per Spin</label>
                            <input type="number" class="form-control" style="height: 50px" value="{{$the_payout->per_spin}}" name="per_spin" min="0" placeholder="Point it cost to spin ">
                        </div> --}}

                        <button type="submit" class="btn btn-primary mt-4 ">Save edit</button>
                    </form>
                </div>

                {{-- <div class="col-md-6 mt-sm-0 mt-5">
                    <form method="post" action="{{route('clearSpin')}}">
                        @csrf
                        @php $spin = App\Support::count(); @endphp
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $spin.' Users have spinned' }}" style="height: 50px" readonly>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-danger" > Reset Spin </button>
                        </div>
                    </form>
                </div> --}}
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
