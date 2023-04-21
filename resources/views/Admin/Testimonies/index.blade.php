@extends('layouts.admin')
@section('content')
<!-- start: page -->
<div class="row">
    <div class="col">
        <div class="card card-modern">
            <div class="card-body">
                <div class="datatables-header-footer-wrapper mt-2">
                    <div class="datatable-header">
                        <div class="row align-items-center mb-3">
                            <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                    <a href="{{ route('createTestimony') }}" class="btn btn-primary">Create New</a>
                                </div>
                            </div>
                            <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                    <label class="ws-nowrap me-3 mb-0">Filter By:</label>
                                    <select class="form-control select-style-1 filter-by" name="filter-by">
                                        <option value="all" selected>All</option>
                                        <option value="1">S/N</option>
                                        <option value="2">Post</option>
                                        <option value="3">Status</option>
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
                                <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                    <div class="input-group">
                                        <input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Search Category">
                                        <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 550px;">

                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox" class="checkbox-style-1 p-relative top-2" id="b-select" />
                                    <label class="custom-control-label" for="b-select"></label>
                                </th>
                                <th width="5%">S/N</th>
                                <th width="55%">Content</th>
                                <th width="40%">Name</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_testimonies as $ui)
                            <tr>
                                <td width="30">
                                    <label class="custom-control-label" for="b-{{$ui->id}}"></label>
                                    <input type="checkbox" class="checkbox-style-1 p-relative top-2" value="" id="b-{{$ui->id}}" />
                                </td>

                                <td><a href="{{route('treadID', $ui->id)}}"><strong>{{$counter++}}</strong></a></td>
                                <td>
                                    <p class="text-xs text-secondary mb-0"><a href="{{route('treadID', $ui->id)}}">{{$ui->testimony ? \Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $ui->testimony), 100)) : '---'}}</a></p>
                                </td>
                                <td>
                                    <h5>{{$ui->fullname}}</h5>
                                </td>

                                <td class="actions">
                                    <a href="{{route('deleteTestimonyPost', $ui->id)}}" class="btn btn-sm btn-danger text-light"><i class="bx bx-trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="solid mt-5 opacity-4">
                    <div class="datatable-footer">
                        <div class="row align-items-center justify-content-between mt-3">
                            <div class="col-md-auto order-1 mb-3 mb-lg-0">
                                <div class="d-flex align-items-stretch">
                                    <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                                        <select class="form-control select-style-1 bulk-action" name="bulk-action" style="min-width: 170px;">
                                            <option value="" selected>Bulk Actions</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <a href="#" class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-auto text-center order-3 order-lg-2">
                                <div class="results-info-wrapper"></div>
                            </div>
                            <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                <div class="pagination-wrapper">
                                    {{$all_testimonies->links('partials.pagination')}}
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

        $('.s_d_i_22').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

        // var favorite = [];
        // var check_stat = 0;
        // var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        // $('#b-all').on('click', function () {
        //     check_stat = 1;

        // });

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


		$('#b-select').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });


    </script>
@stop
