@extends('layouts.admin')
@section('content')
@php
    $counter = 1;
@endphp

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
										<button type="button" data-bs-target="#createContest" data-bs-toggle="modal" class="btn btn-primary"> <i class='bx bx-bookmark-alt-plus'></i> Create Contest</button>
									</div>
								</div>

								<div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
									<div class="d-flex align-items-lg-center flex-column flex-lg-row">
										<label class="ws-nowrap me-3 mb-0">Showing:</label>
										<select class="form-control select-style-1 results-per-page" name="results-per-page">
											<option value="10" selected>10</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 550px;">

							<thead>
								<tr>
									<th width="10%">S/N</th>
									<th width="30%">Contest</th>
									<th width="40%">Description</th>
									<th width="5%">status</th>
									<th width="5%">Participants</th>
									<th width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($all as $item)
								<tr>
									<td><strong>{{$counter++}}</strong></td>
									<td>
										<h5>{{$item->name}}</h5>
									</td>
									<td>{{$item->description}}</td>
									<td>{!! $item->status == '1' ? '<span class="badge badge-success">Active</span>': '<span class="badge badge-warning">Disabled</span>' !!}</td>
									<td>{{$item->users}}</td>
									<td class="actions">
                                        @if ($item->status)
                                            <a href="{{route('adminContestEdit', $item->id)}}" class="btn btn-sm btn-warning text-light"><i class="bx bx-error-circle"></i> </a>
                                        @else
                                            <a href="{{route('adminContestEdit', $item->id)}}" class="btn btn-sm btn-success text-light"><i class="bx bx-check-circle"></i> </a>
                                        @endif
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
								<div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
									<div class="pagination-wrapper">
										{{$all->links('partials.pagination')}}
									</div>
								</div>
							</div>
						</div>
				    </div>
			    </div>
		    </div>
	    </div>
    </div>
	<!-- end: page -->

    <!-- Modal -->
<div class="modal fade" id="createContest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <form action="{{route('adminContestCreate')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Create New Contest</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="cat-id" value="" name="id">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Name</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="name" required autocomplete="off"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Contest Description  </label>
                                <div class="col-lg-8 col-xl-6">
                                    <textarea class="form-control form-control-modern " name="description" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>

    </div>
  </div>
@stop
