@extends('layouts.moderator')
@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <form method="get" action="{{route('moderatorSearchTreads')}}">
                            <div class="from_s_a">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="form-line">
                                            <input type="text" placeholder="Search Treads" name="term" value="{{\Session::has('search') ? \Session::get('search') : old('term')}}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <h2>Search Result For - {{$id}} ({{count($get_tread)}} search results found)</i> </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <div class="clearfix">

                                @if(\Session::has('info'))
                                    <div class="alert alert-success">
                                        {{\Session::get('info')}}
                                    </div>
                                @endif

                                <div class="text-left pg">
                                    {{$get_tread->links('partials.pagination')}}
                                </div>
                            </div>
							@if(count($get_tread) > 0)
                            <form id="selected_all" action="{{route('moderatorTSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn bg-black waves-effect waves-light" disabled="disabled" type="submit">Delete</button>
                            </form>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th width="5%">
                                        <div id="checkie_id">
                                           <form autocomplete="off">
                                               <input class="filled-in sp" type="checkbox" id="b-select" />
                                               <label for="b-select" style="line-height: 0;padding: 0;height: 12px;"></label>
                                           </form>
                                          </div>
                                    </th>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Except</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

									@foreach($get_tread as $ui)
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
											<td><a href="{{route('moderatorTreadsID', $ui->id)}}"> {{$ui->title ? $ui->title : '#'.$ui->id}}</a></td>
											<td><a href="{{route('treadID', $ui->id)}}" target="_blank"> <button class="d_cd">{{\Str::limit($ui->slug, 20)}}</button></a></td>
											<td>{{$ui->content ? \Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $ui->content), 200)) : '---'}}</td>
											<td>
											<?php
											 $num = \App\ViewCount::where('tread_id', $ui->id)->count();
											 if(count($num) > 0) {
											 if($num>1000) {
												$x = round($num);
												$x_number_format = number_format($x);
												$x_array = explode(',', $x_number_format);
												$x_parts = array('k', 'm', 'b', 't');
												$x_count_parts = count($x_array) - 1;
												$x_display = $x;
												$x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
												$x_display .= $x_parts[$x_count_parts - 1];
												echo $x_display;
												} else {
												 echo $num;
												}
											  } else {
												 echo '0';
											 }
											 ?>
											</td>
											<td>{{$ui->status == '1' ? 'Published' : 'Draft'}}</td>
											<td>{{strip_tags($ui->created_at->diffForHumans())}}</td>



											<td width="5%">
												<a title="Delete User" href="{{route('moderatorTreadsSelected', $ui->id)}}" type="submit" class="btn bg-teal waves-effect" id="s_d_i">
													<i class="material-icons">delete</i>
												</a>


											</td>

										</tr>
									@endforeach


                                </tbody>
                            </table>
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$get_tread->links('partials.pagination')}}
                                </div>
                            </div>
							@else
							<div class="no_item_found">
								No Search result found
							</div>
							@endif
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

        $('.s_d_i_22').on('click', function (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        });

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

		$('#b-select').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@stop
