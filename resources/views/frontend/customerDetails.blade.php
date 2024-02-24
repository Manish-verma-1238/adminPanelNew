@include('frontend.common.header')

<style>
    .modify {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 20px 0 0 0;
        background-color: lightslategray;
        padding: 20px;
        flex-wrap: wrap;
        border-radius: 10px;
        color: white;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    @media (max-width: 768px) {
        .modify {
            flex-direction: column;

            .box {
                max-width: 100% !important;
            }
        }
    }

    .big-form {
        h4 {
            color: white;
            font-size: 15px
        }
        
        input:focus {
            outline: 0;
            border-color: #bd8200;
        }

        input:focus+.input-icon i {
            color: #f0a500;
        }

        input:focus+.input-icon:after {
            border-right-color: #f0a500;
        }

        .input-group {
            margin-bottom: 1em;
            zoom: 1;
        }

        .input-group:before,
        .input-group:after {
            content: "";
            display: table;
        }

        .input-group:after {
            clear: both;
        }

        .input-group-icon {
            position: relative;
        }

        .input-group-icon input {
            padding-left: 4.4em;
        }

        .container {
            max-width: 38em;
            padding: 1em 3em 2em 3em;
            margin: 0em auto;
            /* background-color: #fff; */
            border-radius: 4.2px;
            /* box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2); */
        }

        .row {
            zoom: 1;
        }

        .row:before,
        .row:after {
            content: "";
            display: table;
        }

        .row:after {
            clear: both;
        }

        .col-half {
            padding-right: 10px;
            float: left;
            width: 50%;
        }

        .col-half:last-of-type {
            padding-right: 0;
        }

        .col-third {
            padding-right: 10px;
            float: left;
            width: 50%;
        }

        .col-third:last-of-type {
            padding-right: 0;
        }

        form {
            width: 100%;
        }

        @media only screen and (max-width: 540px) {
            .col-half {
                width: 100%;
                padding-right: 0;
            }

            .col-third {
                width: 50%;
            }

            select {
                width: 100%;
            }
        }

    }

    .dlist-align {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        justify-content: space-between;
    }

    [class*="dlist-"] {
        margin-bottom: 5px
    }

    .coupon {
        border-radius: 1px
    }

    .price {
        font-weight: 600;
        color: #212529
    }

    .modelboxcong {
        vertical-align: middle;
        display: flex;


        .card {
            border-radius: 3vh;
            margin: auto;
            max-width: 380px;
            padding: 7vh 6vh;
            align-items: center;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        @media(max-width:767px) {
            .card {
                width: 90vw;
            }
        }

        .card-img {
            padding: 20px 0;
            width: 40%;
        }

        .card-img img {
            opacity: 0.7;
        }

        .card-title {
            margin-bottom: unset;
        }

        .card-title p {
            color: rgb(29, 226, 226);
            font-weight: 900;
            font-size: 30px;
            margin-bottom: unset;
        }

        .card-text p {
            color: grey;
            font-size: 25px;
            text-align: center;
            padding: 3vh 0;
            font-weight: lighter;
        }

        .btn {
            width: 100%;
            background-color: rgb(29, 226, 226);
            border-color: rgb(29, 226, 226);
            border-radius: 25px;
            color: white;
            font-size: 15px;
        }

        .modal-header .close {
            padding: 1rem 1rem;
            margin: 0rem 0rem 0rem auto !important;
            background: black !important;
            color: white !important;
        }

        .modal-content {
            position: relative;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: transparent !important;
            background-clip: padding-box;
            border: none !important;
            border-radius: 0.3rem;
            outline: 0;
        }

        .modal-header {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: start;
            align-items: flex-start;
            -ms-flex-pack: justify;
            justify-content: space-between;
            padding: 1rem 1rem;
            border-bottom: none !important;
            border-top-left-radius: calc(0.3rem - 1px);
            border-top-right-radius: calc(0.3rem - 1px);
        }

        #termsDiv{
            position: relative;
        }

        #termsCheckbox{
            position: absolute;
            left: 30px!important;
            border: 3px solid #73AD21;
        }
    }
</style>

<!-- modify tab -->
<div class="container mt-5 pt-5">
    <div class="row modify">
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/date.png')}}" alt="img">
            <p>Pickup Date & Time
                <br>
                <span>{{$pickupdate}} {{$pickuptime}}</span>
            </p>
        </div>
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/duration.png')}}" alt="img">
            <p>Duration
                <br>
                <span>{{$time ?? ''}}</span>
            </p>
        </div>
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/directions.png')}}" alt="img">
            <p>Trip Type
                <br>
                <span>{{ucwords($triptype) ?? ''}}</span>
            </p>
        </div>
        <div class="box col-3">
            <a href="{{route('main')}}"><button class="singup_btn sign text-white">Modify</button></a>
        </div>
    </div>
</div>
<!-- modify tab -->

