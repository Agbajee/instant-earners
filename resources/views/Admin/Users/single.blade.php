@extends('layouts.admin')
@section('content')
<form class="ecommerce-form action-buttons-fixed my-5" method="post" action="{{ route('updateBalance',  $user->id) }}"autocomplete="off">
    @csrf
    <div class="row">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-xl-3">
                            <i class="card-big-info-icon bx bx-money"></i>
                            <h2 class="card-big-info-title">User Earnings</h2>
                            <p class="card-big-info-desc">Edit Earnings for <strong>{{$user->username}}</strong></p>
                        </div>

                        <div class="col-lg-3 col-xl-3 bg-primary">
                            <div class="card fs-6 text-white">
                                <div class="mt-2">Affiliate Balance: ₦{{number_format($user->balance)}}</div>
                                <div class="mt-2">Indirect Balance: ₦{{number_format($user->indirect_ref)}}</div>
                                <div class="mt-2">Activity Balance: {{number_format($user->allowi_balance)}} points</div>
                            </div>

                        </div>

                        <div class="col-lg-6 col-xl-6">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Action</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input name="action" type="checkbox" data-toggle="switchbutton" checked data-onlabel="Add" data-offlabel="Remove" data-onstyle="success" data-offstyle="danger">
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Amount</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="number" class="form-control form-control-modern" name="amount" value="{{old('amount')}}"/>
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Balance Type</label>
                                <div class="col-lg-7 col-xl-6">
                                   <select name="type" id="" class="form-control form-control-mordern">
                                    <option value="affiliate" selected>Affiliate</option>
                                    <option value="indirect">Indirect Affilaite</option>
                                    <option value="activity">Activity</option>
                                   </select>
                                </div>
                            </div>

                            <div class="form-group row align-items-center pb-3">
                                <div class="col-lg-12 col-xl-12">
                                    <button type="submit" class="btn-custom d-flex align-items-center font-weight-semibold">
                                        <i class="bx bx-money bx-burst text-4 me-2"></i> Edit Earnings
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
</form>

<form class="ecommerce-form action-buttons-fixed my-5" action="{{route('adminUsEditPost', $user->id)}}" method="post">
    @csrf
    <div class="row">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-user-circle"></i>
                            <h2 class="card-big-info-title">Users Info</h2>
                            <p class="card-big-info-desc">Add here the user's info with all details and necessary information <small class="text-danger">(not editable)</small>.</p>
                        </div>

                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Fullname</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="fullname" value="{{$user->fullname}}"/>
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Username</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="username" value="{{$user->username}}" readonly />
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Referral ID</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="referral_id" value="{{$user->referral_id}}" readonly />
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Plan</label>
                                <div class="col-lg-7 col-xl-6">
                                    @php $plan_name = \App\Models\Plan::where('id', $user->plan)->first()->name; @endphp
                                    <input type="text" class="form-control form-control-modern" name="is_plan" value="{{$plan_name}}" readonly />
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Email</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="email" value="{{$user->email}}" readonly/>
                                </div>
                            </div>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Phone</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="text" class="form-control form-control-modern" name="number" value="{{$user->number ? $user->number : 'empty'}}"/>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Google 2FA @if ($user->tsc) <i class="fa fa-check-circle text-info"></i> @endif</label>
                                <div class="col-lg-7 col-xl-6">
                                    <div class="form-check">
                                        <input name="gfa" type="checkbox" data-toggle="switchbutton" @if ($user->gfa) checked @endif data-offlabel="<i class='bx bx-power-off'></i> OFF" data-onlabel="<i class='bx bx-power-off'></i> ON" data-onstyle="primary" data-offstyle="dark">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="submit-button btn-custom btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1 " data-loading-text="Loading...">
                        <i class="bx bx-save text-4 me-2"></i> Save user
                    </button>
                </div>
            </section>
        </div>
    </div>
</form>

<form class="ecommerce-form action-buttons-fixed my-5" method="post" action="{{route('adminUsEditPasswordPost', $user->id)}}"autocomplete="off">
    @csrf
    <div class="row">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-lock"></i>
                            <h2 class="card-big-info-title">Account Security</h2>
                            <p class="card-big-info-desc">Edit Users Password</p>
                        </div>

                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="form-group row align-items-center pb-3">
                                <label class="col-lg-5 col-xl-3 control-label text-lg-end mb-0">Password</label>
                                <div class="col-lg-7 col-xl-6">
                                    <input type="password" class="form-control form-control-modern" name="new_password" value="" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger align-items-right font-weight-semibold line-height-1">
                        <i class="bx bx-lock-alt text-4 me-2"></i> Change Password
                    </button>
                </div>
            </section>
        </div>
    </div>

</form>


<form class="ecommerce-form action-buttons-fixed my-5" action="{{route('resendVerification', $user->id)}}" method="post">
    @csrf
    <div class="row">
        <div class="col">
            <section class="card card-modern card-big-info">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2-5 col-xl-1-5">
                            <i class="card-big-info-icon bx bx-mail-send"></i>
                            <h2 class="card-big-info-title">Custom Email</h2>
                            <p class="card-big-info-desc">Send Custom Email To User</p>
                        </div>

                        <div class="col-lg-3-5 col-xl-4-5">
                            <div class="col-lg-12">
                                <textarea class="form-control form-control-modern" name="note" id="tinymce" >{!! htmlspecialchars(old('note')) !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary align-items-right font-weight-semibold line-height-1">
                        <i class="bx bx-mail-send text-4 me-2"></i> Send Email
                    </button>
                </div>
            </section>
        </div>
    </div>
</form>

<div class="row mt-4">
    <div class="col-6 col-md-auto">
        @if($user->is_block)
        <a href="{{route('adminUsUnID', $user->id)}}" class="delete-button btn btn-success py-3 align-items-right font-weight-semibold line-height-1">
            <i class="bx bx-volt text-4 me-2"></i> Unlock User
        </a>
        @else
        <a href="{{route('adminUsID', $user->id)}}" class="delete-button btn btn-danger py-3 align-items-right font-weight-semibold line-height-1">
            <i class="bx bx-volt text-4 me-2"></i> Block User
        </a>
        @endif
    </div>
</div>
@stop

@section('scripts')
    <script>
        $('#selected').val = '';
        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
            } else {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', true);
            }
        });
    </script>
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
