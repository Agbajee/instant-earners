@extends('newlook3.main')
@section('content')
<div class="content-page">
	<div class="content">

		<!-- Start Content-->
    <div class="content-wrapper">
      <div class="container">
          <!-- Main content -->
          <section class="content">
            <div class="row">
              <div class="col-xl-12 col-lg-12 col-12">
                <div class="d-flex justify-content-start flex-column align-items-start">
                  <div class="d-flex justify-content-between align-items-end w-p100 mb-10">
                      <span class="fw-bolder text-dark fs-18">Today</span>
                  </div>

                  <ul class="custom-list">
                    @forelse($notification as $row)
                      <li class="d-flex justify-content-start g-4 align-items-center">
                        <div><i data-feather="edit-2" class="text-primary"></i></div>
                        <div>{{ ($row->content) }}</div>
                      </li>
                    @empty
                    <li class="d-flex justify-content-start g-4 align-items-center">
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
