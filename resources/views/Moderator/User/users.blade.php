@extends('layouts.moderator')

@section('content')
@php
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
                                <form method="get" action="{{route('moderatorSearchUsers')}}">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input id="search-term" name="term" type="text" class="search-term form-control" placeholder="Type here...">
                                            <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <div class="nav-wrapper position-relative end-0">
                                  <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link mb-0 px-0 py-1 "  href="javascript:void(0);">
                                        <span class="ms-1">Blocked
                                           <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{$the_block}}</span> 
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Vendor</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($users as $ui)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$ui->fullname}}</td>
                                <td>{{$ui->username}}</td>
                                <td>{{ $ui->is_vendor == 1 ? 'Yes' : 'No' }}</td>  
                                <td>{{$ui->email}}</td>
                                <td>
                                    @if($ui->is_block)
                                    <a title="Unblock User" href="{{route('adminUsUnID', $ui->id)}}" type="submit" class="btn btn-success btn-2 text-light" onclick="confirmAction(event)">
                                        <i class="bx bx-lock-open"></i>
                                    </a>
                                    @else
                                    <a href="{{route('adminUsID', $ui->id)}}" type="submit" class="btn btn-danger btn-2 text-light" onclick="confirmAction(event)">
                                        <i class="bx bx-lock"></i>
                                    </a>
                                    @endif
                                    <button
                                    class="btn btn-info edit-user"
                                    data-fullname="{{$ui->fullname}}"
                                    data-id="{{$ui->id}}"
                                    > <i class="bx bx-edit"></i> </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="datatable-footer">
                        <div class="row align-items-center justify-content-between mt-3">
                            <div class="col-lg-auto text-center order-3 order-lg-2">
                                <div class="results-info-wrapper"></div>
                            </div>
                            <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                <div class="pagination-wrapper">
                                    {{$users->links('partials.pagination')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="editProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-element " action="{{route('userEditSubmit')}}" method="post" >
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">Chnage Password For <span class="title fw-bolder"></span> </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="user-id" value="" name="id">
                            <div class="form-group row">
                                <label class="col-sm-2 form-label">New Passworrd</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control password" name="new_password" required autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    "user strict";
    (function ($) {
        $('.edit-user').on('click', function (){
            var modal = $('#editProduct');
            modal.find('.user-id').val($(this).data('id'));
            modal.find('.title').html($(this).data('fullname'));
            modal.modal('show');

        });
    })(jQuery);
</script>
@stop