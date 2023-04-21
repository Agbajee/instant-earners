@extends('layouts.admin')

@section('styles')
    <link href="{{asset('assets/css/codemirror.css')}}" rel="stylesheet">
@stop

@section('content')
    <div class="container-fluid">
        <h2>Other Settings</h2>
        <div class="card card-body">
            <form action="{{route('siteActivity')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label-floating">transfer fee(%)</label>
                                    <input type="number" class="form-control" value="{{$settings->transfer_fee}}" name="transfer_fee" min="1" max="100" placeholder="calculated in percentage">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Contest Code</label>
                                    <input type="number" class="form-control" value="{{$settings->code_point}}" name="code_fee" min="1" placeholder="charges for contest code">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Market fee</label>
                                    <input type="number" class="form-control" value="{{$settings->market_point}}" name="market_fee" min="1" placeholder="charges per product">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"> Submit</button>
            </form>
        </div>

        <div class="row">
            <div class="col-md-12 ">
                <div class="overflow-hidden my-4">
                    <form method="post" action="{{route('AdminHeaderPost')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="bmd-label-floating">Site Title</label>
                                        <input type="text" value="{{old('title') ? old('title') : $settings->title}}" class="form-control" name="title">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label class="bmd-label-floating">Site Keywords</label>
                                        <input type="text" value="{{old('keywords') ? old('keywords') : $settings->keywords}}" class="form-control" name="keywords">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Favicon</label>
                                            <input type="file" class="form-control" name="favicon">
                                        </div>
                                        <div class="thumb-info mb-3">
                                            <img src="{{asset('images/general/'.$settings->favicon)}}" class="img-fluid" alt="Site Favicon" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                        </div>
                                        <div class="thumb-info mb-3">
                                            <img src="{{asset('images/general/'.$settings->logo)}}" class="img-fluid " alt="site Logo" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Social share logo</label>
                                            <input type="file" class="form-control" name="socialIcon">
                                        </div>

                                        <div class="thumb-info mb-3">
                                            <img src="{{asset('images/general/'.$settings->socialIcon)}}" class="img-fluid" alt="Social Icon" loading="lazy">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mt-5 form-group">
                                    <div class="form-line">
                                        <label class="bmd-label-floating">Site Description</label>
                                        <textarea rows="5" cols="80" id="comment" class="form-control no-resize" name="description" required>{{old('description') ? old('description') : $settings->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Auto Withdrawal Settings</h2>
        <div class="card card-body">
            <form action="{{route('autoWithdrawSettings')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Placement Time</label>
                                    <select name="when" class="form-control">
                                        <option value="1">@lang('1st day of the Month')</option>
                                        <option value="15">@lang('15th day of the Month')</option>
                                        <option value="30">@lang('30th day of the Month')</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"> Update</button>
            </form>
        </div>


    </div>
@stop

@section('scripts')

    <script src="{{asset('assets/js/codemirror.js')}}"></script>
    <script src="{{asset('assets/js/formating.js')}}"></script>
    <script src="{{asset('assets/js/htmlmixed.js')}}"></script>
    <script>


        /*var editor = CodeMirror.fromTextArea(document.getElementById('editor'), {
            mode: "htmlmixed",
            lineNumbers: true,
        });
        editor.save()*/

        var mixedMode = {
            name: "htmlmixed",
            scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
                mode: null},
                {matches: /(text|application)\/(x-)?vb(a|script)/i,
                    mode: "vbscript"}]
        };
        var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
            mode: mixedMode,
            selectionPointer: true,
            lineNumbers: true,

        });


        function autoFormat() {
            editor.setCursor(0,0);
            CodeMirror.commands["selectAll"](editor);
            editor.autoFormatRange(editor.getCursor(true), editor.getCursor(false));
            editor.setCursor(0,0);
        }

        autoFormat();


    </script>
@stop
