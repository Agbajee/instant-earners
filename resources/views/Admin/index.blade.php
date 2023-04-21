@extends('layouts.admin')
@section('content')

    @php
        $user = App\Models\User::where('id', '!=', 1)->count();
        $newUser = \App\Models\User::whereDate('created_at', now())->count();
        $posts = \App\Models\Treads::count();

        $user_p = App\Models\User::where('id', '!=', 1)
            ->select(['balance', 'indirect_ref'])
            ->get();
        $aff = collect($user_p)
            ->where('id', '!=', 1)
            ->sum('balance');
        $in_aff = collect($user_p)
            ->where('id', '!=', 1)
            ->sum('indirect_ref');

        $paidActivities = \App\Models\payoutRequest::where('is_payed', 1)
            ->where('from_account', 2)
            ->count();
        $unPaidActivites = \App\Models\payoutRequest::where('is_payed', 0)
            ->where('from_account', 2)
            ->count();

        $paidRequest = \App\Models\payoutRequest::where('is_payed', 1)
            ->where('from_account', 1)
            ->count();
        $unPaidRequest = \App\Models\payoutRequest::where('is_payed', 0)
            ->where('from_account', 1)
            ->count();
    @endphp
    <div class="row">
        <div class="col-lg-12 col-xl-12">

            <div class="row col-md-12">
                <div class="col-12">
                    <div class="card card-modern">
                        <div class="card-body p-0">
                            <div class="widget-user-info">
                                <div class="widget-user-info-header">
                                    <h2 class="font-weight-bold text-color-dark text-5">Hello, {{ Auth::user()->username }}</h2>
                                    <p class="mb-0">Administrator</p>

                                    <div class="widget-user-acrostic bg-primary">
                                        <span class="font-weight-bold">AD</span>
                                    </div>
                                </div>
                                <div class="widget-user-info-body">
                                    <div class="row">
                                        <div class="col-auto">
                                            <strong class="text-color-dark text-5">{{ $user }}</strong>
                                            <h3 class="text-4-1">Total Users</h3>
                                        </div>
                                        <div class="col-auto">
                                            <strong class="text-color-dark text-5">{{ $newUser }}</strong>
                                            <h3 class="text-4-1">Today's Reg</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col-lg-6 col-xl-12 pb-2 pb-lg-0 mb-4 mb-lg-0">
                    <div class="card card-modern">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col-6 col-md-4">
                                    <h2 class="text-4-1 my-0">Paid affiliate</h2>
                                    <strong class="text-color-dark">{{ number_format($paidRequest) }}</strong>
                                </div>
                                <div
                                    class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
                                    <h3 class="text-4-1 text-color-danger line-height-2 my-0">Unpaid affiliate </h3>
                                    <strong>{{ number_format($unPaidRequest)}} </strong>
                                </div>
                                <div class="col-md-4 text-left text-md-right pe-md-4 mt-4 mt-md-0">
                                    <i
                                        class="bx bx-user icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-12 pt-xl-2 mt-xl-4">
                    <div class="card card-modern">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col-6 col-md-4">
                                    <h3 class="text-4-1 my-0">Paid Points</h3>
                                    <strong class="text-color-dark">{{ number_format($paidActivities ) }}</strong>
                                </div>
                                <div
                                    class="col-6 col-md-4 border border-top-0 border-end-0 border-bottom-0 border-color-light-grey py-3">
                                    <h3 class="text-4-1 text-color-danger line-height-2 my-0">Unpaid points</h3>
                                    <strong>{{ number_format($unPaidActivites) }}</strong>
                                </div>
                                <div class="col-md-4 text-left text-md-right pe-md-4 mt-4 mt-md-0">
                                    <i
                                        class="bx bx-purchase-tag-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light pe-0"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-12 pt-xl-2 mt-xl-4">
                    <div class="card card-modern">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col-6 col-md-4">
                                    <h3 class="text-4-1 my-0">Total Balance(affiliate)</h3>
                                    <strong class="text-color-dark">{{ number_format($aff) }}</strong>
                                </div>
                               
                                <div class="col-md-4 text-left text-md-right pe-md-4 mt-4 mt-md-0">
                                    <i
                                        class="bx bx-dollar icon icon-inline icon-xl bg-primary rounded-circle text-color-light pe-0"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="col">
                    <div class="card card-modern">
                        <div class="card-header">
                            <div class="card-actions">
                                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            </div>
                            <h2 class="card-title">Revenue</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <strong class="text-color-dark text-6">₦2000</strong>
                                    <h3 class="text-4 mt-0 mb-2">Last Month</h3>
                                </div>
                                <div class="col-auto">
                                    <strong class="text-color-dark text-6">₦{{ number_format(2500 * $newUser) }}</strong>
                                    <h3 class="text-4 mt-0 mb-2">Today</h3>
                                </div>
                                <div class="col-auto">
                                    <strong class="text-color-dark text-6">₦{{ number_format(2500 * $user - 4000) }}</strong>
                                    <h3 class="text-4 mt-0 mb-2">Total Revenue</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card card-modern">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-8 col-md-6">
                            <h3 class="text-4-1 my-0">Total Posts</h3>
                            <strong class="text-6 text-color-dark">{{ $posts }}</strong>
                        </div>
                        <div class="col-4 col-md-6 text-left text-md-right pe-md-4 mt-4 mt-md-0">
                            <i class="bx bx-text icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <div class="card card-modern card-modern-table-over-header">
                <div class="card-header">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                    </div>
                    <h2 class="card-title">Recent Registrations</h2>
                </div>
                <div class="card-body">
                    <div class="datatables-header-footer-wrapper">
                        <div class="datatable-header">
                            <div class="row align-items-center mb-3">

                                <div class="col-8 col-lg-auto ms-auto ml-auto mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Filter By:</label>
                                        <select class="form-control select-style-1 filter-by" name="filter-by">
                                            <option value="all" selected>All</option>
                                            <option value="1">S/N</option>
                                            <option value="2">Name</option>
                                            <option value="3">Date</option>
                                            <option value="4">Phone number</option>
                                            <option value="5">Email</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-lg-auto ps-lg-1 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                                        <label class="ws-nowrap me-3 mb-0">Show:</label>
                                        <select class="form-control select-style-1 results-per-page"
                                            name="results-per-page">
                                            <option value="12" selected>12</option>
                                            <option value="24">24</option>
                                            <option value="36">36</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-auto ps-lg-1">
                                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                                        <div class="input-group">
                                            <input type="text" class="search-term form-control" name="search-term"
                                                id="search-term" placeholder="Search Order">
                                            <button class="btn btn-default" type="submit"><i
                                                    class="bx bx-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-ecommerce-simple table-borderless table-striped mb-0"
                            id="datatable-ecommerce-list" style="min-width: 640px;">

                            <thead>
                                <tr>
                                    <th width="3%"><input type="checkbox" name="select-all"
                                            class="select-all checkbox-style-1 p-relative top-2" value="" /></th>
                                    <th width="8%">S/N</th>
                                    <th width="28%">Name</th>
                                    <th width="18%">Date</th>
                                    <th width="18%">Phone Number</th>
                                    <th width="15%">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $the_user = App\Models\User::orderBy('created_at', 'DESC')
                                        ->limit('5')
                                        ->get();
                                    $counter = 1;
                                @endphp
                                @foreach ($the_user as $u)
                                    <tr>
                                        <td width="30"><input type="checkbox" name="checkboxRow1"
                                                class="checkbox-style-1 p-relative top-2" value="" /></td>
                                        <td><a
                                                href="#"><strong>{{ $counter++ }}</strong></a>
                                        </td>
                                        <td><a
                                                href="#"><strong>{{ $u->fullname }}</strong></a>
                                        </td>
                                        <td>{{ date('d/m/y  g:i A', strtotime($u->created_at)) }}</td>
                                        <td>{{ $u->number ? $u->number : '----' }}</td>
                                        <td><span
                                                class="ecommerce-status on-hold">{{ $u->email ? $u->email : '----' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="solid mt-5 opacity-4">
                        <div class="datatable-footer">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-lg-auto text-center order-3 order-lg-2">
                                    <div class="results-info-wrapper"></div>
                                </div>
                                <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                                    <div class="pagination-wrapper"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@stop
