<!DOCTYPE html>
<html>

<head>
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 200px;
        }

        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
        }

        .left {
            flex: 1;
        }

        .right {
            flex: 1;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="{{asset('assets/frontend/uploads/logo/nav.png')}}" height="75px">
        </div>
        <div class="details">
            <div class="left">
                <p><strong>Name: </strong> {{ucwords($emailData['name']) ?? ''}}</p>
                <p><strong>Email: </strong> {{$emailData['email'] ?? ''}}</p>
                <p><strong>Contact No: </strong> {{$emailData['mobile'] ?? ''}}</p>
                @if(isset($emailData['alternate_no']) && !empty($emailData['alternate_no']))
                <p><strong>Alternate Contact No: </strong> {{$emailData['alternate_no']}}</p>
                @endif
            </div>
            <div class="right" style="margin-left: 50px!important;">
                <p><strong>Booking Id: </strong><span>{{$emailData['booking_unique_id'] ?? ''}}</span></p>
            </div>
        </div>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Trip Type</td>
                    <td>{{ucwords($emailData['trip']) ?? ''}}</td>
                </tr>
                <tr>
                    <td>Car</td>
                    <td>{{ucwords($emailData['car']) ?? ''}}</td>
                </tr>
                <tr>
                    <td>Pick-up Location</td>
                    <td>{{ucwords($emailData['source']) ?? ''}}</td>
                </tr>
                @if(isset($emailData['stops']) && !empty($emailData['stops']))
                @php $stops = explode('->', $emailData['stops']); @endphp
                @foreach($stops as $key => $stop)
                <tr>
                    <td>{{$key+1}} Stop</td>
                    <td>{{$stop}}</td>
                </tr>
                @endforeach
                @endif
                <tr>
                    @if($emailData['trip']=='local')<td>Package</td>@else<td>Drop-off Location</td>@endif
                    <td>{{ucwords($emailData['destination']) ?? ''}}</td>
                </tr>
                @if(isset($emailData['ride_date']))
                <tr>
                    <td>Pick-up Date & Time</td>
                    <td>{{$emailData['ride_date'] ?? ''}}, {{$emailData['ride_time'] ?? ''}}</td>
                </tr>
                @endif
                <tr>
                    <td>Passengers</td>
                    <td>{{$emailData['passengers'] ?? ''}}</td>
                </tr>
                <tr>
                    <td>Bags</td>
                    <td>{{$emailData['bags'] ?? ''}}</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td style="font-weight:bold;">{{$emailData['price'] ?? '0'}} Rs</td>
                </tr>
                <tr>
                    <td>Amount Paid</td>
                    <td><span style="color: green; font-weight:bold;">{{$emailData['paid_price'] ?? '0'}} Rs ({{$emailData['paid_price_percentage']}}% of total amount)</span></td>
                </tr>
                <tr>
                    <td>Amount Balance</td>
                    <td><span style="color: red; font-weight:bold;">{{$emailData['balance_price'] ?? '0'}} Rs</span></td>
                </tr>
                @if(isset($emailData['gst_no']) && !empty($emailData['gst_no']))
                <tr>
                    <td>GST No.</td>
                    <td>{{$emailData['gst_no'] ?? ''}}</td>
                </tr>
                @endif
            </tbody>
            <!-- <tfoot>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>$emailData['100.00</td>
                </tr>
            </tfoot> -->
        </table>
        <div class="footer">
            <p>Embark on your journey with confidence, comfort, and convenience, courtesy of ZipZap Taxi! Wishing you a delightful ride ahead.</p>
        </div>
        <div class="contact-info">
            <p>Email: <a href="mailto:zipzaptaxi@gmail.com">zipzaptaxi@gmail.com</a></p>
            <p>Phone: <a href="tel:9888799313">+91-9888799313</a></p>
        </div>
    </div>

</body>

</html>