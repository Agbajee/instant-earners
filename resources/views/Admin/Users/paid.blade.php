@extends('layouts.admin')
@section('content')
@php
    $the_all = \App\Models\User::all();
    $the_verified = \App\Models\User::where('is_verified', 1)->get();
    $the_unverified = \App\Models\User::where('is_verified', 0)->get();
    $the_block = \App\Models\User::where('is_block', 1)->get();
    $the_paid = \App\Models\PaidMembers::all();
    $paid_members = \App\Models\PaidMembers::pluck('user_id');
    $dd = \App\Models\User::whereIn('id', $paid_members)->orderBy('created_at', 'DESC')->paginate(30);
    $counter = 1;
@endphp
<div class="container-fluid">
    <div class="card card-body blur shadow-blur mx-4 my-4 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{asset('soft/img/bruce-mars.jpg')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                Users
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                Edit User Roles and Others
              </p>
            </div>
            <form method="get" action="{{route('adminSearchUsers')}}">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input name="term" type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
            </form>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
              <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 active "  href="javascript:;">
                    <span class="ms-1">All
                        <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{count($the_all)}}</span>
                    </span>

                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 "  href="{{route('adminUsersPaid')}}">
                    <span class="ms-1">Paid
                        <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{count($the_paid)}}</span>
                    </span>

                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 "  href="{{route('adminUsersUnPaid')}}">
                    <span class="ms-1">Un-paid
                        <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{count($the_all)  - count($the_paid)}}</span>
                    </span>

                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-0 px-0 py-1 "  href="{{route('adminUsersBlock')}}">
                    <span class="ms-1">Blocked
                       <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{count($the_block)}}</span>
                    </span>

                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <div class="container px-3">

        <div class="row">
            <div class="col-md-12">
                    @php
                        $dd = \App\Models\User::orderBy('created_at', 'DESC')->paginate(30);
                    @endphp
                    <div class="table-responsive">

                            @if(\Session::has('info'))
                            <div class="alert alert-success">
                                {{\Session::get('info')}}
                            </div>
                            @endif

                            <div class="text-left pg">
                                {{$dd->links('partials.pagination')}}
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <form id="selected_all" action="{{route('adminUsersSelected')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="selected" id="selected">
                                        <button class="btn btn-sm bg-gradient-danger " type="submit">Block</button>
                                    </form>
                                    </div>

                                    <div class="col-6">
                                        <form id="selected_all" action="{{route('adminUsersUnSelected')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="selected" id="selectedunblock">
                                            <button class="btn btn-sm btn-danger"  type="submit">Unblock</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{route('adminUsersVendorSelected')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="selected" id="selectedvendor">
                                            <button class="btn btn-sm bg-gradient-success"  type="submit">Vendor</button>
                                        </form>
                                    </div>

                                    <div class="col-6">
                                        <form action="{{route('adminUsersReVendorSelected')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="selected" id="selectedrevendor">
                                            <button class="btn btn-sm btn-success"  type="submit">Remove(v)</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{route('adminUsersModeratorSelected')}}" method="post">
                                        @csrf
                                            <input type="hidden" name="selected" id="selectedmoderator">
                                            <button class="btn btn-sm bg-gradient-info"  type="submit"> blogger</button>
                                        </form>
                                    </div>

                                    <div class="col-6">
                                        <form action="{{route('adminUsersRemoderatorSelected')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="selected" id="selectedremoderator">
                                            <button class="btn btn-sm btn-info"  type="submit">Remove(b)</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <div class="table-responsive">
                        <table class="table table-sm align-items-center mb-4 ">
                            <thead>
                                <tr>
                                    <th>{{--<div>
                                        <input class="filled-in" type="checkbox" id="b-all" onclick="toggle(this);" />
                                        <label for="b-all" style="padding: 0;margin: -10px 0px;"></label>
                                        </div>--}}
                                    </th>
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fullname</th>
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vendor</th>
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Moderator</th>
                                    {{-- <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th> --}}
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    {{-- <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> --}}
                                    {{-- <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Membership</th> --}}
                                    <th  class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(count($dd) > 0)
                                @foreach($dd as $ui)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <div id="checkie_id">
                                                <form autocomplete="off">
                                                <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                                <label for="b-{{$ui->id}}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">{{$counter++}}</td>
                                        <td class="align-middle text-center text-sm"><a href="{{route('adminUsEdit', $ui->id)}}"> {{$ui->fullname}}</a></td>
                                        <td class="align-middle text-center text-sm">{{ $ui->is_vendor == 1 ? 'Yes' : 'No' }}</td>
                                        <td class="align-middle text-center text-sm">{{ $ui->is_moderator == 1 ? 'Yes' : 'No' }}</td>
                                        {{-- <td class="align-middle text-center text-sm">{{$ui->number ? $ui->number : '---'}}</td> --}}
                                        <td class="align-middle text-center text-sm text-gradient text-primary">{{$ui->username}}</td>
                                        {{-- <td class="align-middle text-center text-sm">{!!  $ui->is_verified == '0' ? '<span class="label bg-red">unverified</span>' : '<span class="label bg-green">verified</span>' !!}</td> --}}
                                        {{-- <td class="align-middle text-center text-sm">{!! $ui->pro ? '<span class="label bg-green">Paid</span>' : '<span class="label bg-red">Not paid</span>'!!}</td> --}}
                                        <td>
                                            @if($ui->is_block)
                                            <a title="Unblock User" href="{{route('adminUsUnID', $ui->id)}}" type="submit" class="btn bg-gradient-success waves-effect" onclick="confirmAction(event)">
                                                unblock
                                            </a>
                                            @else
                                            <a href="{{route('adminUsID', $ui->id)}}" type="submit" class="btn bg-gradient-danger btn-sm" onclick="confirmAction(event)">
                                                Block
                                            </a>
                                            @endif
                                        </td>

                                        </tr>

                                    @endforeach
                                    @endif
                                    </tbody>
                        </table>
                            </div>
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                        </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
    </div>
@stop

@section('scripts')
    <script>

        $('#selected_all').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

        function confirmAction (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        }

            $('#selected').val = '';
            $('#selectedvendor').val = '';
            $('#selectedrevendor').val = '';
            $(".filled-in.sp").on('change', function() {
                var favorite = [];
                $.each($("tbody input[type='checkbox']:checked"), function () {
                    favorite.push($(this).attr('name'));
                });
                if (favorite.length > 0) {
                    $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                    $('#selected').val(favorite);
                    $('#selectedvendor').val(favorite);
                    $('#selectedrevendor').val(favorite);
                    $('#selectedunblock').val(favorite);
                    $('#selectedmoderator').val(favorite);
                    $('#selectedremoderator').val(favorite);
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
