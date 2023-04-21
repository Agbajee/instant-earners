@extends('layouts.main')
@section('seo')
    <link rel="icon" href="{{asset('/images/general/'.$gt->favicon)}}" type="image/x-icon" />
    {!! SEO::generate() !!}
@stop
@section('content')
    <div class="container-fluid">
        <div class="col-md-6 col-md-offset-3">
            <div class="reg_form">
                <div class="reg_form_inner logins">
                    <div class="form_cta clearfix">
                        <div class="col-md-12">
                            <div class="reg_ct_tg">
                                <h2><font color="white"><b>Create an account</b></font></h2>
                            </div>
                        </div>

                        @if(\Session::has('info'))
                        <div class="er_">
                            {{\Session::get('info')}}
                        </div>
                        @endif


                        <form action="{{route('signupPost')}}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">

                                    @if(\Session::has('ref_not_found'))
                                        <div class="er_">
                                            {{\Session::get('ref_not_found')}}
                                        </div>
                                    @endif

                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Referral ID</b></font></button>
                                        <?php

                                            $ref_id = '';
                                            if(old('referral_id') != ''){
                                                $ref_id = old('referral_id');
                                            }elseif(\Session::has('homeSignUp')){
                                                $ref_id = \Session::get('homeSignUp')['referral_id'];
                                            } elseif(\Session::has('d_ref')){
                                                $ref_id = \Session::get('d_ref');
                                            } else{
                                                $ref_id = \App\Models\User::find(1)->username;
                                            }


                                            $username = '';
                                            if(old('username') != ''){
                                                $username = old('username');
                                            }elseif(\Session::has('homeSignUp')){
                                                $username = \Session::get('homeSignUp')['username'];
                                            } else{
                                                $username = '';
                                            }


                                            $fullname = '';
                                            if(old('fullname') != ''){
                                                $fullname = old('fullname');
                                            }elseif(\Session::has('homeSignUp')){
                                                $fullname = \Session::get('homeSignUp')['fullname'];
                                            } else{
                                                $fullname = '';
                                            }

                                            $number = '';
                                            if(old('number') != ''){
                                                $number = old('number');
                                            }elseif(\Session::has('homeSignUp')){
                                                $number = \Session::get('homeSignUp')['number'];
                                            } else{
                                                $number = '';
                                            }

                                            $email = '';
                                            if(old('email') != ''){
                                                $email = old('email');
                                            }elseif(\Session::has('homeSignUp')){
                                                $email = \Session::get('homeSignUp')['email'];
                                            } else{
                                                $email = '';
                                            }
                                        ?>
                                        <?php $admin = \App\Models\User::find(1); ?>
                                        <input name="referral_id" placeholder="Referral ID" value="{{ $ref_id }}" readonly>


                                        @if($errors->has('referral_id'))
                                            <div class="er">
                                                {!!  $errors->get('referral_id')[0] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Username</b></font></button>
                                        <input name="username" type="text" placeholder="Seun" value="{{$username}}">

                                        @if($errors->has('username'))
                                            <div class="er">
                                                {!!  $errors->get('username')[0] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Full Name</b></font></button>
                                        <input name="fullname" placeholder="keleb temitope" value="{{$fullname}}">

                                        @if($errors->has('fullname'))
                                            <div class="er">
                                                {!!  $errors->get('fullname')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Phone</b></font></button>
                                        <input name="number" placeholder="09059" value="{{$number}}">

                                        @if($errors->has('number'))
                                            <div class="er">
                                                {!!  $errors->get('number')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Email</b></font></button>
                                        <input name="email" placeholder="you@example.com" value="{{$email}}">

                                        @if($errors->has('email'))
                                            <div class="er">
                                                {!!  $errors->get('email')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Password</b></font></button>
                                        <input name="password" type="password" name="password">

                                        @if($errors->has('password'))
                                            <div class="er">
                                                {!!  $errors->get('password')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Coupon</b></font></button>
                                        <input name="coupon" type="text">

                                        @if($errors->has('coupon'))
                                            <div class="er">
                                                {!!  $errors->get('coupon')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Security Question</b></font></button>
                                        <select name="security_question_id">
                                            <option value="">Select Questions</option>
                                            <?php $questions = \App\Models\SecurityQuestion::get(); ?>
                                            @foreach($questions as $row)
                                                <option value="{{ $row->id }}">{{ $row->questions }}</option>
                                            @endforeach
                                        </select>

                                        @if($errors->has('security_question_id'))
                                            <div class="er">
                                                {!!  $errors->get('security_question_id')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button"><font color="white"><b>Security Answer</b></font></button>
                                        <input name="security_answer" type="text">

                                        @if($errors->has('security_answer'))
                                            <div class="er">
                                                {!!  $errors->get('security_answer')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 dn">
                                <button class="sumbit_cta" type="submit"> <i class="fa fa-magic"></i> Sign up </button>
                            </div>
                        </form>
                        <div class="col-md-8">
                            <p class="reg_concept"> By clicking "Sign up", you agree to our <a href="#">terms of service</a>, <a href="#">privacy policy</a> and <a href="#">cookie policy</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
