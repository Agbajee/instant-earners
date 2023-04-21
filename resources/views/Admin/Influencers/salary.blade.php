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
                                            <option value="all" selected>All({{$all->count()}})</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <form class="p-2" id="selected_all" action="{{route('rejectSalary')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn btn-danger on  btn-sm" id="s_d_i" disabled="disabled" type="submit">Reject</button>
                            </form>
                            
                            <form class="p-2" id="selected_all" action="{{route('extractAllSalary')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedextract">
                                <button class="btn btn-primary on  btn-sm" id="s_d_i" disabled="disabled" type="submit">Extract</button>
                            </form>
                            
                            <form class="p-2" id="selected_all" action="{{route('payAllSalary')}}" method="post">
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
                                <th width="20%">Name</th>
                                <th width="25%">Bank</th>
                                <th width="20%">Acc Numb</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all as $ui)
                            <tr>
                                <td width="30">
                                    <div id="checkie_id">
                                        <form autocomplete="off">
                                            <input type="checkbox" class="checkbox-style-1 p-relative top-2 filled-in sp" id="b-{{$ui->user_id}}" name="{{$ui->user_id}}"/>
                                            <label for="b-{{$ui->user_id}}"></label>
                                        </form>
                                    </div>
                                </td>
                                <td><strong>{{$counter++}}</strong></td>
                                <td><a href="javascript:void(0);" class="__cf_email__">{{ \App\Models\User::find($ui->user_id)->fullname }}</a></td>
                                <td>{{ $ui->bank }}</td>
                                <td>{{ $ui->account_num }}</td>
                                <td>₦{{number_format($ui->amount)}}</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="solid mt-5 opacity-4">
                    <div class="datatable-footer">
                        <div class="row align-items-center justify-content-between mt-3">
                            {{-- <div class="col-lg-auto text-center order-3 order-lg-2">
                                <form class="p-2" id="selected_all" action="{{route('allAffiliateExport')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="selected">
                                    <button class="btn btn-primary btn-sm"  type="submit">Export All Affiliate</button>
                                </form>
                            </div> --}}
                            <div class="col-lg-auto text-center order-3 order-lg-2">
                                <div class="results-info-wrapper"></div>
                            </div>
                            <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                <div class="pagination-wrapper">
                                    {{$all->links('partials.adminPagination')}}
                                </div>
                            </div>
                        </div>
                    </div>
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