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
                    </div>
 
                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">
                        <thead>
                            <tr>
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
                                <td><strong>{{$counter++}}</strong></td>
                                <td><a href="javascript:void(0);" class="__cf_email__">{{ \App\Models\User::find($ui->user_id)->fullname }}</a></td>
                                <td>{{ $ui->bank }}</td>
                                <td>{{ $ui->account_num }}</td>
                                <td>₦{{number_format($ui->amount)}}</td>
                                <td><span class="badge badge-danger">Rejected</span></td>
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