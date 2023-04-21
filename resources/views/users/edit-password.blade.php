@extends('newlook2.main')

@section('seo')

<link
    rel="shortcut icon"
    href="{{asset('/images/general/'.$gt->favicon)}}"
    type="image/x-icon"
    />
{!! SEO::generate() !!}

@endsection

@section('category')

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Edit Password</h2>
          <ol>
            <li>Password</li>
          </ol>
        </div>

      </div>
    </section><!-- End Password Section -->
@endsection

@section('content')

    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            @if(\Session::has('info2'))
                <div class="info_timed_inner er2_">
                    {{\Session::get('info2')}}
                        </div>
            @endif

            @if(\Session::has('info'))
                <div class="info_timed_inner er_">
                    {{\Session::get('info')}}
                </div>
            @endif


                <div class="clearfix" style="padding: 20px;">
                    <form method="post" action="{{route('changePasswordPost')}}">

                    <div class="col-md-10">
                        <div class="user_info_d">

                                @csrf
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input required name="old_password" class="form-control" type="password">

                                    @if($errors->has('old_password'))
                                        <div class="er">
                                            {!!  $errors->get('old_password')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>New Password</label>
                                    <input required name="new_password" class="form-control" type="password">
                                    @if($errors->has('new_password'))
                                        <div class="er">
                                            {!!  $errors->get('new_password')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input name="new_password_confirmation" required class="form-control" type="password">
                                    @if($errors->has('new_password_confirmation'))
                                        <div class="er">
                                            {!!  $errors->get('new_password_confirmation')[0] !!}
                                        </div>
                                    @endif
                                </div>

                                <button class="btn btn-primary" type="submit">Change Password</button>

                        </div>
                    </div>
                    </form>
                </div>
        </div>
    </section>
</main>

@endsection
