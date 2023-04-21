@extends("newlook3.main")
@section('content')

@php
    $user = Auth::user();
    $prediction = \App\Models\Prediction::where('status', 1)->first();
    $history = \App\Models\userPredictions::where('user_id', auth::user()->id)->orderBy('created_at', 'DESC')->get();
@endphp

<div class="content-wrapper">
    <div class="container-full">
        <div class="content">
            <div class="row">
                @if($prediction)
                <div class="col-lg-6">
                    <div class="height-auto">
                        <img src="{{asset('/images/treads/'.$prediction->image ? : '') }}" alt="quiz">
                    </div>
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <h4><strong>Title:</strong> {{ $prediction->title }}</h4>
                        </div>
                        <div class="card-body">
                           <p><strong>Instruction:</strong> {{ $prediction->content }}</p> 
                        </div>
                    </div>

                    <div class="card shadow-lg">
                        <div class="card-body">
                            <form method="post" action="{{route('predictPost')}}">
                                @csrf

                                <div class="form-group">
                                    <label for="predict"> Your Prediction</label>
                                    <input id="predict" name="answer" value="" type="text" class="form-control my-2">   
                                </div>
                                <div class="form-group">
                                    <input name="title" value="{{$prediction->title}}" type="hidden">   
                                    <input name="content" value="{{$prediction->content}}" type="hidden">   
                                    <input name="cost" value="{{$prediction->cost}}" type="hidden">   
                                    <input name="id" value="{{$prediction->id}}" type="hidden">   
                                </div>
                                
                                <button type="button" data-bs-toggle="modal" data-bs-target="#info"  class="btn btn-primary hidden"> Submit </button>

                                <div class="modal fade dialogbox" id="info" data-bs-backdrop="static" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">@lang('Spin Instruction')</h4>
                                            </div>
                                                <div class="modal-body">
                                                    <p class="font-20">This Prediction Cost <strong>{{$prediction->cost}}</strong> activity point whether you win or you lose.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Proceed</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
                @else
                <div class="col-12">
                    <div class="card bg-primary text-center text-white p-5">
                        Quiz not Available
                    </div>
                </div>
                @endif
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Prediction History</h4>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-lg invoice-archive">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Answer</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse($history as $row)
                                  <tr>
                                    <td>
                                      {{ date('d/m/y  g:i A',strtotime($row->created_at)) }}
                                    </td>
                                    <td>
                                      <span class="badge badge-pill badge-primary">{{ $row->answer }}</span>
                                    </td>
                                    <td>
                                        @if ( $row->status == 1 )
                                            <span class="badge badge-pill badge-success fw-bold">Won</span>
                                        @else
                                            <span class="badge badge-pill badge-warning fw-bold">Not Confirmed</span>
                                        @endif
                                    </td>
                                  </tr>
                                  @empty
                                    <div class="card bg-primary text-center text-white p-5">
                                        <h4>No History Found</h4>
                                    </div>
                                  @endforelse
                
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')

@endsection