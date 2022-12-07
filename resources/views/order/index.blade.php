@extends('backend.layout')
@section('title',$title)
@section('breadcrumb_content')
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin Panel</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span>{{ $title  }}
                </span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="row">

                        <div class="col-md-11">
                            <form action="{{ url()->current() }}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group form-row table-data-search-form">
                                            <input type="text" name="search"
                                                   value="{{ (isset($_GET['search'])) ? $_GET['search']: '' }}"
                                                   placeholder="Invoice number, seeker phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="1"
                                                    @if(request()->has('status') && request()->get('status') ==1) selected @endif>
                                                Active
                                            </option>
                                            <option value="0"
                                                    @if(request()->has('status') && request()->get('status') ==0) selected @endif>
                                                Not Active
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="date_filter" class="form-control" id="date_range_filter">
                                            <option value="" disabled selected>More Filter</option>
                                            <option value="today"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'today') selected @endif>
                                                Date - Today
                                            </option>
                                            <option value="yesterday"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'yesterday') selected @endif>
                                                Date - Yesterday
                                            </option>
                                            <option value="last_3"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'last_3') selected @endif>
                                                Date - Last 3 Days
                                            </option>
                                            <option value="last_7"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'last_7') selected @endif>
                                                Date - Last 7 Days
                                            </option>
                                            <option value="last_15"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'last_15') selected @endif>
                                                Date - Last 15 Days
                                            </option>
                                            <option value="this_m"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'this_m') selected @endif>
                                                Date - This Month
                                            </option>
                                            <option value="pre_m"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'pre_m') selected @endif>
                                                Date - Last Month
                                            </option>
                                            <option value="last_3m"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'last_3m') selected @endif>
                                                Date - Last 3 Months
                                            </option>
                                            <option value="custom"
                                                    @if(request()->has('date_filter') && request()->get('date_filter') == 'custom') selected @endif>
                                                Date - Custom Range
                                            </option>
                                        </select>
                                    </div>

                                    <div
                                        class="col-md-2 date_range_inputs @if(request()->has('start_date') && request()->has('end_date')) @else d-none @endif">
                                        <div class="form-group form-row">
                                            <input type="date" name="start_date"
                                                   value="{{ (isset($_GET['start_date'])) ? $_GET['start_date']: '' }}"
                                                   class="form-control" id="start_date">
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-2 date_range_inputs @if(request()->has('start_date') && request()->has('end_date')) @else d-none @endif">
                                        <div class="form-group form-row">
                                            <input type="date" name="end_date"
                                                   value="{{ (isset($_GET['end_date'])) ? $_GET['end_date']: '' }}"
                                                   class="form-control" id="end_date">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-success" style="margin: 0px;
    padding: 10px 27px;">
                                            <i class="fa-solid fa-search"></i>
                                        </button>
                                    </div>
                            </form>

                            <div class="col-md-1">

                                <form class="form-inline" target="_blank" action="{{ url('backend/download-order') }}"
                                      method="get">
                                    @foreach(request()->query() as $key=>$query)
                                        <input type="hidden" name="{{ $key }}" value="{{ $query }}">
                                        @endforeach
                                    <button type="submit" name="excel"  class="btn btn-success" style="display: inline-block;
    margin: 0;
    padding: 3px;">
                                        Excel
                                    </button>
                                    <button type="submit" name="pdf" class="btn btn-success" style="display: inline-block;
                                        margin: 0;
                                        padding: 3px;
                                        margin-left: 9px;">
                                        PDF
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>Seeker</th>
                                <th>Provider</th>
                                <th>Coupon</th>
                                <th>Subtotal</th>
                                <th>Booking Date</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($service_orders as $key=> $service_order)

                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $service_order->invoice_number }}</td>
                                    <td>{{ $service_order->seeker->full_name }}</td>
                                    <td>{{ $service_order->provider->full_name }}</td>
                                    <td>{{ $service_order->coupon->coupon_code }}</td>
                                    <td>{{ $service_order->subtotal_price }}</td>
                                    <td>{{ date('d-m-Y',strtotime($service_order->booking_date)) }}</td>
                                    <td>
                                            <span
                                                class="btn btn-success btn-sm">{{ $service_order->payment_status }}</span>
                                    </td>
                                    <td>
                                            <span
                                                class="btn btn-success btn-sm">{{ $service_order->payment_status }}</span>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary">View</a>
                                        <a href="#"
                                           class="btn btn-success">Edit</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>
                        {{ $service_orders->appends($_GET)->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('backend.lib.footer-copyright')
    </div>
    @push('script')

        <script>
            $(document).ready(function () {

                let startDate = $('#start_date').val();
                let endDate = $('#end_date').val();
                if (startDate == '' || endDate == '') {
                    $('.date_range_inputs').addClass('d-none');
                }


                $('#date_range_filter').change(function () {
                    let dateValue = $(this).val();
                    if (dateValue == 'custom') {
                        $('.date_range_inputs').removeClass('d-none');
                        return;
                    }
                    $('.date_range_inputs').addClass('d-none');
                    console.log(dateValue);
                });
            });
        </script>
    @endpush
@endsection
