@extends('layouts.admin')

@section('content')
    <form action="{{route('advertEditPost', $tread->id)}}" method="post" >
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
                                    <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Post Title</label>
                                    <div class="col-lg-7 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="title" value="{{old('title') ? old('title') : $tread->title}}" required />
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Post Content</label>
                                    <div class="col-lg-8 col-xl-6">
                                        <textarea class="form-control form-control-modern" name="contents" id="tinymce" >{!! htmlspecialchars($tread->content ? $tread->content : '') !!}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-4 col-xl-3 control-label text-lg-end pt-2 mt-1 mb-0">Advert Link</label>
                                    <div class="col-lg-8 col-xl-6">
                                        <input type="text" class="form-control form-control-modern" name="link" value="{{old('link') ? old('link') : $tread->ad_link}}" required />
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
                                <h2 class="card-big-info-title">Post Image</h2>
                                <p class="card-big-info-desc">Upload your Post image.</p>
                            </div>
                            <div class="col-lg-3-5 col-xl-4-5">
                                <div class="form-group row align-items-center">
                                    <input type="file" value="{{old('featured_image') ? old('featured_image') : $tread->featured_image}}" class="form-control" name="featured_image">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>    

        <div class="row my-4">
            <div class="col-md-6">
                <div class="d-flex flex-column card card-body">
                    <button type="submit" class="btn btn-primary mb-2">Save Edit</button>
                    <a href="{{route('treadID', $tread->id)}}" target="_blank" class="btn btn-info mb-2"> Preview</a>  
                </div> 
            </div>
        </div>
    </form>

    <div class="row my-4">
        <div class="col-md-6">
            <div class="card card-body">
                <h3>Last Updated <span class="badge badge-primary">{{date_to_word($tread->updated_at)}}</span></h3> 
                <h3>Post Created By <span class="badge badge-primary">{{$tread->user->fullname}}</span></h3> 
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