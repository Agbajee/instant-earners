@extends('layouts.admin')

@section('content')
@php
    $counter = 1;
@endphp
<div class="row">
    <div class="col">
        <div class="card card-modern">
            <div class="card-body">
                <div class="datatables-header-footer-wrapper">
                    <div class="datatable-header">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-6">
                                <form method="get" action="{{route('adminSearchUsers')}}">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input id="search-term" name="term" type="text" class="search-term form-control" placeholder="Type here...">
                                            <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6">
                                <span> Search Result For:&nbsp; <strong>{{$id}}</strong></span><br/>
                                <span> <strong>{{count($get_users)}}</strong> results found</span>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="text-left ">
                    {{$get_users->links('partials.pagination')}}
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <form id="selected_all" action="{{route('adminUsersSelected')}}" method="post">
                            @csrf
                            <input type="hidden" name="selected" id="selected">
                            <button class="btn btn-sm btn-outline-danger " type="submit">Block</button>
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
                                <button class="btn btn-sm btn-outline-success"  type="submit">Vendor</button>
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
                                <button class="btn btn-sm btn-outline-info"  type="submit"> blogger</button>
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
                    <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>S/N</th>
                                <th>Fullname</th>
                                <th>Vendor</th>
                                <th>Moderator</th>
                                <th>Influencer</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(count($get_users) > 0)
                            @foreach($get_users as $ui)
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <div id="checkie_id">
                                        <form autocomplete="off">
                                        <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                        <label for="b-{{$ui->id}}"></label>
                                        </form>
                                    </div>
                                </td>
                                <td>{{$counter++}}</td>
                                <td><a href="{{route('adminUsEdit', $ui->id)}}"> {{$ui->fullname}}</a></td>
                                <td>{{ $ui->is_vendor == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ $ui->is_moderator == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ $ui->influencer == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{$ui->username}}</td>
                                <td>
                                    @if($ui->is_block)
                                    <a title="Unblock User" href="{{route('adminUsUnID', $ui->id)}}" type="submit" class="btn btn-success waves-effect" onclick="confirmAction(event)">
                                        unblock
                                    </a>
                                    @else
                                    <a title="block User" href="{{route('adminUsID', $ui->id)}}" type="submit" class="btn btn-danger btn-sm" onclick="confirmAction(event)">
                                        Block
                                    </a>
                                    @endif
                                    @if(!$ui->influencer)
                                    <a title="Make User Influencer" href="{{route('addInfluencer', $ui->id)}}" type="submit" class="btn btn-info btn-sm" onclick="confirmAction(event)">
                                        influencer
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
                        {{$get_users->links('partials.pagination')}}
                    </div>
                </div>


            </div>
        </div>
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


    // Previous JS

        // $('#selected_all').on('click', function (event) {

        //     var re = confirm('Are you sure you want to perform this action ?');
        //     if(re == true){
        //         return true
        //     } else{
        //         event.preventDefault();
        //     }
        // });

        // function confirmAction (event) {

        //     var re = confirm('Are you sure you want to perform this action ?');
        //     if(re == true){
        //         return true
        //     } else{
        //         event.preventDefault();
        //     }
        // }

        //     $('#selected').val = '';
        //     $(".filled-in.sp").on('change', function() {
        //         var favorite = [];
        //         $.each($("tbody input[type='checkbox']:checked"), function () {
        //             favorite.push($(this).attr('name'));
        //         });
        //         if (favorite.length > 0) {
        //             $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
        //             $('#selected').val(favorite);
        //         } else {
        //             $('.btn.bg-black.waves-effect.waves-light').attr('disabled', true);
        //         }
        //     });


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
