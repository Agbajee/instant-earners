@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header bg-primary">
                    <h4>How It Works</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('adminHowItWorkSitePost')}}">
                        @csrf
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="tinymce" class="form-control form-modern" name="content_2">
                                    @if($howItWorks)
                                        {!! $howItWorks->content !!}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save How it Works</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header bg-primary">
                    <h4>How To Register</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('adminHowToRegisterPost')}}">
                        @csrf
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="tinymce" class="form-control form-modern" name="register_content">
                                    @if($howToRegister)
                                        {!! $howToRegister->content !!}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save How to Register</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header bg-primary">
                    <h4>Terms and Condition</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('adminTermsPost')}}">
                        @csrf
                        <div class="form-group">
                            <div class="form-line">
                                <textarea id="tinymce" class="form-control form-modern" name="terms_content">
                                    @if($terms)
                                        {!! $terms->content !!}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save Terms</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('scripts')
<script>
    var editor_config = {

        path_absolute : "/",
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",

        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor emoticons',
        image_advtab: true,

        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    tinymce.init(editor_config);

    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{asset('vendor/tinymce')}}';


    </script>
@stop
