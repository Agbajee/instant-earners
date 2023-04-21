@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
        <div class="col-md-6 col-md-offset-3">
            <div class="reg_form login">
                <div class="reg_form_inner logins">
                    <div class="form_cta clearfix">
                        <div class="col-md-12">
                        <div class="reg_ct_tg">
                            <h2><font color="white"><b>Login to your account</b></font></h2>
                        </div>
                        </div>

                        <form action="{{route('signin')}}" method="post">
                            @csrf


                            @if(\Session::has('info'))
                                <div class="col-md-12">
                                <div class="er_">
                                    {!!  \Session::get('info')!!}
                                </div>
                                </div>
                            @endif
                            @if(\Session::has('success'))
                                <div class="col-md-12">
                                <div class="success_">
                                    {!!  \Session::get('success')!!}
                                </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Username / Email</button>
                                        <input placeholder="you@example.com" name="id" value="{{old('id') ? old('id') : ''}}">

                                        @if($errors->has('id'))
                                            <div class="er">
                                                {!!  $errors->get('id')[0] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Password</b></font></button>
                                        <input type="password" name="password">

                                        @if($errors->has('password'))
                                            <div class="er">
                                                {!!  $errors->get('password')[0] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 dn">
                                <button class="sumbit_cta" type="submit"> <i class="fa fa-magic"></i><font color="white"> <b>Sign</b></font> </button>
                            </div>
                        </form>
                        <div class="col-md-8">
                            <p class="login_n"><a href="{{route('signup')}}" class="login_here">Create new account</a> <br> <a href="{{route('acctPassword')}}"> Forgot Your Password ?</a> </p>
                        </div>
                    </div>
                </div>
            </div>
		</div>
@stop
