@extends('layouts.admin')
@section('content')
@php
    $the_notification = \App\Models\siteNotifcation::first();
@endphp
    <div class="container-fluid">
        <div class="card card-body blur shadow-blur my-4 overflow-hidden">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card-body">

                        <form method="post" action="{{route('adminNotificationSitePost')}}">
                            @csrf

                            
                            <div class="form-check form-switch">
                                @if($the_notification && $the_notification->status == '1')
                                <input type="checkbox" name="status" id="switch" class="form-check-input" checked>
                                @else
                                <input type="checkbox" name="status" id="switch" class="form-check-input">
                                @endif
                                <label class="form-check-label" for="switch">Turn on</label>
                            </div>
                            
                            @if($errors->has('status'))
                                <div class="alert alert-error">
                                    {!!  $errors->get('status')[0] !!}
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="5" cols="80" id="tinymce" class="form-control no-resize" name="content_2">
                                        @if($the_notification)
                                            {!! $the_notification->content !!}
                                        @endif
                                    </textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-block">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')

    <script>


        $('#saveDraftBtn').on('click', function (e) {
            e.preventDefault();
            $('#save_c').attr('action', "{{route('adminTSelectedDraft')}}").submit();
        });

        $('#d_idd').on('click', function (event) {
            var cc = confirm('Are your sure you want to do this');
            if(cc == true){
                return true
            }else {
                return event.preventDefault();
            }
            $('#saveDraft').submit();
        });

        $('#edit_tread').on('click', function () {
            $('#save_c').submit();
        });

        var editor_config = {

            path_absolute : "/",
            selector: "textarea#tinymce",
            theme: "modern",
            height: 300,
            content_style: ".mce-content-body {font-size:15px;font-family:work sans,sans-serif;}",

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