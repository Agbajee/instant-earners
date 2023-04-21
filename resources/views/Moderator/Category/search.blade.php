@extends('layouts.moderator')
@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <form method="get" action="{{route('moderatorSearchCategories')}}">
                            <div class="from_s_a">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" placeholder="Search Category" name="term" value="{{\Session::has('search') ? \Session::get('search') : old('term')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <h2>Search Result For - {{$id}} ({{count($get_category)}} search results found)</i> </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php $dd1 = $get_category; ?>
                    <?php $dd = $get_category ?>
                    <div class="body">
                        <div class="table-responsive">
                            <div class="clearfix">

                                @if(\Session::has('info'))
                                    <div class="alert alert-success">
                                        {{\Session::get('info')}}
                                    </div>
                                @endif



                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                            <form id="selected_all" action="{{route('moderatorCategorySelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit" id="s_d_i">Delete</button>
                            </form>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 1;
                                if(count($dd1) > 0){ ?>

                                @foreach($dd as $ui)
                                    <tr>
                                        <td width="5%">
                                            <div id="checkie_id">
                                                <form autocomplete="off">
                                                    <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                                    <label for="b-{{$ui->id}}"></label>
                                                </form>
                                            </div>
                                        </td>
                                        <td width="5%">{{$counter++}}</td>
                                        <td><a href="{{route('moderatorCategoryEditID', $ui->id)}}"> {{$ui->name}}</a></td>
                                        <td><a href="{{route('cat', $ui->slug)}}" target="_blank"> <button class="d_cd">{{$ui->slug}}</button></a></td>
                                        <td>{{$ui->description}}</td>



                                        <td width="15%">
                                            <a title="Delete User" href="{{route('moderatorCategorySelectedID', $ui->id)}}" type="submit" class="btn bg-teal waves-effect" id="s_d_i_cat">
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
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
@stop

@section('scripts')
    <script>

        $('#s_d_i').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

        $('#s_d_i_cat').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });
        /*var favorite = [];
        var check_stat = 0;
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        $('#b-all').on('click', function () {
            check_stat = 1;


        });
*/
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
