@extends('newlook3.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-bg"></div>
        <div class="container-full">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="row mb-50">
                    <div class="col-12 d-flex align-items-center justify-content-center flex-column mb-40" style="z-index:1;">
                        <img src="{{ asset('images/users/' . $user->avatar) }}" alt="profile-image" class="profile-pic-b">
                        <div class="d-flex justify-content-center align-items-center flex-column w-p100 mt-10 text-white">
                            <div class="fs-22 fw-bold">{{ $user->fullname }}</div>
                            <button class="btn-custom" data-bs-toggle="modal" data-bs-target="#how">How it works</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7 col-xl-8">
                        <div class="details-card card-body mb-10">
                            <div class="d-flex flex-column justify-content-space-between">
                                <div class="d-info">
                                    <span><i class="fa fa-user-o"></i> Requested Amount  </span>
                                    <span class="fs-20">₦<output id="output"></output> </span>
                                </div>

                                <input class="my-10" min="2000" max="10000" value="2000" step="100"
                                    type="range" id="amount_range">
                            </div>
                        </div>

                        <div class="edit-form px-15">
                            <form class="form-element" action="{{ route('submitLoan') }}" method="POST">
                                @csrf
                                <div class="title">Required Informations</div>
                                <input type="hidden" name="amount" id="amount-value" value="2000">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" required
                                            placeholder="Fullname" name="fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" name="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" id="inputPhone" placeholder="Phone"
                                            required name="phone">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control"placeholder="Date of birth" onfocus="(this.type='date')"
                                            required name="dob">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="employment">
                                            <option selected>Employment Sector</option>
                                            <option value="4">Freelancer</option>
                                            <option value="4">Trader</option>
                                            <option value="4">Self Employed</option>
                                            <option value="9">Civil Worker</option>
                                            <option value="7">Medical</option>
                                            <option value="5">Affiliate</option>
                                            <option value="0">Student</option>
                                            <option value="0">Just there</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="monthly_income">
                                            <option selected>Montly Income</option>
                                            <option value="0">₦ 5000 - below</option>
                                            <option value="1">₦ 5000 -  ₦ 1500</option>
                                            <option value="2">₦ 15000 - ₦ 35000</option>
                                            <option value="3">₦ 35000 - ₦ 55000</option>
                                            <option value="4">₦ 55000 - ₦ 75000 </option>
                                            <option value="4">₦75000 - above </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <textarea name="purpose" class="form-control" placeholder="Purpose of this loan" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="title">Payment</div>
                                <p>Payment will be made into the account details you provided in profile setting.</p>


                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit"
                                            class="btn-custom w-p100 waves-effect waves-dark">Check Eligibiliy</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="how" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Read Carefully</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        Add rows here
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary roounded0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        var modalId = document.getElementById('modalId');
    
        modalId.addEventListener('show.bs.modal', function (event) {
              // Button that triggered the modal
              let button = event.relatedTarget;
              // Extract info from data-bs-* attributes
              let recipient = button.getAttribute('data-bs-whatever');
    
            // Use above variables to manipulate the DOM
        });
    </script>
    
@endsection
@section('js')
    <script>
        const value = document.querySelector("output")
        const input = document.querySelector("#amount_range")
        value.textContent = input.value
        input.addEventListener("input", (event) => {
            value.textContent = event.target.value
        })

        $(document).ready(function() {
            $('#amount_range').on('input', function() {
                $('#amount-value').val($(this).val());
            });
        });
                
    </script>
@endsection
