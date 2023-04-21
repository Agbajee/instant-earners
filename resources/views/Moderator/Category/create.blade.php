@extends('layouts.moderator')
@section('content')
    <div class="container-fluid">

        @if(\Session::has('info'))
            <div class="alert bg-green">
                {{\Session::get('info')}}
            </div>
        @endif


        @if(\Session::has('error2'))
             <div class="alert bg-red">
                  {{\Session::get('error2')}}
             </div>
        @endif

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Create New Category</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="the_sc">
                            <form method="post" action="{{route('moderatorCategoryCreate')}}">
                                @csrf

                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Category Name</label>
                                        <input type="text" value="{{old('name')}}" class="form-control" name="name">
                                    </div>

                                    @if($errors->has('name'))
                                        <div class="er">
                                            {!!  $errors->get('name')[0] !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label>Category Description</label>
                                        <textarea rows="5" cols="80" id="comment" class="form-control no-resize" name="description" required>{{old('description')}}</textarea>
                                    </div>


                                    @if($errors->has('description'))
                                        <div class="er">
                                            {!!  $errors->get('description')[0] !!}
                                        </div>
                                    @endif
                                </div>



                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create Category</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Browser Usage -->
        </div>
    </div>
@stop

@section('scripts')
@stop
