@extends('layouts.admin')
@section('content')
<form action="{{route('createQuizPost')}}" method="post" enctype='multipart/form-data'>
@csrf
    <div class="row mt-2">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-box"></i>
                            <h2 class="card-big-info-title">General Info</h2>
                            <p class="card-big-info-desc">Add here the post description with all details and necessary information.</p>
                        </div>
                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Prediction Title</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="title" value="{{old('title')}}" required />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Prediction Instructions <small class="text-danger">Not required...</small> </label>
                                <div class="col-lg-8 col-xl-6">
                                    <textarea class="form-control form-control-modern" name="content" ></textarea>
                                </div>
                            </div>

                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Prediction Answer</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="answer" value="{{old('answer')}}" required />
                                </div>
                            </div>

                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Prediction Cost</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="number" class="form-control form-control-modern" name="cost" value="{{old('cost')}}" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-camera"></i>
                            <h2 class="card-big-info-title">Prediction Image</h2>
                            <p class="card-big-info-desc">Upload image.</p>
                        </div>
                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center">
                                <div class="col">
                                    <div id="dropzone-form-mage" class="dropzone-moern dz-square">
                                        <span class="dropzone-uload-message text-center">
                                            <input type="file" value="{{old('featured_image') ? old('featured_image') : ''}}" class="form-control" name="image">
                                        </span>
                                    </div>
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
            <button type="submit" class="submit-button btn btn-primary btn-px-4 my-3 d-flex align-items-center font-weight-semibold line-height-1"
                <i class="bx bx-save text-4 me-2"></i> Upload
            </button>
        </div>

    </div>
</form>
@stop

@section('scripts')

    <script>
        $('#selected_cat').multiSelect();
    </script>

@stop
