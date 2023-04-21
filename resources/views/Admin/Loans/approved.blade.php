@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$all->links('partials.pagination')}}
                                </div>
                            </div>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach($all as $ui)
                                    <tr>
                                        <td width="5%">{{$counter++}}</td>
                                        <td>{{ $ui->user_info['fullname'] }}</td>
                                        <td>{{$ui->loan_amount}}</td>
                                        <td class="{{ $status[$ui->paid]['class'] ?? 'unknown' }}">{{ $status[$ui->paid]['label'] ?? 'unknown' }}</td>
                                        <td>
                                            @if (!$ui->paid)
                                            <a href="{{route('settleLoan', $ui->id)}}" title="Settle Loan" class="btn btn-sm btn-success btn-2 text-light">Mark as settled </a>
                                            @else
                                            <span class="badge badge-primary">Settled Loan</span>
                                            @endif
                                            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </div>

@stop
@section('scripts')
    <script>
        "user strict";
        (function ($) {
            $('.expandss').on('click', function (){
                var modal = $('#expandDetails');
                modal.find('.name').html($(this).data('fullname'));
                modal.find('.email').html($(this).data('email'));
                modal.find('.phone').html($(this).data('phone'));
                modal.find('.purpose').html($(this).data('purpose'));

                modal.modal('show');

            });
        })(jQuery);
    </script>
@stop
