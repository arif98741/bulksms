<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders Report
    </title>
    <style>
        body {
            margin: 0;
            font-family: "liberation_sansregular", -apple-system, BlinkMacSystemFont, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Noto Color Emoji;
            font-size: 12px;
        }

        table {
            border: 1px solid #000;
            border-collapse: collapse;;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 9px;
        }

        .thead-dark th {
            color: #fff !important;
            background-color: #343a40 !important;
            border-color: #454d55 !important;
        }

        .total-bg-color {
            background-color: #efebeb;
            font-weight: bold;
        }
    </style>
</head>
<body>
<table class="table table-striped" style="font-size: 15px; width: 100%;" id='sample-report-table'>
    <thead class="thead-dark">
    <tr style="font-size: 12px;">

        <th>#</th>
        <th>Invoice Number</th>
        <th>Seeker</th>
        <th>Provider</th>
        <th>Coupon</th>
        <th>Subtotal</th>
        <th>Booking Date</th>
        <th>Payment Status</th>
        <th>Status</th>
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
            <td style="text-align: center">{{ $service_order->subtotal_price }}</td>
            <td>{{ date('d-m-Y',strtotime($service_order->booking_date)) }}</td>
            <td style="text-align: center">
                                            <span
                                                class="btn btn-success btn-sm">{{ $service_order->payment_status }}</span>
            </td>
            <td style="text-align: center">
                                            <span
                                                class="btn btn-success btn-sm">{{ $service_order->payment_status }}</span>
            </td>

        </tr>

    @endforeach

    </tbody>
</table>
</body>
</html>
