@extends('layouts.admin')
@section('content')
@php
    $counter = 1;
@endphp
<form action="{{route('submitMarketCategory')}}" method="post" >
@csrf
    <div class="row mt-2">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-box"></i>
                            <h2 class="card-big-info-title">Create New Category</h2>
                        </div>
                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Name</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="name" value="{{old('name')}}" required autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Category Description <small class="text-danger">Not required...</small> </label>
                                <div class="col-lg-8 col-xl-6">
                                    <textarea class="form-control form-control-modern" name="description" required></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row action-buttons">
        <div class="col-12 col-md-auto">
            <button type="submit" class="submit-button btn btn-primary btn-px-4 my-3 d-flex align-items-center font-weight-semibold line-height-1">
                <i class="bx bx-save text-4 me-2"></i> Upload
            </button>
        </div>

    </div>
</form>

<div class="row mt-4">
    <div class="col-md-12">
        <section class="card card-modern card-big-info">
            <div class="card-body px-4">
                <div class="datatables-header-footer-wrapper mt-2">
                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 550px;">
                        <thead>
                            <tr>
                                <th width="5%">S/N</th>
                                <th width="5%">Edit</th>
                                <th width="25%">Name</th>
                                <th width="65%">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td><strong>{{$counter++}}</strong></td>
                                <td class="actions">
                                    <button type="button"
                                        class="btn btn-info text-light btn-edit"
                                        data-id="{{$item->id}}"
                                        data-category-name="{{$item->category_name}}"
                                        data-description="{{$item->description}}">
                                        <i class="bx bx-pen"></i>
                                    </button>
                                </td>
                                <td>
                                    <h5>{{$item->category_name}}</h5>
                                </td>
                                <td>
                                    <p>{!!$item->description!!}</p>
                                </td>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="editCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('editMarketCategory')}}" method="post" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editing-<span class="title"></span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="card card-modern card-big-info">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" class="cat-id" value="" name="id">
                                    <div class="form-group row align-items-center pb-3">
                                        <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Name</label>
                                        <div class="col-lg-7 col-xl-6">
                                            <input type="text" class="form-control form-control-modern category-name" name="name" value="" required autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Category Description</label>
                                        <div class="col-lg-8 col-xl-6">
                                            <textarea class="form-control form-control-modern description" name="description" required></textarea>
                                        </div>
                                    </div>
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
            $('.btn-edit').on('click', function (){
                var modal = $('#editCategory');
                modal.find('.cat-id').val($(this).data('id'));
                modal.find('.category-name').val($(this).data('category-name'));
                modal.find('.description').val($(this).data('description'));
                modal.find('.title').html($(this).data('category-name'));

                modal.modal('show');

            });
        })(jQuery);
    </script>
@stop
