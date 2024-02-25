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

    .is-invalid~.invalid-feedback,
    .is-invalid~.invalid-tooltip,
    .was-validated :invalid~.invalid-feedback,
    .was-validated :invalid~.invalid-tooltip {
        color: #ffcc00;
    }

    .iti__country-name {
        color: #000 !important;
    }

    .intl-tel-input,
    .iti {
        width: 100%;
    }

    .iti {
        width: 100%;
        /* Adjust the width as needed */
    }

    .iti__selected-flag {
        width: auto;
        /* Ensure the flag size is appropriate */
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
    <form action="{{route('booking')}}" method="post" id="bookingForm">
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
                            <input type="text" class="form-control mobile_code_input" placeholder="Contact Number" name="phone" value="{{$phone}}" required>
                            <input type="hidden" class="countryCode" name="countryCode" value="{{$countryCode}}">
                        </div>
                        <div class="col-md-6 col-12">
                            <label>Alternate mobile no.</label>
                            <div class="input-group">
                                <input type="text" class="form-control alter_mobile_code_input" placeholder="Alternate Number" name="alternatePhone">
                                <input type="hidden" class="alterCountryCode" name="alterCountryCode">
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
                                <select class="custom-select" id="country" name="passengers">
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
                                <select class="custom-select" id="country" name="bags">
                                    @for($i=1; $i <= $car->bags; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="gstCheckbox" id="gstCheckbox">
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
                        <input type="hidden" name="source" value="{{$source ?? ''}}">
                        <input type="hidden" name="destination" value="{{$destination ?? ''}}">
                        <input type="hidden" name="stops" value="{{$stops ?? ''}}">
                        <input type="hidden" name="trip" value="{{$triptype ?? ''}}">
                        <input type="hidden" name="pickupdate" value="{{$pickupdate ?? ''}}">
                        <input type="hidden" name="pickuptime" value="{{$pickuptime ?? ''}}">
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
                            <dd class="text-right text-dark b ml-3"><strong id="totalPrice">{{round($total)}} Rs</strong></dd>
                        </dl>
                        <hr>
                        <div class="form-check" id="termsDiv">
                            <input class="form-check-input" type="checkbox" name="terms" id="termsCheckbox" required>
                            <label class="form-check-label" for="termsCheckbox">
                                I agree to the <a href="javascript::void(0)" data-toggle="modal" data-target="#termsAndConditions">Terms & Conditions</a>
                            </label>
                        </div>
                        <div class="text-center">
                            <!-- data-abc="true" data-toggle="modal" data-target="#exampleModal" -->
                            <button type="submit" style="background-color: var(--main-color);" class="btn btn-out btn-square btn-main">
                                Submit Booking
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="termsAndConditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="point">1. CAB FUEL INCLUDED</p>
                <p class="point">2. DRIVER FOOD INCLUDED</p>
                <p class="point">3. DRIVER NIGHT INCLUDED ALL ONE WAY TRIPS ROUND TRIP WILL EXTRA ₹250/DAY</p>
                <p class="point">4. SPECIAL PERMIT CHARGE AND SPECIAL SIGHTSEEING POINT ENTRY NOT INCLUDED ANY TRIP</p>
                <p class="point d-none">5. ONE DAYS MEANS 12:00AM TO 11:59PM</p>
                <p class="point d-none">6. Our date and time runs according to the date, calendar date and time</p>
                <p class="point d-none">7. The AC will be turned off when the car is climbing the mountain</p>
                <p class="point d-none">8. There will be a daily limit of 250 kms in the round trip and the kilometer point to point will be noted</p>
                <p class="point d-none">9. The car will not go to the narrow and congested ma area, and the crowded place</p>
                <p class="point d-none">10. Smoking is prohibited inside the cab</p>
                <p class="point d-none">11. In one way trip, a pet animal charges 500 extra and in round trip 1000 full trips</p>
                <p class="point d-none">12. TOLL + STATE TAX WILL EXTRA EACH ROUND TRIP</p>
                <p class="point d-none">13. EXTRA PICKUP & DROP CHARGEABLE</p>
                <p class="point d-none">14. The only pre - selected points in the hill area will be shown: the remaining km limit will allow you to visit the extra point; you will need to pay extra</p>
                <p class="point d-none">15. PLEASE PAY 10% advance for booking confirmation & your side booking will not refund on CANCEL</p>
                <p class="point d-none">16. If in any way one-sided price is not available then you will have to increase the price, otherwise you can cancel your amount thirty minutes before picksub time and your advance will be refunded</p>
                <button id="viewMoreBtn" class="btn btn-primary mt-3">View More</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('frontend.common.footer')

<script>
    $(document).ready(function() {
        $('#pay_percentage').on('change', function() {
            var percentage = $(this).val();
            var total = '{{round($total)}}';

            if (percentage == 25) {
                total = Math.ceil(total / 4);
                $('#totalPrice').html(total + ' Rs');
            } else if (percentage == 50) {
                total = Math.ceil(total / 2);
                $('#totalPrice').html(total + ' Rs');
            } else {
                $('#totalPrice').html(total + ' Rs');
            }
        });

        $('#gstCheckbox').on('change', function() {
            if ($(this).prop('checked')) {
                $('#gstDiv').show();
            } else {
                $('#gstDiv').hide();
            }
        });

        // Show/hide additional points on click of "View More" button
        $('#viewMoreBtn').click(function() {
            $('.point.d-none').removeClass('d-none');
            $('#viewMoreBtn').hide();
        });

        $('#bookingForm').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    number: true
                },
                terms: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: 'Name is Required.'
                },
                email: {
                    required: 'Email is Required.',
                    email: 'Enter a valid Email.'
                },
                phone: {
                    required: 'Contact number is Required.',
                    number: 'Enter a valid contact detail.'
                },
                terms: {
                    required: 'Check the terms & conditions'
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    var elements = document.querySelectorAll(".mobile_code_input");
    var alterElements = document.querySelectorAll(".alter_mobile_code_input");
    var countryCodeInputs = document.querySelectorAll('.countryCode');
    var altercountryCodeInputs = document.querySelectorAll('.alterCountryCode');
    var countryInitial = '{{ $countryName }}';
    // Function to update country code inputs
    function updateCountryCodeInputs(countryCode) {
        countryCodeInputs.forEach(function(input) {
            input.value = countryCode;
        });
    }

    function alterUpdateCountryCodeInputs(countryCode) {
        altercountryCodeInputs.forEach(function(input) {
            input.value = countryCode;
        });
    }
    // Loop through each element and apply the code
    elements.forEach(function(element) {

        var iti = window.intlTelInput(element, {
            initialCountry: countryInitial,
            separateDialCode: true
        });

        // Listen for the countrychange event
        element.addEventListener('countrychange', function() {
            // Get the selected country's dial code
            var countryCode = iti.getSelectedCountryData().dialCode;
            updateCountryCodeInputs(countryCode);
        });
    });

    alterElements.forEach(function(element) {

        var iti = window.intlTelInput(element, {
            initialCountry: countryInitial,
            separateDialCode: true
        });

        // Listen for the countrychange event
        element.addEventListener('countrychange', function() {
            // Get the selected country's dial code
            var countryCode = iti.getSelectedCountryData().dialCode;
            alterUpdateCountryCodeInputs(countryCode);
        });
    });
</script>