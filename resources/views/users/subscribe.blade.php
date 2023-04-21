@extends('newlook3.main')

@section('content')
<div class="content-wrapper">
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">						
                            <h4 class="box-title">My Gift(s)</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-sm invoice-archive table-striped mb-0" style="min-width: 550px;">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Subscribed On</th>
                                            <th>Expired On</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php 
                                            $skills = \App\Models\Subscription::where('user_id', Auth::user()->id)->get(); 
                                            $counter = 1; 
                                        @endphp

                                        @if(count($skills) > 0)
                                        @foreach($skills as $row)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td><a href="{{ \App\Models\Bundle::find($row->bundle_id)->link }}" target="_blank">{{ \App\Models\Bundle::find($row->bundle_id)->name }}</a></td>
                                            <td>{{ $row->subscribed_on }}</td>
                                            <td>{{ $row->expired_on }}</td>
                                            <td>
                                                @if($row->status == 2) <span class="badge badge-danger">Expired</span>  @else <span class="badge badge-success">Active</span>  @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-md-auto order-1 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-stretch">
                                        <form role="form" action="{{route('subscribePost')}}" method="post">
                                            @csrf
                                            <div class="d-grid gap-3 d-md-flex justify-content-md-end me-4">
                                                <select id="opt" class="form-control form-control select-style-1 bulk-action" name="bundle_id"  style="min-width: 170px;">
                                                    @php $bd = \App\Models\Bundle::get(); @endphp
                                                    <option selected value="">Choose a skill</option>
                                                    @foreach($bd as $b)
                                                    <option value="{{ $b->id }}">{{ $b->name }} - ({{ $b->points }}) BPT</option>
                                                    @endforeach
                                                </select>
                                                <button id="btn-subscribe" type="submit" name="submit" class="bulk-action-apply btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3" >Subscribe</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <div class="results-info-wrapper"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
@section('js')
    <script> 
        $(document).ready(function() {
            $('#opt').change(function() {
                $("#btn-subscribe").prop('disabled', this.value == '');
            }).change();
        });
    </script>
@endsection
