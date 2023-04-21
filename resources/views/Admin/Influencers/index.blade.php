@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="clearfix">
                                <div class="text-left pg">
                                    {{$all->links('partials.pagination')}}
                                </div>
                            </div>
                            <table class="table table-hover dashboard-task-infos">

                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Influencer</th>
                                    <th>Referred</th>
                                    <th>Salary</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $counter = 1;
                                @endphp
                                @foreach($all as $ui)
                                    <tr>
                                        <td width="5%">{{$counter++}}</td>
                                        <td>{{ \App\Models\User::find($ui->user_id)->username }}</td>
                                        <td>{{'not available'}}</td>
                                        <td>{{$ui->salary}}</td>
                                        <td>
                                            <a href="{{route('removeInfluencer', $ui->user_id)}}" class="btn btn-sm btn-warning btn-2 text-light"><i class="bx bx-x-circle"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </div>
@stop

