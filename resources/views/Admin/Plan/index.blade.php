@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">

                <div class="table-responsive">
                    <div class="clearfix mt-3 mx-5">

                        {{-- <div class="d_s_action">
                            <a class="btn btn-info">All ({{count($dd1)}})</a>
                        </div> --}}

                        <div class="text-left pg">
                            {{$dd->links('partials.pagination')}}
                        </div>
                    </div>
                    <form id="selected_all" action="{{route('couponTrashSelected2')}}" method="post">
                        @csrf
                        <input type="hidden" name="selected" id="selected">
                        <button class="btn btn-danger bg-black waves-effect waves-light" disabled="disabled" type="submit">Delete</button>
                    </form>
                    <table class="table table-sm align-items-center mb-4">

                        <thead>
                        <tr>
                            <th width="5%">
                                <div id="checkie_id">
                                <form autocomplete="off">
                                    <input class="filled-in sp" type="checkbox" id="b-select" disabled/>
                                    <label for="b-select" style="line-height: 0;padding: 0;height: 12px;"></label>
                                </form>
                                </div>
                            </th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Referral Bonus</th>
                            <th>Indirect Referral Bonus</th>
                            <th>Registration Bonus</th>
                            <th>Sponsored Post Bonus</th>
                            <th>Daily Login Bonus</th>
                            <th>Minimum Non Ref</th>
                            <th>Minimum Ref</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1; ?>
                        @if(count($dd1) > 0)
                            @foreach($dd as $ui)
                                <tr>
                                    <td width="5%">
                                        <div id="checkie_id">
                                            <form autocomplete="off">
                                            <input class="filled-in sp" type="checkbox" id="b-{{$ui->id}}" name="{{$ui->id}}" />
                                            <label for="b-{{$ui->id}}"></label>
                                            </form>
                                        </div>
                                        </td>
                                    <td>{{$counter++}}</td>
                                    <td><a href="{{route('editPlan', $ui->id)}}"><b>{{$ui->name}}</b></a></td>
                                    <td>
                                        ₦ {{number_format($ui->amount, 2)}}
                                    </td>

                                    <td>
                                        ₦ {{number_format($ui->referral_bonus, 2)}}
                                    </td>

                                    <td>
                                        ₦ {{number_format($ui->indirect_ref, 2)}}
                                    </td>

                                    <td>
                                        ₦ {{number_format($ui->registeration_bonus, 2)}}
                                    </td>

                                    <td>
                                        ₦ {{number_format($ui->sponsored, 2)}}
                                    </td>

                                    <td>
                                        ₦ {{number_format($ui->login, 2)}}
                                    </td>
                                    <td>
                                        ₦ {{number_format($ui->min_ref, 2)}}
                                    </td>
                                    <td>
                                        ₦ {{number_format($ui->min_noref, 2)}}
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="text-left pg">
                            {{$dd->links('partials.pagination')}}
                        </div>
                    </div>
                </div>

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

        function confirmAction (event) {

            var re = confirm('Are you sure you want to perform this action ?');
            if(re == true){
                return true
            } else{
                event.preventDefault();
            }
        }

        $('#selected').val = '';
        $('#selectedcoupon').val = '';
        $(".filled-in.sp").on('change', function() {
            var favorite = [];
            $.each($("tbody input[type='checkbox']:checked"), function () {
                favorite.push($(this).attr('name'));
            });
            if (favorite.length > 0) {
                $('.btn.bg-black.waves-effect.waves-light').attr('disabled', false);
                $('#selected').val(favorite);
                $('#selectedcoupon').val(favorite);
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
