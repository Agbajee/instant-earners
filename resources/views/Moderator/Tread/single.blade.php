@extends('layouts.moderator')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/multi-select.css')}}">
@endsection

@section('content')
    <form action="{{route('moderatorTreadsIDPostActions', [$tread->id, 2])}}" method="post" id="save_c">
        <form class="ecommerce-form action-buttons-fixed" method="post" action="{{route('moderatorCategoryEditIDPost', $tread->id)}}">
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

            <div class="row">
                <div class="col">
                    <section class="card card-modern card-big-info">
                        <div class="card-body">
                            <div class="tabs-modern row" style="min-height: 490px;">
                                <div class="col-lg-2-5 col-xl-1-5">
                                    <div class="nav flex-column tabs" id="tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="category-tab" data-bs-toggle="pill" data-bs-target="#category" role="tab" aria-controls="price" aria-selected="true">Category</a>
                                        <a class="nav-link" id="others-tab" data-bs-toggle="pill" data-bs-target="#others" role="tab" aria-controls="inventory" aria-selected="false">Others</a>
                                    </div>
                                </div>
                                <div class="col-lg-3-5 col-xl-4-5">
                                    <div class="tab-content" id="tabContent">
                                        <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="category-tab">
                                            <div class="form-group row  pb-3">
                                                {{-- <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Choose Category</label> --}}
                                                <div class="col-lg-12">
                                                        <?php $the_cat = \App\CategoryTread::where('tread_id', $tread->id)->get();
                                                        if(count($the_cat) > 0){

                                                        foreach ($the_cat as $d){
                                                            $c = $d->cat;
                                                            $selectedCat[$c['name']] = $c['id'];
                                                        //array_push($old_cat, $d->cat->id = $d->cat->name);
                                                        }
                                                        } else {
                                                            $selectedCat = [];
                                                        }

                                                        ?>

                                                        <?php $the_other_cat = \App\Category::all()->pluck('name', 'id'); ?>
                                                            {!! Form::select('select[]', $the_other_cat->toArray(), $selectedCat,
                                                                ['class' => 'form-control my-select',
                                                                'id' => 'selected_cat',
                                                                'multiple' => 'multiple'])
                                                        !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="others-tab">
                                            <div class="form-group row align-items-center pb-3">
                                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Source Link(optional)</label>
                                                <div class="col-lg-7 col-xl-6">
                                                    <input type="text" class="form-control form-control-modern" name="source_link" id="source_link" value="{{$tread->tread_source ? $tread->tread_source : ''}}" />
                                                </div>
                                            </div>
                                            <div class="form-group row align-items-center pb-3">
                                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Post Source(optional)</label>
                                                <div class="col-lg-7 col-xl-6">
                                                    <div class="">
                                                        <label class="my-2">
                                                            <input type="text" value="{{$tread->tread_source_name ? $tread->tread_source_name : ''}}"  name="source_name" id="source_name">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="form-check-input" type="hidden" id="post" name="is_tread" checked>
                                            <input class="form-check-input" id="comment" type="hidden" name="is_commentable">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </form>

    <div class="row my-4">
        <div class="col-md-6">
        <div class="d-flex flex-column card card-body">
            <button type="button" id="edit_tread" class="btn btn-success mb-2" id="publish">Save Edit</button>
            <a href="{{route('treadID', $tread->id)}}" target="_blank" class="btn btn-info mb-2"> Preview</a>

            @if($tread->status == 1)
            <form action="{{route('moderatorTreadsIDPostActions', [$tread->id, 1])}}" id="saveDraft" method="post" class="btn btn-warning mb-2">
                @csrf
                <button type="submit" id="saveDraftBtn" class="btn btn-warning">Save to Draft</button>
            </form>
            @endif

            @if($tread->status == 0)
            <form action="{{route('moderatorTreadsIDPostActions', [$tread->id, 4])}}" id="saveDraft" method="post"  class="btn btn-info mb-2">
            @csrf
                <button type="submit" id="saveDraftBtn" class="btn btn-info "> Make Tread Visible</button>
            </form>
            @endif

            <form action="{{route('moderatorTreadsIDPostActions', [$tread->id, 3])}}" method="post" class="btn btn-danger mb-2">
            @csrf
                <button type="submit" class="btn btn-danger" id="d_idd"> Delete</button>
            </form>

        </div>
        </div>


        <div class="col-md-6">
            <div class="card card-body">
                <h3>Last Updated <span class="badge badge-primary">{{$tread->updated_at->diffForHumans()}}</span></h3>
                <h3>Post Created By <span class="badge badge-primary">{{$tread->user->fullname}}</span></h3>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#selected_cat').multiSelect();

        $('#saveDraftBtn').on('click', function (e) {
                e.preventDefault();
                $('#save_c').attr('action', "{{route('moderatorTSelectedDraft')}}").submit();
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
