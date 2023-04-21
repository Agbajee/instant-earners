@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <h2>Published Treads</h2>

                    <?php $dd1 = \App\Models\Treads::all(); ?>
                    <?php $dd = \App\Models\Treads::orderBy('created_at', 'DESC')->paginate(30) ?>
                    <?php $pt = \App\Models\Treads::where('status', 1)->get(); ?>
                    <?php $dt = \App\Models\Treads::where('status', 0)->get(); ?>

                            <div class="clearfix">
                                @if(\Session::has('info'))
                                    <div class="alert alert-success">
                                        {{\Session::get('info')}}
                                    </div>
                                @endif

                                <div class="d_s_action">
                                    <a href="{{route('adminTreads')}}">All treads({{count($dd1)}})</a>
                                    <a class="active">Published ({{count($pt)}})</a>
                                    <a href="{{route('adminTreadsDraft')}}">Drafts ({{count($dt)}})</a>
                                </div>


                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div>
                            <form id="selected_all" class="s_d_i_22" action="{{route('adminTSelected')}}" method="post">
                                @csrf
                                <input type="hidden" name="selected" id="selected">
                                <button class="btn btn-danger" rel="tooltip" title="Delete All" disabled="disabled" type="submit">Delete</button>
                            </form>

                            <div class="col-md-12">
                                <div class="card card-plain">
                                  <div class="card-header card-header-info">
                                    <h4 class="card-title mt-0"> All Treads</h4>
                                    <p class="card-category"> Perform Actions on your Posts</p><form class="navbar-form" method="get" action="{{route('adminSearchTreads')}}">
                                        
                                    <div class="input-group no-border">
                                        <input type="text" value="" class="form-control" placeholder="Search...">
                                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                            <i class="material-icons">search</i>
                                            <div class="ripple-container"></div>
                                        </button>
                                    </div>
                                </form>

                                  </div>
                                  <div class="card-body">
                                    <div class="table-responsive">

                                        <table class="table table-hover table-responsive dashboard-task-infos">
                                            <thead>
                                            <tr>
                                                <th width="5%">
                                                    <div id="checkie_id">
                                                       <div class="form-check">
                                                        <label for="b-select" class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" id="b-select" />
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                        </div>
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
                                            <?php $counter = 1; ?>
                                            @if(count($dd1) > 0)
                                                @foreach($dd as $ui)
                                                    <tr>
                                                        <td width="5%">
                                                            <div id="checkie_id" class="form-check">
                                                                <label class="form-check-label" for="b-{{$ui->id}}">
                                                                  <input class="form-check-input" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" >
                                                                  <span class="form-check-sign">
                                                                    <span class="check"></span>
                                                                  </span>
                                                                </label>
                                                              </div>
                                                        </td>
                                                        <td width="5%">{{$counter++}}</td>
                                                        <td><a href="{{route('adminTreadsID', $ui->id)}}"> {{$ui->title ? $ui->title : '#'.$ui->id}}</a></td>
                                                        <td><a href="{{route('treadID', $ui->id)}}" target="_blank"> <button rel="tooltip" title="View Post" class="btn btn-info">{{\Str::limit($ui->slug, 20)}}</button></a></td>
                                                        <td>{{$ui->content ? \Str::limit(strip_tags(preg_replace('#^data:image/[^;]+;base64,#', '', $ui->content), 100)) : '---'}}</td>
                                                        <td>
                                                        <?php
                                                         $num = \App\Models\ViewCount::where('tread_id', $ui->id)->count();
                                                         if($num > 0) {
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
                                                            <a  href="{{route('adminTreadsSelected', $ui->id)}}" type="submit" class="btn btn-danger btn-link" rel="tooltip" title="Delete Post" id="s_d_i">
                                                                <i class="material-icons">delete</i>
                                                            </a>
            
            
                                                        </td>
            
                                                    </tr>
                                                @endforeach
                                            @endif
            
                                            </tbody>
                                            <tfoot>
                                                <div class="clearfix">
                                                    <div class="text-left pg">
                                                        {{$dd->links('partials.pagination')}}
                                                    </div>
                                                </div> 
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                              </div>
                            </div>

                            {{-- <div class="clearfix">
                                <div class="text-left pg">
                                    {{$dd->links('partials.pagination')}}
                                </div>
                            </div> --}}
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

        // var favorite = [];
        // var check_stat = 0;
        // var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        // $('#b-all').on('click', function () {
        //     check_stat = 1;

        // });

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