<div class="container">
    <div class="modify-route p-2 justify-content-start">
        @if(isset($triptype) && $triptype == 'round-trip')
        @php
        $stops = implode(' -> ', $stops);
        @endphp
        <p class="m-0"><img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> <strong style="color:#ffcc00;">Pick-up: </strong> {{$source}}</p>
        @if(isset($stops) && !empty($stops))
        <p class="m-0"><img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> <strong style="color:#ffcc00;">Stops: </strong> {{$stops}}</p>
        @endif
        <p class="m-0"><img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> <strong style="color:#ffcc00;">Drop-off: </strong> {{$destination}}</p>
        @else
        <p class="m-0"><img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> <strong style="color:#ffcc00;">Pick-up: </strong> {{$source}}</p>
        <p class="m-0"><img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> <strong style="color:#ffcc00;">Drop-off: </strong> {{$destination}}</p>
        @endif
    </div>
</div>

<div class="container">
    <form action="{{route('booking')}}" method="post">
        @csrf
        <div class="row">
            <div class=" col-12 col-md-8 big-form pb-4">
                <div class="modify">
                    <h5>Customer Details</h5>
                    <div class="form-row">
                        <div class="col-12">
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name">
                            </div>
                        </div>
                        <div class="col-12">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Mobile no.</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" class="form-control" placeholder="Enter mobile number">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Alternate mobile no.</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="alternatePhone" class="form-control" placeholder="Enter alternate mobile no.">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Passengers</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <select class="custom-select" id="country">
                                    @for($i=1; $i <= $car->passengers; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Bags</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-suitcase"></i>
                                    </span>
                                </div>
                                <select class="custom-select" id="country">
                                    @for($i=1; $i <= $car->bags; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="gstCheckbox">
                                <label class="form-check-label" for="gstCheckbox">
                                    GST Number
                                </label>
                            </div>
                        </div>
                        <div class="col-12" style="display: none;" id="gstDiv">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money"></i></span>
                                </div>
                                <input type="text" name="gst" class="form-control" placeholder="Enter GST number">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-12 col-sm-6 col-md-4 big-form pb-4 pt-4">
                <div class="card">
                    <div class="container text-center mb-0 pb-0">
                        <img src="{{asset('/assets/admin/assets/img/upload/taxis/').'/'.$car->image}}" width="170px" height="100px" alt="img">
                        <div class="mt-2">
                            <h5 style="font-size:18px;">{{$car->name}} ({{$car->passengers}} + 1)</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Price:</dt>
                            <dd class="text-right ml-3">{{round($price)}} Rs</dd>
                        </dl>
                        <dl class="dlist-align">
                            @php
                            $gst = $price*0.05;
                            @endphp
                            <dt>GST (5%)</dt>
                            <dd class="text-right ml-3">{{round($gst)}} Rs</dd>
                        </dl>
                        <dl class="dlist-align">
                            @php
                            $total = $price + $price*0.05;
                            @endphp
                            <dt>Total:</dt>
                            <dd class="text-right ml-3">{{round($total)}} Rs</dd>
                        </dl>
                        <dl class="dlist-align">
                            <dt>
                                <select class="custom-select" name="paidPercentage" id="pay_percentage">
                                    <option value="100">Pay 100% </option>
                                    <option value="50">Pay 50% </option>
                                    <option value="25">Pay 25% </option>
                                </select>
                            </dt>
                            <input type="hidden" name="price" id="encryptPrice" value="{{encrypt(round($total))}}"></input>
                            <dd class="text-right text-dark b ml-3"><strong  id="totalPrice">{{round($total)}} Rs</strong></dd>
                        </dl>
                        <hr>
                        <div class="form-check" id="termsDiv">
                            <input class="form-check-input" type="checkbox" name="terms" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                I agree to the <a href="#">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" style="background-color: var(--main-color);" class="btn btn-out btn-square btn-main" data-abc="true" data-toggle="modal" data-target="#exampleModal">
                                Submit Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- congratulations -->
<div class='modelboxcong'>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                <div class="card">
                    <!-- <div class="card-img">
                        <img class="img-fluid" src="uploads/about-img.png">
                    </div> -->
                    <div class="card-title">
                        <p>Success!</p>
                    </div>
                    <div class="card-text">
                        <p>Yay! You have successfully booked your cab.</p>
                    </div>
                    <button class="btn">Your Booking ID: ZIPZAP127584</button>
                    <div class="card-text text-center">
                        <small>An email has been sent to your registred email
                            address.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.common.footer')

<script>
    $(document).ready(function() {
        $('#pay_percentage').on('change', function() {
            var percentage = $(this).val();
            var total = {{round($total)}};

            if (percentage == 25) {
                total = Math.ceil(total/4);
                $('#totalPrice').html(total+' Rs');
            } else if (percentage == 50) {
                total = Math.ceil(total/2);
                $('#totalPrice').html(total+' Rs');
            } else {
                $('#totalPrice').html(total+' Rs');
            }
        });

        $('#gstCheckbox').on('change', function(){
            if($(this).prop('checked')){
                $('#gstDiv').show();
            }else{
                $('#gstDiv').hide();
            }
        });
    });
</script>