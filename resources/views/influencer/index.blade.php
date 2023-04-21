@extends('newlook3.main')
@section('content')
<div class="content-page">
	<div class="content">

		<!-- Start Content-->
    <div class="content-wrapper">
      <div class="content-bg"></div>
      <div class="container-full">
          <!-- Main content -->
          <section class="content">
            <div class="row mb-40">
                <div class="col-12">
                    <div class="balance-wrapper" style="z-index:1;">
                        <div class="balance-card front">
                            <p class="fs-16">Salary</p>
                            <h3 class="fs-30">₦ {!! number_format($influencer->salary) . '' !!}</h3>
                            <button class="btn-custom mt-10 btn-sm" data-bs-toggle="modal" data-bs-target="#cashout">Cashout Funds</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12">
                    <div class="d-flex justify-content-start flex-column align-items-start">
                        <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                            <span class="fw-bolder text-dark fs-18 mt-10">Payment History</span>
                        </div>

                        <ul class="custom-list">
                            @forelse($salary_history as $row)
                            <li class="d-flex justify-content-between align-items-center">
                                <i data-feather="clock" class="text-primary"></i>
                                <span class="text-primary"> {{ number_format($row->amount) }}</span>
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
          </section>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cashout" tabindex="-1" role="dialog" aria-labelledby="cashout" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Cashout Salary</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="edit-form px-15">
                            <form class="form-element" action="{{ route('requestSalary') }}" method="POST">
                                @csrf
                                <div class="title">Required Informations</div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="amount" required
                                            placeholder="Enter Amount" name="amount">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit"
                                            class="btn-custom w-p100 waves-effect waves-dark">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-custom" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
