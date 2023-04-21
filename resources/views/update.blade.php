@extends('newlook.main')

@section('seo')

<link
    rel="shortcut icon"
    href="{{asset('/images/general/'.$gt->favicon)}}"
    type="image/x-icon"
    />
{!! SEO::generate() !!}

@endsection

@section('category')

<div class="hero-header bg-secondary mb-2">
    <div class="container">
    <h3 class="m-0 p-0">
        Update bank Account
    </h3>
</div>
</div>

@endsection

@section('content')
<div class="col-12 col-md-7 px-md-2 px-0">

<div class="post-item mb-3 shadow-sm bg-white" style="padding:20px">
    
    
   <div class="main-content-inner">

                <div class="main-content-inner-contet">
                    <div class="scrool-height"></div>
                    <div class="show_profile_info clearfix">
                        <div class="most-popular-tag-inner clearfix" style="padding: 0 0 20px 0"><a href="{{route('account')}}"> My Account </a> <a href="{{route('editAccount')}}" class="active"> Edit Profile </a> <a href="{{route('changePassword')}}"> Change Password </a> <a href="{{route('support')}}"> Support Ticket </a> </div>
                        @if(App\Models\PaidMembers::where('user_id', Auth::user()->id)->exists() == false)
                        <a href="{{route('becomeapro')}}" class="become_one_of_us">Click Here to Become a Registered Member » </a>
                        @endif
                        @if(\Session::has('info2'))
                            <div class="info_timed_inner er2_">
                                {{\Session::get('info2')}}
                                    </div>
                        @endif
                        @if($errors->has('file'))
                            <div class="er_" style="margin-top: 0;">
                                {!!  $errors->get('file')[0] !!}
                            </div>
                        @endif

                        <div class="b_of_u">

                            <div class="clearfix" style="padding: 20px;">
                                
                                <div class="col-md-10">
                                    <div class="user_info_d">

                                            @csrf
                                            <div class="form-group">
                                                <label>Bank Name</label>
                                                <input name="bank" class="form-control" value="{{ base64_decode(Auth::user()->bank) }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Account Number</label>
                                                <input name="acc_numb" class="form-control" value="{{ base64_decode(Auth::user()->acc_numb) }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Account Name</label>
                                                <input name="acc_name" class="form-control" value="{{ base64_decode(Auth::user()->acc_name) }}">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input name="facebook" class="form-control" value="{{Auth::user()->facebook}}">
                                            </div>

                                            <button class="btn btn-primary" type="submit">Edit Profile</button>

                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
    

</div>

</div>
@endsection

