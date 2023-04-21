@extends('layouts.admin')
@section('content')
@php
    $dd1 = \App\Prediction::all();
    $dd = \App\Prediction::orderBy('created_at', 'DESC')->paginate(10);
    $pt = \App\Prediction::where('status', 1)->get();
    $dt = \App\Prediction::where('status', 0)->get();
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
									<label class="ws-nowrap me-3 mb-0">General Stats:</label>
									<select class="form-control select-style-1 filter-by" name="filter-by">
										<option selected>All({{$dd1->count()}})</option>
										<option><a href="{{route('adminTreadsPublished')}}">Active ({{$pt->count()}})</a></option>
										<option><a href="{{route('adminTreadsDraft')}}">Inactive ({{$dt->count()}})</a></option>
									</select>
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
								<th width="8%">S/N</th>
								<th width="26%">Quiz</th>
								<th width="26%">Answer</th>
								<th width="8%">Status</th>
								<th width="10%">Date</th>
								<th width="19%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dd as $ui)
							<tr>
								<td><a href="{{route('quizAnswers', $ui->id)}}"><strong>{{$counter++}}</strong></a></td>
								<td>
									<h5>{{$ui->title ? $ui->title : '#'.$ui->id}}</h5>
									<p class="text-xs text-secondary mb-0"><a href="{{route('quizAnswers', $ui->id)}}">{{$ui->content ? \Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $ui->content), 100)) : 'No contents'}}</a></p>
								</td>
								<td>
									@if ($ui->answer)
									<p class="text-sx text-primary mb-0">{{$ui->answer ? \Str::limit(strip_tags($ui->answer), 10) : 'No contents'}}  </p>
									<button  type="button"
									class="btn btn-info btn-sm edit-quiz"
									data-id={{$ui->id}}
									data-answer={{$ui->answer}}
									data-title={{$ui->title}}
									> Edit Answer</button>
									@else
									<button type="button"
									class="btn btn-primary edit-quiz"
									data-id={{$ui->id}}
									data-answer={{$ui->answer}}
									data-title={{$ui->title}}
									> Add Answer</button>
									@endif
								</td>
								<td>{{$ui->status == '1' ? 'Active' : 'Inactive'}}</td>
								<td>{{$ui->created_at->diffForHumans()}}</td>
								<td class="actions">
									<a href="{{route('deleteQuizPost', $ui->id)}}" class="btn btn-sm btn-danger text-light"><i class="bx bx-trash"></i> </a>
									<a href="{{route('disableQuizPost', $ui->id)}}" class="btn btn-sm btn-warning text-light"><i class="bx bx-pen"></i> </a>
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
									{{$dd->links('partials.pagination')}}
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

<div class="modal fade " id="editQuiz" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="form-element " action="{{route('editQuizPost')}}" method="post" >
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel">Add Anwser For <span class="title fw-bolder"></span> </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="quiz-id" value="" name="id">
                            <div class="form-group row">
                                <label class="col-sm-2 form-label">Answer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control quiz-answer" name="answer" value="" placeholder="add quiz annswer" required autocomplete="off"/>
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
        $('.edit-quiz').on('click', function (){
            var modal = $('#editQuiz');
            modal.find('.quiz-id').val($(this).data('id'));
            modal.find('.quiz-answer').val($(this).data('answer'));
            modal.find('.title').html($(this).data('title'));
            modal.modal('show');

        });
    })(jQuery);
</script>
@stop
