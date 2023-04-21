@extends("newlook3.main")
@section('content')
<div class="content-wrapper">
  <div class="content-bg"></div>
  <div class="container-full">
  <!-- Content Header (Page header) -->	  

  <!-- Main content -->
  <section class="content">
    <div class="row mb-40">
      <div class="col-12 d-flex align-items-center justify-content-center flex-column mb-40" style="z-index:1;">
        <img src="{{ asset('images/users/' . $user->avatar) }}" alt="profile-image" class="profile-pic-b">
        <div class="d-flex justify-content-center align-items-center flex-column w-p100 mt-10 text-white">
          <div class="fs-22 fw-bold">{{ $user->fullname }}</div>
          <div style="color:#F1602B;">Loan Level: {{ $level }}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 col-lg-7 col-xl-8">
        @if($loan_approved)
          <div class="details-card card-body">
            <div class="d-flex flex-column justify-content-space-between">
                <div class="d-info">
                  <span><i class="fa fa-user-o"></i> Amount </span>
                  <span class="fw-bold">₦ {{number_format($loan_approved->loan_amount)}}</span>
                </div>
                <div class="d-info">
                  <span><i class="fa fa-calendar"></i> Repay On </span>
                  <span class="fw-bold">{!! date('d:m:y - g A',strtotime($loan_approved->due_when))!!}</span>
                </div>
                <div class="d-info justify-content-center align-items-center">
                  <a href="" class="btn-custom">Repay Loan</a>
                </div>
            </div>
          </div>
        @elseif ($loan_rejected)
        <div class="details-card card-body">
          <div class="d-flex flex-column justify-content-space-between">
            <h3>Loan Unavailable Until:</h2>
            <p>{{ date_to_word($loan_rejected->due_when)}}</p>
          </div>
        </div>
        @else
        <div class="details-card card-body">
          <div class="d-flex flex-column justify-content-space-between">
              <div class="d-info">
                <span class="fw-bold">You have no active loan!</span>
              </div>
              <div class="d-info justify-content-center align-items-center">
                <a href="{{route('applyLoan')}}" class="btn-custom">Get Loan</a>
              </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 col-lg-12 col-12">
        <div class="d-flex justify-content-start flex-column align-items-start">
          <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
              <span class="fw-bolder text-dark fs-18 mt-10">Loan History</span>
          </div>
          <ul class="custom-list">
            @forelse($loans as $row)
              <li class="d-flex justify-content-between align-items-center">
                  <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{date_to_word($row->created_at)}}"><i data-feather="clock"  class="text-primary"></i></span>
                  <span class="text-muted"> {{ number_format($row->loan_amount) }} <div>{{ $row->paid ? 'settled' : 'unsettled'; }}</div></span>
                  <span class="{{ $status[$row->status]['class'] ?? 'text-muted' }}">{{ $status[$row->status]['label'] ?? 'unknown' }}</span>
              </li>
            @empty
            <li class="d-flex justify-content-between align-items-center">
                <i data-feather="clock" class="text-primary"></i>
                <span class="text-start">No history found!</span>
            </li>
            @endforelse
          </ul>
      </div>

    </div> 
    </div>

    <!-- /.row -->

  </section>
  <!-- /.content -->
  </div>
</div>

@endsection
@section('js')

@endsection
