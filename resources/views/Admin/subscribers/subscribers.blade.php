

@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
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
                        <h2>All Users</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                    $paid_members = \App\Models\PaidMembers::pluck('user_id');
                    $dd = \App\Models\User::whereIn('id', $paid_members)->orderBy('created_at', 'DESC')->paginate(30);
                    ?>
                    <div class="body">
                        <div class="table-responsive">
                            <div class="clearfix">

                                @if(\Session::has('info'))
                                <div class="alert alert-success">
                                    {{\Session::get('info')}}
                                </div>
                                @endif

                                <?php $the_all = \App\Models\User::all(); ?>
                                <?php $the_verified = \App\Models\User::where('is_verified', 1)->get(); ?>
                                <?php $the_unverified = \App\Models\User::where('is_verified', 0)->get(); ?>
                                <?php $the_block = \App\Models\User::where('is_block', 1)->get(); ?>
                                <?php $the_paid = \App\Models\PaidMembers::all(); ?>

                                <div class="d_s_action">
                                    <a class="active">All({{count($the_all)}})</a>
                                    <a href="{{route('adminUsersVerified')}}">Verified({{count($the_verified)}})</a>
                                    <a href="{{route('adminUsersUnVerified')}}">Un-verified ({{count($the_unverified)}})</a>
                                    <a href="{{route('adminUsersPaid')}}">Paid ({{count($the_paid)}})</a>
                                    <a href="{{route('adminUsersUnPaid')}}">Un-paid ({{count($the_all)  - count($the_paid)}})</a>
                                    <a href="{{route('adminUsersBlock')}}">Block ({{count($the_block)}})</a>
                                </div>

                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                            <form id="selected_all" action="{{route('adminUsersSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Block</button>
                            </form>
                            <form id="selected_all" action="{{route('adminUsersUnSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedunblock">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Unblock</button>
                            </form>
                            <form action="{{route('adminUsersVendorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedvendor">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Make as Vendor</button>
                            </form>
                            <br>
                            <form action="{{route('adminUsersReVendorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedrevendor">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Remove as Vendor</button>
                            </form>
                            <br>
                            <form action="{{route('adminUsersModeratorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedmoderator">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Make as Moderator</button>
                            </form>
                            <br>
                            <form action="{{route('adminUsersRemoderatorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedremoderator">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Remove as Moderator</button>
                            </form>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th>{{--<div>
                                            <input class="filled-in" type="checkbox" id="b-all" onclick="toggle(this);" />
                                            <label for="b-all" style="padding: 0;margin: -10px 0px;"></label>
                                        </div>--}}</th>
                                    <th>#</th>
                                    <th>fullName</th>
                                    <th>BundleName</th>
                                    <th>Subcribed On</th>
                                    <th>Expiry On</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Membership</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $vendor = \App\Models\Subscription::where('user_id', Auth::user()->id)->get(); ?>
								@if(count($vendor) > 0)
								@foreach($vendor as $row)
                                    <tr>
                                        <td width="5%">
                                            <div id="checkie_id">
                                                <tr style="height: 52px;">
									<td style="width: 95px; height: 52px;">{{ \App\Models\Bundle::find($row->bundle_id)->name }}</td>
									<td style="width: 67px; height: 52px;">{{ $row->subscribed_on }}</td>
									<td style="width: 67px; height: 52px;">{{ $row->expired_on }}</td>
									<td style="width: 67px; height: 52px;">@if($row->status == 2) Expired @else Active @endif</td>
								</tr>
								@endforeach
								@endif
							</tbody>
                                        </td>

                                    </tr>


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
