@extends('layouts.moderator')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/multi-select.css')}}">
@endsection

@section('content')
<form class="ecommerce-form action-buttons-fixed" method="post" action="{{route('ContestCodeVerify')}}">
    @csrf
    <div class="row mt-2">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Paste Code</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="code" value="{{old('code')}}" required autocomplete="off"/>
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
            <button type="submit" id="saveDraftBtn" class="submit-button btn btn-primary btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1" data-loading-text="Loading...">
                <i class="bx bx-save text-4 me-2"></i> Check Code
            </button>
        </div>
    </div>
</form>
@stop
