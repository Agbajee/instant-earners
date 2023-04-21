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
                                        <td class="{{ $status[$ui->status]['class'] ?? 'unknown' }}">{{ $status[$ui->status]['label'] ?? 'unknown' }}</td>
                                        <td>
                                            <button type="button" 
                                                title="Expand"
                                                class="btn btn-info btn-2 text-light expandss"
                                                data-fullname="{{ $ui->user_info['fullname'] }}"
                                                data-email="{{ $ui->user_info['email'] }}"
                                                data-phone="{{ $ui->user_info['phone'] }}"
                                                data-purpose="{{ $ui->user_info['purpose'] }}"
                                                >
                                                <i class="bx bx-expand bx-tada"></i> 
                                            </button> || 
                                            <a href="{{route('approveLoan', $ui->id)}}" title="Approve" class="btn btn-sm btn-success btn-2 text-light"><i class="bx bx-check bx-flashing"></i> </a>
                                            <a href="{{route('rejectLoan', $ui->id)}}" title="Reject" class="btn  btn-sm btn-danger btn-2 text-light"><i class="bx bx-trash"></i> </a>
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

    <div class="modal fade" id="expandDetails" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"> <span class="name"></span> Loan Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4> <strong>Fullname:</strong> <span class="name"></span> </h4>
                    <h5> <strong>Email:</strong> <span class="email"></span> </h4>
                    <h5> <strong>Phone:</strong> <span class="phone"></span> </h4>
                    <p> <strong>Loan Purpose</strong> <span class="purpose"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
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
