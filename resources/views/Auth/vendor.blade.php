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
                            <h2>Apply for Vendor</h2>
                        </div>
                        </div>

                        <form action="{{route('applyVendorPost')}}" method="post">
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
                                        <button type="button">Full Name</button>
                                        <input name="fullname" placeholder="John seun" value="">

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
                                        <button type="button">Phone</button>
                                        <input name="number" placeholder="09067867628" value="">

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
                                        <button type="button">Email</button>
                                        <input name="email" placeholder="you@example.com" value="">

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
                                        <button type="button">Date of birth</button>
                                        <input name="birth" type="date">

                                        @if($errors->has('birth'))
                                            <div class="er">
                                                {!!  $errors->get('birth')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="ff_cta_inner">
                                        <button type="button">Passport</button>
                                        <input name="passport" type="file">

                                        @if($errors->has('passport'))
                                            <div class="er">
                                                {!!  $errors->get('passport')[0] !!}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 dn">
                                <button class="sumbit_cta" type="submit"> <i class="fa fa-magic"></i> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
@stop
