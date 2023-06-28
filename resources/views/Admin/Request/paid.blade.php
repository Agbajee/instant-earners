@extends('layouts.admin')
@section('content')
@php 
    $all_payment = \App\Models\payoutRequest::where('is_payed', 1)->paginate(20);
    $counter = 1;
@endphp

<div class="row">
    <div class="col">

        <div class="card card-modern">
            <div class="card-body">
                <div class="datatables-header-footer-wrapper">
                    <div class="datatable-header">
                        <div class="row align-items-center mb-3">
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="solid mt-5 opacity-4">
                    <div class="datatable-footer">
                        <div class="row align-items-center justify-content-between mt-3">
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


    </script>
@stop