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
                            <h2>Coupon Checker</h2>
                        </div>
                        </div>

                        <form action="{{route('couponCheckerPost')}}" method="post">
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
                                        <button type="button">Coupon</button>
                                        <input placeholder="PR2-GHNK-GGDD-JJJJ" name="coupon" value="{{old('id') ? old('id') : ''}}">

                                        @if($errors->has('coupon'))
                                            <div class="er">
                                                {!!  $errors->get('coupon')[0] !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 dn">
                                <button class="sumbit_cta" type="submit"> <i class="fa fa-magic"></i> Check </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
@stop
