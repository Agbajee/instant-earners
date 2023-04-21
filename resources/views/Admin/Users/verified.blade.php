@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                <i class="material-icons">more_vert</i>
                Verified User
            </h4>
            <form method="get" action="{{route('adminSearchUsers')}}">
                <div class="from_s_a">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" placeholder="Search users" name="term" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php $dd = \App\Models\User::where('is_verified', 1)->orderBy('created_at', 'DESC')->paginate(30); ?>
                    <div class="table-responsive">

                            @if(\Session::has('info'))
                                <div class="alert alert-success">
                                    {{\Session::get('info')}}
                                </div>
                            @endif

                            <?php $the_all = \App\Models\User::all(); ?>
                            <?php $the_verified = \App\Models\User::where('is_verified', 1)->get(); ?>
                            <?php $the_unverified = \App\Models\User::where('is_verified', 0)->get(); ?>

                            <div class="my-2">
                                <a class="btn btn-outline-warning" href="{{route('adminUsers')}}">All({{count($the_all)}})</a>
                                <a class="btn btn-primary">Verified({{count($the_verified)}})</a>
                                <a class="btn btn-outline-warning" href="{{route('adminUsersUnVerified')}}">Un-verified ({{count($the_unverified)}})</a>
                            </div>

                            <div class="text-left pg">
                                {{$dd->links('partials.pagination')}}
                            </div>
                        <form id="selected_all" action="{{route('adminUsersSelected')}}" method="post">
                            @csrf
                            <input type="hidden" name="selected" id="selected">
                            <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Delete</button>
                        </form>
                        <table class="table table-hover dashboard-task-infos">

                            <thead>
                            <tr>
                                <th>{{--<div>
                                        <input class="filled-in" type="checkbox" id="b-all" onclick="toggle(this);" />
                                        <label for="b-all" style="padding: 0;margin: -10px 0px;"></label>
                                    </div>--}}</th>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Membership</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $counter = 1;
                            if(count($dd) > 0){ ?>

                            @foreach($dd as $ui)
                                <tr>
                                    <td width="5%">
                                        <div id="checkie_id">
                                            <div class="form-check">
                                                <form autocomplete="off">
                                                    <label for="b-{{$ui->id}}" class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </form>
                                            </div>

                                        </div>
                                    </td>
                                    <td width="5%">{{$counter++}}</td>
                                    <td><a href="{{route('adminUsEdit', $ui->id)}}"> {{$ui->fullname}}</a></td>
                                    <td>{{$ui->number ? $ui->number : '---'}}</td>
                                    <td>{{$ui->email}}</td>
                                    <td>{!!  $ui->is_verified == '0' ? '<span class="label bg-red">unverified</span>' : '<span class="label bg-green">verified</span>' !!}</td>
                                    <td>{!! $ui->pro ? '<span class="label bg-green">Paid</span>' : '<span class="label bg-red">Not paid</span>'!!}</td>
                                    <td width="15%">
                                        <a title="Delete User" rel="tooltip" href="{{route('adminUsID', $ui->id)}}" type="submit" class="btn bg-link" id="s_d_i">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>

                                </tr>

                            @endforeach
                            <?php } ?>

                            </tbody>
                        </table>
                        <div class="clearfix">
                            <div class="text-left pg">
                                {{$dd->links('partials.pagination')}}
                            </div>
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
