@include('frontend.common.header')

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

<!-- Product Start -->
<div class="container-fluid py-5">
    <div class="container cars">
        <div class="row g-4 portfolio-container">
            @foreach($cars as $car)
            <div class="col-md-6 col-lg-4 mb-4 wow fadeIn " data-wow-delay="0.1s">
                <div class="card">
                    <img src="{{asset('/assets/admin/assets/img/upload/taxis/').'/'.$car->taxi->image}}" class="card-img-top" width="100%">
                    <div class="card-body pt-0 px-0">

                        <hr class="mt-2 mx-3">
                        <div class="d-flex flex-row justify-content-between px-3 pb-4">
                            <div class="d-flex flex-column">
                                <span class="text-muted">{{$car->taxi->name}}</span>
                            </div>
                            <div class="d-flex flex-column">
                                <h5 class="mb-0">
                                    Rs. {{round($car->price * $distance)}}
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between p-3 mid">
                            <div class="d-flex flex-column">
                                <small class="text-muted mb-1">BAG</small>
                                <div class="d-flex flex-row">
                                    <img src="{{asset('/assets/frontend/uploads/bag.png')}}" width="35px" height="25px">
                                    <div class="d-flex flex-column ml-1">
                                        <h6 class="ml-1">
                                            {{$car->taxi->bags}}&ast;
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <small class="text-muted mb-2">SEATS</small>
                                <div class="d-flex flex-row">
                                    <img src="{{asset('/assets/frontend/uploads/seat.png')}}">
                                    <h6 class="ml-1">
                                        {{$car->taxi->passengers}}&ast;
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="mx-3 mt-3 mb-2">
                            <form action="{{route('customer-details')}}" method="POST">
                                @csrf
                                <input type="hidden" name="triptype" value="{{$triptype}}"></input>
                                <input type="hidden" name="source" value="{{$source}}"></input>
                                @if(isset($triptype) && $triptype == 'round-trip')
                                <input type="hidden" name="stops" value="{{$stops}}"></input>
                                @endif
                                <input type="hidden" name="destinations" value="{{$destination}}"></input>
                                <input type="hidden" name="pickupdate" value="{{$pickupdate}}"></input>
                                <input type="hidden" name="pickuptime" value="{{$pickuptime}}"></input>
                                <input type="hidden" name="time" value="{{$time}}"></input>
                                <input type="hidden" name="car" value="{{encrypt($car->taxi->id)}}"></input>
                                <input type="hidden" name="distance" value="{{$distance}}"></input>
                                <input type="hidden" name="price" value="{{encrypt(round($car->price * $distance))}}"></input>
                                <input type="hidden" name="phone" value="{{$phone}}"></input>
                                <input type="hidden" name="countryCode" value="{{$countryCode}}"></input>
                                <input type="hidden" name="countryName" value="{{$countryName}}"></input>
                                <button type="submit" class="btn btn-block"><small>BOOK NOW</small></button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Product End -->

@include('frontend.common.footer')