@extends('newlook3.main')
@section('content')
    @php
        $user = Auth::user();
        $last_login = Carbon\Carbon::parse($user->mine_date)->format('d, F g:i:a');
        $date = Carbon\Carbon::parse(date('Y-m-d H:m:i'))->format('d, F g:i:a');
        
        $referred = \App\Models\User::orderBy('created_at', 'DESC')
            ->where('referred_by_id', $user->id)
            ->count();

        $sumCashout = \App\Models\payoutRequest::where('user_id', $user->id)->sum('amount');
        
        $status = \App\Models\payoutRequest::where('user_id', $user->id)
            ->where('from_account', 4)
            ->first();
        
        $activityBalance = $user->allowi_balance;
        $mainBalance = $user->balance + $user->indirect_ref;
        
    @endphp

    <style>
    .balance-card .extra-details{
        width: 85%;
        padding: 0 0 12px 0;
        background: transparent;
        position: absolute;
        border-bottom: 2px solid #F1602B;
        top: 28px;
        left: 20px;
        display: flex;
        gap:30px;
        }
    .balance-card .extra-details span{
            font-size: 12px;
        }
    </style>

    <div class="content-wrapper ">
        <div id="compareBG" class="content-bg"></div>

        <div class="container-full">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12 d-flex align-items-end mb-40 ps-30" style="z-index:1;">
                        <a href="{{route('editAccount')}}">
                            <img src="{{ asset('images/users/' . $user->avatar) }}" alt="profile image" class="profile-pic">
                        </a>
                        <div class="greeting">
                            <div>Welcome Back!</div>
                            <div class="fs-22 fw-bold">{{ $user->fullname }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="balance-wrapper" style="z-index:1;">
                            <div class="balance-card front">
                                <div class="extra-details">
                                    <span>Affiliate: ₦ {!! number_format($user->balance )!!}</span> 
                                    <span>Indirect: ₦ {!! number_format($user->indirect_ref )!!}</span> 
                                </div>
                                <p class="fs-16">Affiliate Balance</p>
                                <h3 class="fs-30">₦ {!! number_format($mainBalance)!!}</h3>
                            </div>

                            <div class="balance-card balance-card-alt back">
                                <p class="text-dark fs-16">Activity Balance</p>
                                <h3 class="fs-30">{!! number_format($user->allowi_balance) !!} INE</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-12 mt-40">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="ref-box box ">
                                    <div class="box-body">
                                        <div class="justify-content-start">
                                            <p class="fw-bolder text-dark">Copy referral link</p>
                                            <div class="d-flex form-group">
                                                <input id="myRef" type="text" class="form-control border-0"
                                                value="{{ route('signup') }}?ref={{ $user->referral_id }}" disabled>
                                                <button id="copy" class="mx-2 waves-effect waves-light btn btn-sm copy-btn">
                                                    <i data-feather="clipboard"></i>
                                                </button>
                                            </div>
                                            <div class="copy-feedback d-none">link copied!</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-12 mt-20">
                        <div class="d-flex justify-content-start flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                                <span class="fw-bolder text-dark fs-18">Quick Link</span>
                                <a href="javascript:void(0);" data-toggle="push-menu" role="button">open all</a>
                            </div>

                            <div class="d-flex justify-content-between align-items-start w-p100 py-10 px-5">
                                <div class="d-flex position-relative flex-column justify-content-between align-items-center h-80">
                                    <a href="{{route('requestPayout')}}"class="icon-btn waves-effect waves-dark ">
                                        <i data-feather="credit-card"></i>
                                    </a>
                                    <span class="fw-bold fs-14">Withdrawal</span>
                                </div>
                                <div class="d-flex position-relative flex-column justify-content-between align-items-center h-80">
                                    <a id="daily-task" href="#"class="waves-effect waves-light icon-btn">
                                        <i data-feather="crosshair"></i>
                                    </a>
                                    <span class="fw-bold fs-14">Daily Task</span>
                                </div>
                                <div class="d-flex position-relative flex-column justify-content-between align-items-center h-80">
                                    <a href="{{route('upgradePlan')}}"class="waves-effect waves-light icon-btn">
                                        <i data-feather="trending-up"></i>
                                    </a>
                                    <span class="fw-bold fs-14">Upgrade</span>
                                </div>
                                <div class="d-flex position-relative flex-column justify-content-between align-items-center h-80">
                                    <a href="{{route('upgradePlan')}}"
                                        class="waves-effect waves-light icon-btn">
                                        <i data-feather="shuffle"></i>
                                    </a>
                                    <span class="fw-bold fs-14">Converter</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-12">
                        <div class="ads">
                            <div class="ad-img">
                                <img src="{{ asset('newUser/images/mk-1.jpg')}}" alt="topper-image">
                            </div>

                            <div class="text-box">
                                <h4> Need Instant Loans?</h4>
                                <div>access up to</div>
                                <h1>₦10,000</h1>
                                <div>immediately</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-12 my-20">
                        <div class="d-flex justify-content-start flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                                <span class="fw-bolder text-dark fs-18">Recent Activities</span>
                                <a href="{{route('earningHistory')}}">view all</a>
                            </div>

                            <ul class="custom-list">
                                @forelse($history as $row)
                                <li class="d-flex justify-content-between align-items-center">
                                    <i data-feather="chevron-up" class="text-success"></i>
                                    <span class="text-start">{{ $row->type }}</span>
                                    <span class="text-success">+ ₦{{ number_format($row->amount) }}</span>
                                </li>
                                @empty
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-start">No record yet</span>
                                </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>

    <div id="random-popup" class="random-pop">
        <a id="update-balance-link" href="javascript:void(0);">
            <img src="{{ asset('newUser/images/gift.png')}}" width="200">
        </a>
    </div>

    <div class="modal fade" id="pop" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="pop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('newUser/images/logo-icon.png')}}" width="60px" alt="">
                    <h2 class="message text-success"></h2>
                    <p class="state text-primary"></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(window).on('load', function() {
            $('#autoNotification').modal('show');

            (function() {
                var counter = 5;

                setInterval(function() {
                    counter--;
                    if (counter >= 0) {
                        $('#countdown').html(
                            `<a href="#" class="badge badge-danger fs-16">close in &nbsp;<span id="count">${counter}</span></a>`
                        )
                    }
                    if (counter === 0) {
                        clearInterval(counter);
                        $('#countdown').html(
                            `<a href="#" data-bs-dismiss="modal" class="badge badge-success fs-16">close</a>`
                        )
                    }

                }, 1000);

            })();
        });

        $(document).ready(function () {

            $.ajax({
                url: "{{ route('random-popup') }}",
                method: "GET",
                success: function (data) {
                    if (data.showPopup) {
                        $("#random-popup").show();
                    }
                }
            });

            $("#daily-task").on("click", function (e) {
                e.preventDefault(); // Prevent the default behavior of the anchor tag
                $.ajax({
                    url: "{{ route('daily-task') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.message').text(data.message);
                        $('.state').text(data.amount + ' will be added to point');
                        $('#pop').modal('show');
                        $("#random-popup").hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown + " (HTTP status " + jqXHR.status + " - " + jqXHR.statusText + ")");
                    }
                });
            });

            $("#update-balance-link").on("click", function (e) {
                e.preventDefault(); // Prevent the default behavior of the anchor tag
                $.ajax({
                    url: "{{ route('claim-gift') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('.message').text(data.message);
                        $('.state').text(data.amount + ' will be added to your affilate balance when you refresh');
                        $('#pop').modal('show');
                        $("#random-popup").hide();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error: " + errorThrown + " (HTTP status " + jqXHR.status + " - " + jqXHR.statusText + ")");
                    }
                });
            });
  
            var sound = new Audio('{{ asset('newUser/soundfx.mp3') }}');
            $('.balance-card, .balance-card-alt').click(function() {
                $('.balance-card, .balance-card-alt').toggleClass('front back');
                sound.play();
            });

            $('#copy').click(function() {
                var input = $('#myRef');
                input.prop('disabled', false);
                input.select();
                document.execCommand('copy');
                input.prop('disabled', true);

                $('.copy-feedback').removeClass('d-none').delay(5000).queue(function() {
                    $(this).addClass('d-none').dequeue();
                });
            });
        });

    </script>
@endsection
