@extends('layouts.admin')

@section('content')
@php
    $the_all = \App\Models\User::count();
    $the_block = \App\Models\User::where('is_block', 1)->count();
    $dd = \App\Models\User::orderBy('created_at', 'DESC')->paginate(30);
    $counter = 1;
@endphp
<div class="row">
    <div class="col">
        <div class="card card-modern">
            <div class="card-body">
                <div class="datatables-header-footer-wrapper">
                    <div class="datatable-header">
                        <div class="row align-items-center mb-3">
                            <div class="col-12 col-lg-auto ps-lg-1">
                                <form method="get" action="{{route('adminSearchUsers')}}">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input id="search-term" name="term" type="text" class="search-term form-control" placeholder="Type here...">
                                            <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12 col-lg-auto mb-3 mb-lg-0">
                                <div class="nav-wrapper position-relative end-0">
                                  <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link mb-0 px-0 py-1 active "  href="javascript:;">
                                        <span class="ms-1">All
                                            <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{$the_all}}</span>
                                        </span>

                                      </a>
                                    </li>

                                    <li class="nav-item">
                                      <a class="nav-link mb-0 px-0 py-1 "  href="{{route('adminUsersBlock')}}">
                                        <span class="ms-1">Blocked
                                           <span class="badge badge-md badge-circle badge-floating badge-danger border-black">{{$the_block}}</span>
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row align-items-center mb-3">
                        <div class="col">
                            <form id="selected_all" action="{{route('adminUsersSelected')}}" method="post">
                            @csrf
                            <input type="hidden" name="selected" id="selected">
                            <button class="btn btn-sm btn-danger " type="submit">Block</button>
                        </form>
                        </div>

                        <div class="col">
                            <form id="selected_all" action="{{route('adminUsersUnSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedunblock">
                                <button class="btn btn-sm btn-danger"  type="submit">Unblock</button>
                            </form>
                        </div>

                        <div class="col">
                            <form action="{{route('adminUsersVendorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedvendor">
                                <button class="btn btn-sm btn-success"  type="submit">Vendor</button>
                            </form>
                        </div>

                        <div class="col">
                            <form action="{{route('adminUsersReVendorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedrevendor">
                                <button class="btn btn-sm btn-success"  type="submit">Remove(v)</button>
                            </form>
                        </div>

                        <div class="col">
                            <form action="{{route('adminUsersModeratorSelected')}}" method="post">
                            @csrf
                                <input type="hidden" name="selected" id="selectedmoderator">
                                <button class="btn btn-sm btn-info"  type="submit"> Moderator</button>
                            </form>
                        </div>

                        <div class="col">
                            <form action="{{route('adminUsersRemoderatorSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selectedremoderator">
                                <button class="btn btn-sm btn-info"  type="submit">Remove(m)</button>
                            </form>
                        </div>
                </div>

                </div>

                <div class="text-left">
                    {{$dd->links('partials.pagination')}}
                </div>

                <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 750px;">
                    <thead>
                    <tr>
                        <th>
                            {{--<div>
                                <input class="filled-in" type="checkbox" id="b-all" onclick="toggle(this);" />
                                <label for="b-all" style="padding: 0;margin: -10px 0px;"></label>
                            </div>--}}
                        </th>
                        <th>#</th>
                        <th>Fullname</th>
                        <th>Vendor</th>
                        <th>Moderator</th>
                        <th>Influencer</th>
                        <th>Email</th>
                        <th>Actions</th>
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
                                <a href="{{route('adminUsID', $ui->id)}}" type="submit" class="btn btn-danger btn-sm" onclick="confirmAction(event)">
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
                <div class="clearfix">
                    <div class="text-left pg">
                        {{$dd->links('partials.pagination')}}
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

            var re = swal('Alert!','Are you sure you want to perform this action ? click outside to cancel', 'info');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

        function confirmAction (event) {

            var re = swal('Alert!', 'Are you sure you want to perform this action ?', 'info');
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
