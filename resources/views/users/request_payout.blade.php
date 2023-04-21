@extends('newlook3.main')
@section('content')
    @php
        
        $min_ref = $myPlan->min_ref;
        $min_noref = $myPlan->min_noref;
        $activityBalance = $user->allowi_balance;
        $mainBalance = $user->balance + $user->indirect_ref;

        $status = 'text-danger';
        if ($mainBalance >= $min_ref) {
            $status = 'text-success';
        }

        $status2 = 'text-danger';
        if ($activityBalance >= $min_noref) {
            $status2 = 'text-success';
        }
    @endphp

    <div class="content-wrapper">
        <div class="content-bg"></div>
        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-center flex-column mb-40" style="z-index:1;">
                        <img src="{{ asset('newUser/images/wallet.png') }}" alt="wallet-image">
                    </div>
                </div>
                <div class="row gy-5">
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-center">
                            <div class="ccard justify-content-center align-items-center">
                                <img src="{{ asset('newUser/images/map.png')}}" class="map" alt="map">
                                <div class="d-flex justify-content-between w-p100">
                                    <div style="color:#F1602B;">instant-naire</div>
                                    <div class="instant-card position-relative border-2 w-p10">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                <div class="d-flex w-p100">
                                    <img src="{{ asset('newUser/images/chip.png')}}" alt="chip">
                                </div>
                                <div class="d-flex justify-content-center  w-p100">
                                    <span>{{ $user->acc_name }}</span>
                                </div>
                                <div class="d-flex justify-content-between flex-column w-p100">
                                    <span>{{ $user->acc_numb }}</span>
                                    <span>{{ $user->bank }}</span>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="edit-form py-0">
                            <div class="card-body">
                                <div class="title">Payment Request</div>
                                <form class="form-horizontal form-element" method="post" action="{{ route('requestPayoutPost') }}">
                                    @csrf
                                    <div class="position-relative mb-3">
                                        <select name="from" class="form-control form-control-lg">
                                            <option>Choose Withdrawal Type</option>
                                            <option value="1" @if ( $payout->wallet == '1' && !\App\Models\payoutRequest::where('user_id', $user->id)->where('is_payed', 0)->where('from_account', 1)->exists() == true) @else disabled @endif> Affiliate</option>
                                            <option value="2" @if ( $payout->allowi == '1' && !\App\Models\payoutRequest::where('user_id', $user->id)->where('is_payed', 0)->where('from_account', 2)->exists() == true) @else disabled @endif>Task</option>
                                        </select>
                                    </div>

                                    <div class="position-relative mb-3">
                                        <div class="input-group align-items-center justify-content-between">
                                            <span class="fs-20 fw-bolder me-2">₦</span>
                                            <input type="text" class="form-control" placeholder="Amount in Figure" name="amount" required>
                                        </div>
                                    </div>

                                    <button class="btn-custom w-p100 waves-effect waves-dark" type="submit">Submit Request</button>
                                    <div class="my-2">
                                        <p id="point1" class="{!! $status !!}">
                                            Aval.Bal = {{ '₦' . number_format($mainBalance, 2) }}
                                        </p>

                                        <p id="point2" class="{!! $status2 !!} ">
                                            Aval.Points = {{ number_format($activityBalance, 2) }}
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <!-- end card-body-->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-12">
                        <div class="d-flex justify-content-start flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                                <span class="fw-bolder text-dark fs-18 mt-10">Cashout History</span>
                            </div>
    
                            <ul class="custom-list">
                                @forelse($history as $row)
                                <li class="d-flex justify-content-between align-items-center">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{date_to_word($row->created_at)}}">
                                    <i data-feather="clock" class="text-secondary"></i>
                                    </span>
                                    <span class="{{ $statusArray[$row->is_payed]['class'] ?? 'text-muted' }}"> {{ number_format($row->amount) }}</span>
                                    <span class="{{ $statusArray[$row->is_payed]['class'] ?? 'text-muted' }}">{{ $statusArray[$row->is_payed]['label'] ?? 'unknown' }}</span>
                                </li>
                                @empty
                                <li class="d-flex justify-content-between align-items-center">
                                    <i data-feather="clock" class="text-primary"></i>
                                    <span class="text-start">No history found!</span>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div> 
                </div>
            </section> 

        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            if ($('#affiliate').is(':checked')) {
                $('#point2').addClass("collapse")
            }
        });

        $('#affiliate').click(function() {
            $('#point2').addClass("collapse")
            $('#point1').removeClass("collapse")
        });

        $('#activity').click(function() {
            $('#point2').removeClass("collapse")
            $('#point1').addClass("collapse")
        });
    </script>
@endsection
