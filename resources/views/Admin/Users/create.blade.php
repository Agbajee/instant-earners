@extends('layouts.admin')
@section('styles')
    <link href="{{asset('assets/admin_we2/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@stop

@section('content')
    <div class="container-fluid">

        @if(\Session::has('info'))
        <div class="alert bg-green">
           {{\Session::get('info')}}
        </div>
        @endif

        @if(\Session::has('error2'))
        <div class="alert bg-red">
           {{\Session::get('error2')}}
        </div>
        @endif

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="the_sc">
                            <form method="post" action="{{route('adminUsersCreatePost')}}" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Register Under</label>
                                        <select class="form-control" name="referral_id">
                                            <?php $user = App\User::all(); ?>
                                            @foreach($user as $u)
                                            <option value="{{$u->referral_id}}"  data-subtext="{{$u->referral_id}}">{{$u->username}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if($errors->has('referral_id'))
                                        <div class="er">
                                            {!!  $errors->get('referral_id')[0] !!}
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                    <label>Full Name</label>
                                    <input type="text" value="{{old('fullname')}}" class="form-control" name="fullname" required>
                                    </div>

                                    @if($errors->has('fullname'))
                                        <div class="er">
                                            {!!  $errors->get('fullname')[0] !!}
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Wallet balance (₦)</label>
                                        <input type="text" value="{{old('balance') ? old('balance') : '0'}}" class="form-control" name="balance" required>
                                    </div>

                                    @if($errors->has('balance'))
                                        <div class="er">
                                            {!!  $errors->get('balance')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Phone</label>
                                        <input type="text" value="{{old('number')}}" class="form-control" name="number" required>
                                    </div>

                                    @if($errors->has('number'))
                                        <div class="er">
                                            {!!  $errors->get('number')[0] !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Username</label>
                                        <input type="text" value="{{old('username')}}" class="form-control" name="username" required>
                                    </div>

                                    @if($errors->has('username'))
                                        <div class="er">
                                            {!!  $errors->get('username')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                    <label>Email</label>
                                    <input type="text" value="{{old('email')}}" class="form-control" name="email" required>
                                    </div>

                                    @if($errors->has('email'))
                                        <div class="er">
                                            {!!  $errors->get('email')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                    <label>Membership status</label>
                                    <select class="form-control" name="proship">
                                        <option value="0">Not Pro </option>
                                        <option value="1">Make Pro </option>
                                    </select>
                                    </div>

                                    @if($errors->has('proship'))
                                        <div class="er">
                                            {!!  $errors->get('proship')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="form-line">
                                    <label>Password</label>
                                    <input type="password" value="{{old('password')}}" class="form-control" name="password" required>
                                    </div>

                                    @if($errors->has('password'))
                                        <div class="er">
                                            {!!  $errors->get('password')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Edit Profile</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset("assets/admin_we2/plugins/bootstrap-select/js/bootstrap-select.js")}}"></script>

    <script>
        /*var favorite = [];
        var check_stat = 0;
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        $('#b-all').on('click', function () {
            check_stat = 1;


        });
*/
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


        /* function toggle(source) {
             checkboxes = document.querySelectorAll("input[type='checkbox']");
             for (var i = 0; i < checkboxes.length; i++) {
                 if (checkboxes[i] != source)
                     checkboxes[i].checked = source.checked;
                 //console.log(checkboxes[i].attr('id'));
             }
         }
     */
    </script>
@stop
