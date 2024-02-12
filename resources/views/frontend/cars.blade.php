@include('frontend.common.header')

<!-- modify tab -->
<div class="container mt-5 pt-5">
    <div class="row modify">
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/date.png')}}" alt="img">
            <p>Pickup Date & Time
                <br>
                <span>01\10\2024 12:00PM</span>
            </p>
        </div>
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/duration.png')}}" alt="img">
            <p>Duration
                <br>
                <span>12 Minutes</span>
            </p>
        </div>
        <div class="box col-3 mb-4">
            <img src="{{asset('assets/frontend/uploads/directions.png')}}" alt="img">
            <p>Trip Type
                <br>
                <span>Oneway</span>
            </p>
        </div>
        <div class="box col-3">
            <button class="singup_btn sign text-white">Modify</button>
        </div>
    </div>
</div>
<!-- modify tab -->

<div class="container">
    <div class="row modify">
        <div class="box col-3 mb-4">
            <!-- <img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> -->
            <p>
                <!-- <br> -->
                <span>chandigarh</span>
            </p>
        </div>
        <div class="box col-3 mb-4">
            <!-- <img src="{{asset('assets/frontend/uploads/pickup.png')}}" alt="img"> -->
            <p>
                <!-- <br> -->
                <span>Ludhiana</span>
            </p>
        </div>
    </div>
</div>


<!-- Product Start -->
<div class="container-fluid py-5">
    <div class="container cars">
        <div class="row g-4 portfolio-container">
            <div class="col-md-6 col-lg-4 mb-4 wow fadeIn " data-wow-delay="0.1s">
                <div class="card">
                    <img src="uploads/cars-img.webp" class="card-img-top" width="100%">
                    <div class="card-body pt-0 px-0">

                        <hr class="mt-2 mx-3">
                        <div class="d-flex flex-row justify-content-between px-3 pb-4">
                            <div class="d-flex flex-column">
                                <span class="text-muted">Sedan</span>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">
                                    Rs. 7/KM
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between p-3 mid">
                            <div class="d-flex flex-column">
                                <small class="text-muted mb-1">BAG</small>
                                <div class="d-flex flex-row">
                                    <img src="uploads/bag.png" width="35px" height="25px">
                                    <div class="d-flex flex-column ml-1">
                                        <h6 class="ml-1">
                                            4&ast;
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <small class="text-muted mb-2">SEATS</small>
                                <div class="d-flex flex-row">
                                    <img src="uploads/seat.png">
                                    <h6 class="ml-1">
                                        8&ast;
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="mx-3 mt-3 mb-2">
                            <button type="button" class="btn btn-block"><small>BOOK
                                    NOW</small></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product End -->

<!-- popup form  -->
<div class="form-popup-bg">
    <div class="form-container">
        <button id="btnCloseForm" class="close-button">X</button>
        <h1 class="text-white pb-4 text-center">Fill this Form to Book a Ride</h1>
        <!-- <p>For more information. Please complete this form.</p> -->
        <form action="">
            <div class="form-group">
                <!-- <label for="">Name</label> -->
                <input type="text" placeholder="Name" class="form-control" />
            </div>
            <div class="form-group">
                <!-- <label for="">Company Name</label> -->
                <input class="form-control" placeholder="Email" type="text" />
            </div>
            <div class="form-group">
                <!-- <label for="">E-Mail Address</label> -->
                <input class="form-control" placeholder="Ph. Number" type="text" />
            </div>
            <div class="form-group">
                <!-- <label for="">Phone Number</label> -->
                <input class="form-control" placeholder="Pickup Address" type="text" />
            </div>
            <button class="butn px-3">Submit</button>
        </form>
    </div>
</div>
<!-- popup form  -->

@include('frontend.common.footer')