@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header bg-primary">
        Editing : {{$data->name}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                    <form method="post" action="{{route('editBundlePost', $data->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 my-3">
                                <div class="form-group">
                                        <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $data->name }}">
                                </div>
                            </div>

                            <div class="col-sm-6 my-3">
                                <div class="form-group">
                                        <label>Link</label>
                                    <input type="text" class="form-control" placeholder="Link here" name="link" value="{{ $data->link }}">
                                </div>
                            </div>

                            <div class="col-sm-6 my-3">
                                <div class="form-group">
                                    <label>Points</label>
                                    <input type="number" class="form-control" placeholder="Amount (Unit Points)" name="points" value="{{ $data->points }}">
                                </div>
                            </div>

                            <div class="col-sm-6 my-3">
                                <label for="rangeInput">Duration</label>
                                <input id="rangeInput" type="range" min="10" max="100" class="form-control-range" placeholder="10" name="days" value="{{ $data->days }}" oninput="rangeOutput.value = rangeInput.value">
                                <output class="btn btn-sm bg-gradient-info" id="rangeOutput" >{{ $data->days }}</output>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
@stop