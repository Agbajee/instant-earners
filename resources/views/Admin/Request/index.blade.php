@php
    $counter = 1;
@endphp
@extends('layouts.admin')
@section('content')
	<!-- start: page -->
    <div class="row">
        <div class="col">

            <div class="card card-modern">
                <div class="card-body">
                    <div class="datatables-header-footer-wrapper">
                        <div class="datatable-header">
                            <div class="row align-items-center mb-3">

                                <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Payment Stats:</label>
                                        <select class="form-control select-style-1 filter-by" name="filter-by">
                                            <option value="all" selected>All({{$all_payments->count()}})</option>
                                            <a class="bt" href="{{route('requestPayoutPaid')}}"><option value="1">Paid({{$is_payed->count()}})</option></a>
                                            <a class="bt" href="{{route('requestPayoutUnPaid')}}"><option value="2">Un-Paid({{$not_payed->count()}})</option></a>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Filter By:</label>
                                        <select class="form-control select-style-1 filter-by" name="filter-by">
                                            <option value="all" selected>All</option>
                                            <option value="1">S/N</option>
                                            <option value="3">Name</option>
                                            <option value="4">Bank</option>
                                            <option value="5">Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Show:</label>
                                        <select class="form-control select-style-1 results-per-page" name="results-per-page">
                                            <option value="12" selected>12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <form action="{{route('adminSearchPayouts')}}">
                                        <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                            <div class="input-group">
                                                <input type="text" class="search-term form-control" name="term" id="search-term" placeholder="Search Customer">
                                                <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                            <div class="d-flex">
                                <form class="p-2" id="selected_all" action="{{route('clearPayoutRequestID')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selected">
                                    <button class="btn btn-danger on  btn-sm" id="s_d_i" disabled="disabled" type="submit">Reject</button>
                                </form>

                                <form class="p-2" id="selected_all" action="{{route('extractPayoutRequestID')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selectedextract">
                                    <button class="btn btn-primary on  btn-sm" id="s_d_i" disabled="disabled" type="submit">Extract</button>
                                </form>

                                <form class="p-2" id="selected_all" action="{{route('paidallPayoutRequestID')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected" id="selectedpaid">
                                    <button class="btn btn-success on  btn-sm" id="s_d_i" disabled="disabled" type="submit">Mark paid</button>
                                </form>
                            </div>
                    </div>

                        <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">

                            <thead>
                                <tr>
                                    <div id="checkie_id">
                                        <th width="3%">
                                            <form autocomplete="off">
                                                <input id="b-all" type="checkbox" class="select-all checkbox-style-1 p-relative top-2 filled-in sp" onclick="toggle(this);" />
                                                <label for="b-all"></label>
                                            </form>
                                        </th>
                                    </div>
                                    <th width="10%">S/N</th>
                                    <th width="15%">Type</th>
                                    <th width="20%">Name</th>
                                    <th width="15%">Bank</th>
                                    <th width="10%">Acc Numb</th>
                                    <th width="10%">Amount</th>
                                    <th width="10%">Referred</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_payment as $ui)
                                <tr>
                                    <td width="30">
                                        @if($ui->is_payed == 0)
                                        <div id="checkie_id">
                                            <form autocomplete="off">
                                                <input type="checkbox" class="checkbox-style-1 p-relative top-2 filled-in sp" id="b-{{$ui->id}}" name="{{$ui->id}}"/>
                                                <label for="b-{{$ui->id}}"></label>
                                            </form>
                                        </div>
                                        @else
                                        <span class="btn btn-sm btn-secondary">Paid</span>
                                        @endif
                                    </td>
                                    <td><strong>{{$counter++}}</strong></td>
                                    <td>
                                        <strong>
                                            @if($ui->from_account == 1)
                                            Affiliate Balance
                                            @elseif($ui->from_account == 2)
                                            Activity Balance
                                            @endif
                                        </strong>
                                    </td>

                                    @php $the_user = \App\Models\User::where('id', $ui->user_id)->first(); @endphp
                                    <td><a href="{{route('adminUsEdit', $the_user->id)}}" class="__cf_email__" data-cfemail="f49b9f989186b4909b99959d9ada979b99">{{$ui->name ? $ui->name : '#'}}</a></td>
                                    <td>{{$ui->bank_name}}</td>
                                    <td>{{$ui->account_number}}</td>
                                    <td>₦{{number_format($ui->amount)}}</td>

                                    @php $d_rf = \App\Models\User::where('referred_by_id', $ui->user->id)->get()->count();@endphp
                                    <td>{{ $d_rf }}</td>
                                    <td class="actions">
                                        <a href="{{route('clearPayoutRequestSelectedID', $ui->id)}}" title="reject" class="btn btn-sm btn-warning btn-2 text-light"><i class="bx bx-no-entry"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="solid mt-5 opacity-4">
                        <div class="datatable-footer">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <form class="p-2" id="selected_all" action="{{route('allAffiliateExport')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="selected">
                                        <button class="btn btn-primary btn-sm"  type="submit">Export All Affiliate</button>
                                    </form>
                                </div>
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <div class="results-info-wrapper"></div>
                                </div>
                                <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                    <div class="pagination-wrapper">
                                        {{$all_payment->links('partials.adminPagination')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- end: page -->
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
        $('#selectedexport').val = '';

        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.on').attr('disabled', false);
                $('#selected').val(favorite);
                $('#selectedpaid').val(favorite);
                $('#selectedextract').val(favorite);
                $('#selectedexport').val(favorite);
            } else {
                $('.btn.on').attr('disabled', true);
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
