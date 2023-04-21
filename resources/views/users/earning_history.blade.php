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
              <div class="col-12 d-flex align-items-center justify-content-center flex-column mb-20" style="z-index:1;">
                <div class="content-image"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                <div class="d-flex justify-content-start flex-column align-items-start">
                  <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                      <span class="fw-bolder text-dark fs-18">Today</span>
                  </div>

                  <ul class="custom-list">
                    @forelse($history as $row)
                      <li class="d-flex justify-content-between align-items-center">
                          <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{date_to_word($row->created_at)}}">
                            <i data-feather="clock" class="text-primary"></i>
                          </span>
                          <span class="text-start">{{ $row->type }}</span>
                          <span class="text-success">+ {{ number_format($row->amount) }}</span>
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

@endsection
