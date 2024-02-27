@include('frontend.common.header')
@include('frontend.indexCss')
<div class="center_search">
    <div class="container-fluid">
        <div class="form-center">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-12">
                    <div class="center_txt">
                        <div class=" d-flex align-items-center justify-content-start">
                            <div style="width: 30px; margin-bottom: 2px; height: 2px;margin-right: 5px; background-color: var(--main-color);">
                            </div>
                            <P style="text-align:start">
                                NEED A RIDE? JUST CALL
                            </P>
                        </div>
                        <h1 class="d-sm-block d-none"><span class="text-dark ">Book your cab</span> <br>With ZipZap Taxi</h1>
                        <p class="d-sm-block d-none">Whether you enjoy city breaks or
                            extended holidays <br> in
                            the sun, you can always
                            improve <br>
                            your travel experiences with our service.</p>
                        <div class="top_btn">
                            <a href="tel:9054865866" class="singup_btn sign ">
                                CALL A TAXI</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-12 wow" data-wow-delay="0.1s" data-wow-duration="2s" style=" animation-name: feInTopRight">
                    <section class="buzz_search">
                        <div class="container">
                            <script>
                                function showlocal() {
                                    $('#hourly-tab').addClass('active');
                                    $('#airport-tab').removeClass('active');
                                    $('#railway-tab').removeClass('active');
                                    $('#hourly').addClass('show active');
                                    $('#airport').removeClass('show active');
                                    $('#railway').removeClass('show active');
                                }
                            </script>
                            <div class="tab-card">
                                <div class="buzz_header">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item w-50 text-center">
                                            <a class="nav-link active br-l" id="outstation-tab" data-toggle="tab" href="#outstation" role="tab" aria-controls="outstation-tab" aria-selected="true">Oneway/ <br> RoundTrip</a>
                                        </li>
                                        <li class="nav-item w-50 text-center" onclick="showlocal();">
                                            <a class="nav-link br-r" id="local-tab" data-toggle="tab" href="#local" role="tab" aria-controls="local" aria-selected="false">Local/Airport/<br>Railway Station
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content tb_con" id="myTabContent">
                                    <div class="tab-pane fade show active " id="outstation" role="tabpanel" aria-labelledby="outstation-tab">
                                        <nav class="tab_cen">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link active" id="one-way-tab" data-toggle="tab" href="#one-way" role="tab" aria-controls="one-way" aria-selected="true">One
                                                    Way</a>
                                                <a class="nav-item nav-link " id="round-trip-tab" data-toggle="tab" href="#round-trip" role="tab" aria-controls="round-trip" aria-selected="false">Round
                                                    Trip</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show show active" id="one-way" role="tabpanel" aria-labelledby="one-way-tab">
                                                <div class="cab_search">
                                                    <div class="container">
                                                        <form id="onewayForm" action="{{route('cabs-view')}}" method="POST" onsubmit="storeFormData('onewayForm')">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Location</label>
                                                                        <input id="location101" name="source" class="field__input" placeholder="" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Location</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Drop Location</label>
                                                                        <input id="location" name="destination" class="field__input" placeholder="" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Drop Location</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3 form-group">
                                                                    <input type="text" class="country-form-control mobile_code_input" placeholder="Contact Number" name="phone" required>
                                                                </div>
                                                                <input type="hidden" class="countryCode" name="countryCode" value="91">
                                                                <input type="hidden" class="countryName" name="countryName" value="in">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Date</label>
                                                                        <input id="datepicker" style="color: white;" name="pickupdate" class="field__input datetimepickerON datepicker" placeholder="" data-dtp="dtp_te2B6">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Date</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 ">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Time</label>
                                                                        <input id="datetimepickernew" style="color: white;" name="pickuptime" class="field__input br-none timeON datetimepickernew" type="text" placeholder="Choose Time" data-dtp="dtp_9bkxX">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Time</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="triptype" value="oneway">
                                                                <div class="col-md-12 col-12 col-lg-12 d-flex justify-content-center align-items-center">
                                                                    <input type="submit" class="search_cb form-control" value="Search Cab">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="round-trip" role="tabpanel" aria-labelledby="round-trip-tab">
                                                <div class="cab_search cab_100">
                                                    <div class="container">
                                                        <form id="roundTripForm" action="{{route('cabs-view')}}" method="POST" onsubmit="storeFormData('roundTripForm')">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Location</label>
                                                                        <input id="location201" name="source" class="field__input" placeholder="" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Location</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Stop Location</label>
                                                                        <input id="location1" name="stops[0]" class="field__input location1" placeholder="" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Stop Location</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div id="more-stops" class="col-11 pr-0 mb-3">
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="float-right add-more-stops"><a href="javascript::void()">+ Add more stops</a></div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Drop Location</label>
                                                                        <input id="location2" name="destination" class="field__input" placeholder="" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Drop Location</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3 form-group">
                                                                    <input type="text" class="country-form-control mobile_code_input" placeholder="Contact Number" name="phone" required>
                                                                </div>
                                                                <input type="hidden" class="countryCode" name="countryCode" value="91">
                                                                <input type="hidden" class="countryName" name="countryName" value="in">
                                                                <input type="hidden" name="triptype" value="round-trip">
                                                                <div class="col-md-12 col-12 col-lg-12 d-flex justify-content-center align-items-center">
                                                                    <input type="submit" class="search_cb form-control" value="Search Cab">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Local-->
                                    <div class="tab-pane fade" id="local" role="tabpanel" aria-labelledby="local">
                                        <nav class="tab_cen">
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <a class="nav-item nav-link " id="hourly-tab" data-toggle="tab" href="#hourly" role="tab" aria-controls="hourly" aria-selected="true">Local</a>
                                                <a class="nav-item nav-link " id="airport-tab" data-toggle="tab" href="#airport" role="tab" aria-controls="airport" aria-selected="false">Airport</a>
                                                <a class="nav-item nav-link " id="railway-tab" data-toggle="tab" href="#railway" role="tab" aria-controls="railway" aria-selected="false">Railway Station</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent1">
                                            <div class="tab-pane fade show " id="hourly" role="tabpanel" aria-labelledby="hourly-tab">
                                                <div class="cab_search">
                                                    <div class="container">
                                                        <form id="localForm" action="{{route('cabs-view')}}" method="POST" onsubmit="storeFormData('localForm')">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="mb-3 col-11 pr-0">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick a city</label>
                                                                        <input type="text" id="location401" name="source" required="" value="" placeholder="" class="field__input localcity" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick a city</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-11 pr-0">
                                                                    <div class="field field_v3">
                                                                        <select id="mySelect" class=" field__input selectpicker ">
                                                                            <option value=""> Select Packages </option>
                                                                            <option value="4-40"> 4 Hours 40 Km </option>
                                                                            <option value="8-80"> 8 Hours 80 Km </option>
                                                                            <option value="12-120"> 12 Hours 120 Km  </option>
                                                                            <option value="24-250"> 12 Hours 120 Km  </option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-11 pr-0 mb-3 form-group">
                                                                    <input type="text" class="country-form-control mobile_code_input" placeholder="Contact Number" name="phone" required>
                                                                </div>
                                                                <input type="hidden" class="countryCode" name="countryCode" value="91">
                                                                <input type="hidden" class="countryName" name="countryName" value="in">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Date</label>
                                                                        <input id="datepicker" style="color: white;" name="pickupdate" class="field__input datetimepickerON datepicker" placeholder="" data-dtp="dtp_te2B6">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Date</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 ">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Time</label>
                                                                        <input id="datetimepickernew" style="color: white;" name="pickuptime" class="field__input br-none timeON datetimepickernew" type="text" placeholder="Choose Time" data-dtp="dtp_9bkxX">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Time</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="triptype" value="local">
                                                                <div class="col-md-12 col-12 col-lg-12 d-flex justify-content-center align-items-center">
                                                                    <input type="submit" class="search_cb form-control" value="Search Cab">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="airport" role="tabpanel" aria-labelledby="airport-tab">
                                                <div class="cab_search cab_100">
                                                    <div class="container">
                                                        <form id="airportForm" action="{{route('cabs-view')}}" method="POST" onsubmit="storeFormData('airportForm')">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6 pr-0 mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="airport-drop" class="custom-control-input" value="drop" id="airportDrop" checked>
                                                                        <label class="custom-control-label" for="airportDrop" style="color:#ffcc00;">Drop off?</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pr-0 mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="airport-pick" class="custom-control-input" value="pick" id="airportPick">
                                                                        <label class="custom-control-label" for="airportPick" style="color:#ffcc00;">Pick up?</label>
                                                                    </div>
                                                                </div>
                                                                <div id="airport-source" class="mb-3 col-11 pr-0" style="display: none;"></div>
                                                                <div id="airport-destination" class="mb-3 col-11 pr-0" style="display: none;"></div>
                                                                <div class="mb-3 col-11 pr-0 airport-input">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Loaction</label>
                                                                        <input type="text" id="location301" name="source" placeholder="" class="field__input transcity" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Loaction</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-11 pr-0 airport-input">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Drop off Airport</label>
                                                                        <input type="text" name="destination" id="drops-airport" placeholder="" class="field__input" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Drop off Airport</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3 form-group">
                                                                    <input type="text" class="country-form-control mobile_code_input" placeholder="Contact Number" name="phone" required>
                                                                </div>
                                                                <input type="hidden" class="countryCode" name="countryCode" value="91">
                                                                <input type="hidden" class="countryName" name="countryName" value="in">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Date</label>
                                                                        <input id="datepicker" style="color: white;" name="pickupdate" class="field__input datetimepickerON datepicker" placeholder="" data-dtp="dtp_te2B6">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Date</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 ">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Time</label>
                                                                        <input id="datetimepickernew" style="color: white;" name="pickuptime" class="field__input br-none timeON datetimepickernew" type="text" placeholder="Choose Time" data-dtp="dtp_9bkxX">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Time</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="triptype" value="oneway">
                                                                <div class="col-md-12 col-12 col-lg-12 d-flex justify-content-center align-items-center">
                                                                    <input type="submit" class="search_cb form-control" value="Search Cab">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade " id="railway" role="tabpanel" aria-labelledby="railway-tab">
                                                <div class="cab_search cab_100">
                                                    <div class="container">
                                                        <form id="railwayForm" action="{{route('cabs-view')}}" method="POST" onsubmit="storeFormData('railwayForm')">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-6 pr-0 mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="railway-drop" class="custom-control-input" value="drop" id="railwayDrop" checked>
                                                                        <label class="custom-control-label" for="railwayDrop" style="color:#ffcc00;">Drop off?</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pr-0 mb-3">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="railway-pick" class="custom-control-input" value="pick" id="railwayPick">
                                                                        <label class="custom-control-label" for="railwayPick" style="color:#ffcc00;">Pick up?</label>
                                                                    </div>
                                                                </div>
                                                                <div id="railway-source" class="mb-3 col-11 pr-0" style="display: none;"></div>
                                                                <div id="railway-destination" class="mb-3 col-11 pr-0" style="display: none;"></div>
                                                                <div class="mb-3 col-11 pr-0 railway-input">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Loaction</label>
                                                                        <input type="text" id="location401" name="source" placeholder="" class="field__input transcity" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Loaction</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col-11 pr-0 railway-input">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Drop-off railway station</label>
                                                                        <input type="text" name="destination" id="drops-railway" placeholder="" class="field__input" required>
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Drop-off railway station</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 mb-3 form-group">
                                                                    <input type="text" class="country-form-control mobile_code_input" placeholder="Contact Number" name="phone" required>
                                                                </div>
                                                                <input type="hidden" class="countryCode" name="countryCode" value="91">
                                                                <input type="hidden" class="countryName" name="countryName" value="in">
                                                                <div class="col-11 pr-0 mb-3">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Date</label>
                                                                        <input id="datepicker" style="color: white;" name="pickupdate" class="field__input datetimepickerON datepicker" placeholder="" data-dtp="dtp_te2B6">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Date</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-11 pr-0 ">
                                                                    <div class="field field_v3">
                                                                        <label for="city" class="ha-screen-reader">Pick-up Time</label>
                                                                        <input id="datetimepickernew" style="color: white;" name="pickuptime" class="field__input br-none timeON datetimepickernew" type="text" placeholder="Choose Time" data-dtp="dtp_9bkxX">
                                                                        <span class="field__label-wrap" aria-hidden="true">
                                                                            <span class="field__label">Pick-up Time</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="triptype" value="oneway">
                                                                <div class="col-md-12 col-12 col-lg-12 d-flex justify-content-center align-items-center">
                                                                    <input type="submit" class="search_cb form-control" value="Search Cab">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- about us  -->
<section class="about_us spacing-cus">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-12">
                <div class="about_txt">
                    <h2>About Us</h2>
                    <p class="wow" data-wow-duration="1s" data-wow-delay="0.1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInDown;">
                        Experience the convenience of ZipZap, where prompt and secure transportation meets exceptional service. Our professional drivers and well-maintained fleet are dedicated to making every ride a smooth journey.&nbsp;
                    </p>
                    <a href="about-us.html" class="singup_btn sign">Know More</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-12 ">
                <div class="about_img ">
                    <img src="{{asset('assets/frontend/uploads/home-about-img.png')}}" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about us  -->

<!-- animation -->
<svg class="bg-svg bg-svg-1" viewBox="0 0 1920 1200" fill="none" xmlns="https://www.w3.org/2000/svg">
    <!-- Car Path-->
    <path class="path-1" d="M0 996.811C39.1077 980.059 142.277 948.044 242.095 954C366.867 961.445 534.148 1047.44 671.5 1030.5C859.5 1007.31 921.823 912.46 1042.87 774.72C1163.92 636.98 1223.51 525.299 1510.3 443.4C1739.73 377.88 1879.03 213.834 1920 140" stroke="#FDC501"></path>
    <path class="path-2" d="M0 1120C91.1628 1061.69 323.558 935.961 587 931.495C916.302 925.913 964.012 1015.99 1070.5 1015.99C1235.34 1015.99 1317.21 857.845 1400.93 668.036C1484.65 478.227 1540.47 107.913 1920 80" stroke="#DFE0E2" stroke-width="2" stroke-dasharray="10 10"></path>
    <!-- Motion Car Path-->
    <path id="motionPath-1" d="M1890 185C1795.5 304 1707.5 359.5 1599 411.5C1556.19 432.018 1508.76 443.217 1469 456.5C1437.59 466.992 1407.06 477.328 1378.5 489.5C1315.84 516.201 1260.71 548.522 1213 588C1132.5 660 1062.03 753.534 1030 789.5C923.447 906.965 872 980.5 751 1014.5C651.5 1042.46 590 1034.82 488 1011C401 987 341.513 968.775 274.5 957.5C239.506 952.575 205.528 952.541 171.5 955.5C139.892 958.248 108.377 963.448 72.5001 973C47.5658 979.638 48 979 30 985C0 997 0 1058.5 0 1058.5C0 1058.5 0 1119 30 1102C60 1085 112.999 1053.52 177.499 1026.5C267.499 986 375.266 957.479 426.5 948.5C547.999 924.5 667.924 934 706.5 934C800.5 934 915 967.5 1012.5 1007.5C1070 1023.5 1113.5 1014.5 1150.5 1002.5C1193.5 985.5 1219 963 1251.5 930.5C1295.03 884.008 1326.44 821 1341.5 794.5C1390.5 702 1422.5 608.5 1449 542C1495 411.5 1534 307.5 1622.5 214.5C1715.5 116.5 1830 89 1890 83.4999C1920 80 1920 110 1920 110C1920 110 1920 141 1890 185Z">
    </path>
    <!-- Car-->
    <g class="svg-car" id="car-1" filter="url(#filter01)" transform="translate(-60, -25)">
        <path d="M23.8081 4.23489L19.4834 4.50457C15.5867 4.75177 11.8027 5.9653 8.58172 8.14517C2.7029 12.1453 0.337861 17.9883 -1.27872e-06 26.5954L-9.81079e-07 33.4046C0.337862 41.9893 2.7029 47.8547 8.58172 51.8324C11.8027 54.0122 15.5867 55.2258 19.4834 55.473L23.8081 55.7426C26.6011 55.9224 29.4166 55.8775 32.2096 55.5853L32.8403 55.5179L103.183 55.5179C107.283 55.3381 109.423 54.5965 112.801 53.2931C118.387 50.8885 120.887 45.8771 120.955 32.3709L120.955 27.5842C120.887 14.078 118.365 9.06655 112.801 6.66195C109.423 5.35853 107.283 4.6394 103.183 4.43714L32.8628 4.43715L32.2321 4.36973C29.4391 4.12253 26.6236 4.07758 23.8081 4.23489ZM36.0387 9.29128L51.3552 12.2802C52.3913 12.4824 53.4274 12.6622 54.4635 12.8195C51.6255 26.056 51.3326 34.0339 54.4635 47.4277C53.4274 47.585 52.3913 47.7648 51.3552 47.967L36.0387 50.9559C32.7277 51.6076 29.4166 49.8323 28.1778 46.7086C26.5335 42.5736 25.8127 37.7868 25.6325 31.3821L25.6325 28.9101C25.8127 22.5053 26.556 17.6961 28.2003 13.5836C29.4166 10.4149 32.7277 8.63957 36.0387 9.29128Z" fill="#F2F2F2"></path>
        <path d="M3.33203 42.349L27.4329 44.4839L27.4329 44.2142L3.46718 41.2253C3.46718 41.7422 3.4897 42.1242 3.33203 42.349Z" fill="#E7E7E7"></path>
        <path d="M3.33203 17.6513L27.4329 15.5164L27.4329 15.786L3.46718 18.7524C3.46718 18.258 3.4897 17.876 3.33203 17.6513Z" fill="#E7E7E7"></path>
        <path d="M99.0616 10.7746C101.764 10.7746 103.949 11.0668 105.706 11.7409C105.526 11.7859 105.346 11.8758 105.166 11.9881C105.796 12.2353 106.382 12.505 106.945 12.7747C108.724 13.6736 110.031 15.2692 110.662 17.1569C111.63 20.1233 111.99 22.9099 112.261 26.7528C112.328 27.7191 112.351 28.663 112.351 29.6293L112.351 30.2586C112.351 31.2024 112.328 32.1463 112.261 33.0677C111.99 36.933 111.63 39.7196 110.662 42.7085C110.053 44.5962 108.724 46.1693 106.945 47.0907C106.382 47.3829 105.796 47.6301 105.143 47.8997C105.278 47.9896 105.413 48.057 105.571 48.1245C103.837 48.8211 101.697 49.1357 99.0616 49.1357C97.9128 49.1357 96.7416 49.0683 95.5703 48.956L95.5703 10.9769C96.7641 10.8196 97.9128 10.7746 99.0616 10.7746Z" fill="#4B545A"></path>
        <path d="M99.0616 10.7746C101.764 10.7746 103.949 11.0668 105.706 11.7409C105.526 11.7859 105.346 11.8758 105.166 11.9881C105.796 12.2353 106.382 12.505 106.945 12.7747C108.724 13.6736 110.031 15.2692 110.662 17.1569C111.63 20.1233 111.99 22.9099 112.261 26.7528C112.328 27.7191 112.351 28.663 112.351 29.6293L112.351 30.2586C112.351 31.2024 112.328 32.1463 112.261 33.0677C111.99 36.933 111.63 39.7196 110.662 42.7085C110.053 44.5962 108.724 46.1693 106.945 47.0907C106.382 47.3829 105.796 47.6301 105.143 47.8997C105.278 47.9896 105.413 48.057 105.571 48.1245C103.837 48.8211 101.697 49.1357 99.0616 49.1357C97.9128 49.1357 96.7416 49.0683 95.5703 48.956L95.5703 10.9769C96.7641 10.8196 97.9128 10.7746 99.0616 10.7746Z" fill="#4388FC" fill-opacity="0.1"></path>
        <path d="M99.0616 10.7746C101.764 10.7746 103.949 11.0668 105.706 11.7409C105.526 11.7859 105.346 11.8758 105.166 11.9881C105.796 12.2353 106.382 12.505 106.945 12.7747C108.724 13.6736 110.031 15.2692 110.662 17.1569C111.63 20.1233 111.99 22.9099 112.261 26.7528C112.328 27.7191 112.351 28.663 112.351 29.6293L112.351 30.2586C112.351 31.2024 112.328 32.1463 112.261 33.0677C111.99 36.933 111.63 39.7196 110.662 42.7085C110.053 44.5962 108.724 46.1693 106.945 47.0907C106.382 47.3829 105.796 47.6301 105.143 47.8997C105.278 47.9896 105.413 48.057 105.571 48.1245C103.837 48.8211 101.697 49.1357 99.0616 49.1357C97.9128 49.1357 96.7416 49.0683 95.5703 48.956L95.5703 10.9769C96.7641 10.8196 97.9128 10.7746 99.0616 10.7746Z" fill="url(#paint0_radial01)" fill-opacity="0.77"></path>
        <path d="M89.6921 48.2814C91.7643 48.3264 93.9041 48.3713 96.2691 48.4163C96.4493 48.4163 96.6295 48.4612 96.7872 48.5511C97.508 48.9332 97.7557 49.4725 97.5981 50.3265C97.2151 51.5625 96.0664 52.1917 94.0392 52.2367L37.4359 53.4502C37.3909 53.4502 37.3458 53.4502 37.3008 53.4502C37.3233 53.4277 37.3684 53.4052 37.4134 53.3828L38.6748 52.7311C38.945 52.5962 39.2379 52.4839 39.5532 52.4164L49.2837 50.5737C56.1761 49.2702 62.2801 48.5736 68.0013 48.4837C76.7632 48.0118 82.7546 48.1241 89.6921 48.2814Z" fill="#4B545A"></path>
        <path d="M89.6921 48.2814C91.7643 48.3264 93.9041 48.3713 96.2692 48.4163C96.4493 48.4163 96.6295 48.4612 96.7872 48.5511C97.508 48.9332 97.7558 49.4725 97.5981 50.3265C97.2152 51.5625 96.0664 52.1917 94.0393 52.2367L37.4359 53.4502C37.3909 53.4502 37.3458 53.4502 37.3008 53.4502C37.3233 53.4277 37.3684 53.4052 37.4134 53.3828L38.6748 52.7311C38.945 52.5962 39.2379 52.4839 39.5532 52.4164L49.2837 50.5737C56.1761 49.2702 62.2801 48.5736 68.0013 48.4837C76.7632 48.0118 82.7546 48.1241 89.6921 48.2814Z" fill="#4388FC" fill-opacity="0.1"></path>
        <path d="M89.6921 48.2814C91.7643 48.3264 93.9041 48.3713 96.2692 48.4163C96.4493 48.4163 96.6295 48.4612 96.7872 48.5511C97.508 48.9332 97.7558 49.4725 97.5981 50.3265C97.2152 51.5625 96.0664 52.1917 94.0393 52.2367L37.4359 53.4502C37.3909 53.4502 37.3458 53.4502 37.3008 53.4502C37.3233 53.4277 37.3684 53.4052 37.4134 53.3828L38.6748 52.7311C38.945 52.5962 39.2379 52.4839 39.5532 52.4164L49.2837 50.5737C56.1761 49.2702 62.2801 48.5736 68.0013 48.4837C76.7632 48.0118 82.7546 48.1241 89.6921 48.2814Z" fill="url(#paint1_radial01)" fill-opacity="0.77"></path>
        <path d="M71.6735 52.7084C72.4844 51.2477 72.7772 50.169 73.0024 48.2588L69.5562 48.3936C68.6327 50.1016 67.7318 51.3601 66.2227 52.8433L71.6735 52.7084Z" fill="#4B545A"></path>
        <path d="M44.3734 51.4951L43.9004 53.2929L37.4359 53.4277C37.3909 53.4277 37.3458 53.4277 37.3008 53.4277C37.3233 53.4053 37.3684 53.3828 37.4134 53.3603L38.6748 52.7086C38.945 52.5738 39.2379 52.4614 39.5532 52.394L44.3734 51.4951Z" fill="#4B545A"></path>
        <path d="M89.6921 11.6959C91.7643 11.651 93.9041 11.606 96.2691 11.5611C96.4493 11.5611 96.6295 11.5161 96.7872 11.4262C97.508 11.0442 97.7557 10.5048 97.5981 9.65088C97.2151 8.41487 96.0664 7.78563 94.0392 7.74069L37.4359 6.52716C37.3909 6.52716 37.3458 6.52716 37.3008 6.52716C37.3233 6.54963 37.3684 6.5721 37.4134 6.59458L38.6748 7.24629C38.945 7.38113 39.2379 7.49349 39.5532 7.56091L49.3287 9.42615C56.2211 10.7296 62.3252 11.4262 68.0463 11.5161C76.7632 11.9881 82.7546 11.8532 89.6921 11.6959Z" fill="#4B545A"></path>
        <path d="M89.6921 11.6959C91.7643 11.651 93.9041 11.606 96.2691 11.5611C96.4493 11.5611 96.6295 11.5161 96.7872 11.4262C97.508 11.0442 97.7557 10.5048 97.5981 9.65088C97.2152 8.41487 96.0664 7.78563 94.0393 7.74069L37.4359 6.52716C37.3909 6.52716 37.3458 6.52716 37.3008 6.52716C37.3233 6.54963 37.3684 6.5721 37.4134 6.59458L38.6748 7.24629C38.945 7.38113 39.2379 7.49349 39.5532 7.56091L49.3287 9.42615C56.2211 10.7296 62.3252 11.4262 68.0463 11.5161C76.7632 11.9881 82.7546 11.8532 89.6921 11.6959Z" fill="#4388FC" fill-opacity="0.1"></path>
        <path d="M89.6921 11.6959C91.7643 11.651 93.9041 11.606 96.2691 11.5611C96.4493 11.5611 96.6295 11.5161 96.7872 11.4262C97.508 11.0442 97.7557 10.5048 97.5981 9.65088C97.2152 8.41487 96.0664 7.78563 94.0393 7.74069L37.4359 6.52716C37.3909 6.52716 37.3458 6.52716 37.3008 6.52716C37.3233 6.54963 37.3684 6.5721 37.4134 6.59458L38.6748 7.24629C38.945 7.38113 39.2379 7.49349 39.5532 7.56091L49.3287 9.42615C56.2211 10.7296 62.3252 11.4262 68.0463 11.5161C76.7632 11.9881 82.7546 11.8532 89.6921 11.6959Z" fill="url(#paint2_radial01)" fill-opacity="0.77"></path>
        <path d="M71.6969 7.26864C72.5078 8.72937 72.8006 9.80807 73.0259 11.7183L69.5797 11.5834C68.6562 9.87549 67.7552 8.61701 66.2461 7.1338L71.6969 7.26864Z" fill="#4B545A"></path>
        <path d="M44.3968 8.48242L43.9238 6.6846L37.4594 6.54976C37.4143 6.54976 37.3693 6.54976 37.3242 6.54976C37.3467 6.57223 37.3918 6.59471 37.4368 6.61718L38.6982 7.26889C38.9685 7.40372 39.2613 7.51609 39.5766 7.58351L44.3968 8.48242Z" fill="#4B545A"></path>
        <path d="M40.543 52.6865C41.0835 52.5517 41.3989 52.5741 41.9169 52.6865L41.9169 54.5518L40.543 54.5518L40.543 52.6865Z" fill="#594F4F"></path>
        <path d="M40.9265 54.237L42.8185 54.2594C43.0212 54.2594 43.2014 54.3943 43.269 54.5965L44.8907 59.4507C44.9358 59.608 44.8457 59.7878 44.688 59.8327C44.4403 59.9001 44.17 59.9675 43.8321 59.99C43.6069 60.0125 43.3816 59.99 43.2014 59.99C42.7284 59.9451 42.2779 59.7653 41.9175 59.4731C41.6022 59.2035 41.2869 58.8664 41.0391 58.3495C40.7238 57.6978 40.5436 56.8213 40.521 55.9449C40.4985 55.5404 40.521 55.0235 40.5436 54.619C40.5436 54.3943 40.7238 54.237 40.9265 54.237Z" fill="#594F4F"></path>
        <path d="M40.5469 7.31385C41.0875 7.44868 41.4028 7.42621 41.9209 7.31385L41.9209 5.44861L40.5469 5.44861L40.5469 7.31385Z" fill="#594F4F"></path>
        <path d="M40.9499 5.76318L42.842 5.74071C43.0447 5.74071 43.2249 5.60588 43.2924 5.40362L44.9142 0.549494C44.9592 0.392184 44.8691 0.212399 44.7115 0.167454C44.4637 0.100035 44.1934 0.032621 43.8555 0.0101482C43.6303 -0.0123245 43.4051 0.0101483 43.2249 0.0101483C42.7519 0.0550939 42.3014 0.234874 41.941 0.52702C41.6256 0.796694 41.3103 1.13379 41.0625 1.65066C40.7472 2.30237 40.567 3.17881 40.5445 4.05525C40.522 4.45976 40.5445 4.97664 40.567 5.38115C40.567 5.60587 40.7247 5.76318 40.9499 5.76318Z" fill="#594F4F"></path>
        <path d="M4.14453 44.0344C7.05015 48.7762 10.4513 51.4504 15.8571 52.8213L13.1542 52.8213C11.555 52.8213 10.0233 52.2819 8.80704 51.2482C6.46452 49.2256 4.93288 47.248 4.14453 44.0344Z" fill="url(#paint3_linear01)"></path>
        <path d="M4.14453 44.0344C7.05015 48.7762 10.4513 51.4504 15.8571 52.8213L13.1542 52.8213C11.555 52.8213 10.0233 52.2819 8.80704 51.2482C6.46452 49.2256 4.93288 47.248 4.14453 44.0344Z" fill="url(#paint4_linear01)"></path>
        <path d="M15.8346 52.7979L13.1542 52.7979C11.555 52.7979 10.0233 52.2585 8.80704 51.2248C6.46452 49.2247 4.93288 47.2471 4.14453 44.0334C7.05015 48.7752 10.4288 51.4495 15.8346 52.7979Z" fill="#D5E3F0"></path>
        <path d="M4.14453 16.168C7.05015 11.4262 10.4513 8.75192 15.8571 7.38108L13.1542 7.38108C11.555 7.38108 10.0233 7.92043 8.80704 8.95418C6.46452 10.9543 4.93288 12.9544 4.14453 16.168Z" fill="url(#paint5_linear01)"></path>
        <path d="M4.14453 16.168C7.05015 11.4262 10.4513 8.75192 15.8571 7.38108L13.1542 7.38108C11.555 7.38108 10.0233 7.92043 8.80704 8.95418C6.46452 10.9543 4.93288 12.9544 4.14453 16.168Z" fill="url(#paint6_linear01)"></path>
        <path d="M15.8337 7.38108L13.1533 7.38108C11.5541 7.38108 10.0224 7.92043 8.80613 8.95418C6.44109 10.9543 4.90944 12.9544 4.12109 16.168C7.04924 11.4262 10.4279 8.75192 15.8337 7.38108Z" fill="#D5E3F0"></path>
        <path d="M119.782 44.551C118.521 49.3826 116.246 51.8322 112.822 53.3154C111.831 53.6974 110.93 54.0345 110.074 54.3267L110.209 53.8772C110.682 52.3715 111.786 51.158 113.228 50.5287C115.57 49.5175 116.584 48.4612 118.16 45.4049C118.476 44.7982 119.129 44.4611 119.782 44.551Z" fill="#D8394C"></path>
        <path d="M119.782 15.449C118.521 10.6173 116.246 8.1678 112.822 6.6846C111.831 6.30256 110.93 5.96547 110.074 5.67332L110.209 6.12278C110.682 7.62846 111.786 8.84199 113.228 9.47123C115.57 10.4825 116.584 11.5387 118.16 14.595C118.476 15.2018 119.129 15.5389 119.782 15.449Z" fill="#D8394C"></path>
        <path d="M31.1286 28.8874C31.3088 22.3253 32.0971 17.651 33.6513 13.7632C34.327 12.0777 35.6785 10.7743 37.3678 10.145L51.2427 12.8642C52.0761 13.0216 52.932 13.1789 53.7654 13.3137C52.2788 20.3926 51.6481 25.5614 51.6481 30.4829C51.6481 35.4719 52.3013 40.5957 53.7654 46.9555C52.932 47.0904 52.0761 47.2252 51.2427 47.405L37.3678 50.1017C35.6785 49.4725 34.327 48.1691 33.6513 46.4836C32.0971 42.5733 31.3313 37.9215 31.1286 31.3594L31.1286 28.8874ZM30.543 28.8874L30.543 31.3594C30.7232 37.7642 31.4665 42.5733 33.0882 46.6859C33.854 48.6185 35.4307 50.0568 37.3002 50.686L51.3553 47.9443C52.3914 47.7421 53.4276 47.5623 54.4637 47.405C52.932 40.8654 52.2338 35.6292 52.2338 30.438C52.2338 24.9771 53.0221 19.5836 54.4637 12.7743C53.4276 12.617 52.3914 12.4373 51.3553 12.235L37.3227 9.49332C35.4532 10.145 33.8765 11.5608 33.1107 13.4935C31.4665 17.6734 30.7232 22.4826 30.543 28.8874Z" fill="black"></path>
        <path d="M37.3237 9.53824L51.3562 12.2799C52.3923 12.4822 53.4285 12.662 54.4646 12.8193C51.6265 26.0558 51.3337 34.0336 54.4646 47.4275C53.4285 47.5848 52.3923 47.7646 51.3562 47.9668L37.3237 50.7085C35.4542 50.0568 33.8775 48.641 33.1116 46.7083C31.4674 42.5733 30.7466 37.7866 30.5664 31.3818L30.5664 28.9098C30.7466 22.5051 31.4899 17.6959 33.1342 13.5834C33.8775 11.6057 35.4542 10.19 37.3237 9.53824Z" fill="#4B545A"></path>
        <path d="M37.3237 9.53824L51.3562 12.2799C52.3923 12.4822 53.4285 12.662 54.4646 12.8193C51.6265 26.0558 51.3337 34.0336 54.4646 47.4275C53.4285 47.5848 52.3923 47.7646 51.3562 47.9668L37.3237 50.7085C35.4542 50.0568 33.8775 48.641 33.1116 46.7083C31.4674 42.5733 30.7466 37.7866 30.5664 31.3818L30.5664 28.9098C30.7466 22.5051 31.4899 17.6959 33.1342 13.5834C33.8775 11.6057 35.4542 10.19 37.3237 9.53824Z" fill="#4388FC" fill-opacity="0.1"></path>
        <path d="M37.3237 9.53824L51.3562 12.2799C52.3923 12.4822 53.4285 12.662 54.4646 12.8193C51.6265 26.0558 51.3337 34.0336 54.4646 47.4275C53.4285 47.5848 52.3923 47.7646 51.3562 47.9668L37.3237 50.7085C35.4542 50.0568 33.8775 48.641 33.1116 46.7083C31.4674 42.5733 30.7466 37.7866 30.5664 31.3818L30.5664 28.9098C30.7466 22.5051 31.4899 17.6959 33.1342 13.5834C33.8775 11.6057 35.4542 10.19 37.3237 9.53824Z" fill="url(#paint7_radial01)" fill-opacity="0.77"></path>
        <path d="M36.0381 9.29124C32.727 8.63952 29.416 10.4149 28.1771 13.5386C26.5329 17.6736 25.8121 22.4603 25.6094 28.8651L25.6094 31.3371C25.7896 37.7419 26.5329 42.551 28.1546 46.6636C29.3934 49.7873 32.7045 51.5627 36.0156 50.9109L37.2994 50.6637C35.4299 50.012 33.8532 48.5962 33.0874 46.6636C31.4431 42.5286 30.7224 37.7419 30.5422 31.3371L30.5422 28.8651C30.7224 22.4603 31.4657 17.6511 33.1099 13.5386C33.8758 11.6059 35.4524 10.1677 37.322 9.53844L36.0381 9.29124Z" fill="#4B545A"></path>
        <path d="M2.95158 17.8534C2.97411 17.8534 3.01915 17.9432 3.01915 18.1904L3.01916 41.7869C3.01916 42.0341 2.95158 42.124 2.95158 42.124C2.92906 42.124 2.79391 42.0791 2.61372 41.8094L2.47858 41.6071C1.64518 40.4161 1.03703 39.5396 0.451397 38.0789C0.226155 36.6182 0.0910098 35.0676 0.0234371 33.4046L0.0234368 26.5953C0.0910093 24.9323 0.226154 23.3817 0.451396 21.9209C0.451396 21.9209 0.451396 21.9209 0.451396 21.8985C1.03703 20.4377 1.64518 19.5613 2.47857 18.3702L2.61372 18.168C2.79391 17.8983 2.92906 17.8534 2.95158 17.8534Z" fill="#4B545A"></path>
        <path d="M92.8008 48.4166L92.8008 11.5611C92.8008 11.5611 95.4503 11.2637 98.3192 12.7971C104.626 16.1681 104.288 44.7086 98.3192 47.2929C95.3336 48.5856 92.8008 48.4166 92.8008 48.4166Z" fill="#F2F2F2"></path>
    </g>
    <!-- Car Colors-->
    <defs>
        <filter id="filter01" x="-20" y="-16" width="161.016" height="100.032" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feflood flood-opacity="0" result="BackgroundImageFix"></feflood>
            <fecolormatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0">
            </fecolormatrix>
            <feoffset dy="4"></feoffset>
            <fegaussianblur stdDeviation="10"></fegaussianblur>
            <fecolormatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
            </fecolormatrix>
            <feblend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"></feblend>
            <feblend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape">
            </feblend>
        </filter>
        <radialgradient id="paint0_radial01" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(26.6299 31.0296) rotate(-179.985) scale(19.2582 63.4877)">
            <stop offset="0" stop-color="white" stop-opacity="0.8"></stop>
            <stop offset="1" stop-color="white" stop-opacity="0.01"></stop>
        </radialgradient>
        <radialgradient id="paint1_radial01" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(18.6511 9.24553) rotate(-179.952) scale(65.9554 8.3634)">
            <stop offset="0" stop-color="white" stop-opacity="0.8"></stop>
            <stop offset="1" stop-color="white" stop-opacity="0.01"></stop>
        </radialgradient>
        <radialgradient id="paint2_radial01" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(18.6394 50.8587) rotate(-179.952) scale(65.9553 8.37965)">
            <stop offset="0" stop-color="white" stop-opacity="0.8"></stop>
            <stop offset="1" stop-color="white" stop-opacity="0.01"></stop>
        </radialgradient>
        <lineargradient id="paint3_linear01" x1="111.027" y1="7.22103" x2="111.025" y2="16.0053" gradientUnits="userSpaceOnUse">
            <stop offset="0.1548" stop-color="#A1A1A1"></stop>
            <stop offset="0.9205" stop-color="white"></stop>
        </lineargradient>
        <lineargradient id="paint4_linear01" x1="111.027" y1="7.22103" x2="111.025" y2="16.0053" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#333333"></stop>
            <stop offset="0.1883"></stop>
            <stop offset="0.3849" stop-color="#333333"></stop>
            <stop offset="0.5983"></stop>
            <stop offset="0.8033" stop-color="#333333"></stop>
            <stop offset="1"></stop>
        </lineargradient>
        <lineargradient id="paint5_linear01" x1="111.013" y1="52.6504" x2="111.015" y2="43.8661" gradientUnits="userSpaceOnUse">
            <stop offset="0.1548" stop-color="#A1A1A1"></stop>
            <stop offset="0.9205" stop-color="white"></stop>
        </lineargradient>
        <lineargradient id="paint6_linear01" x1="111.013" y1="52.6504" x2="111.015" y2="43.8661" gradientUnits="userSpaceOnUse">
            <stop offset="0" stop-color="#333333"></stop>
            <stop offset="0.1883"></stop>
            <stop offset="0.3849" stop-color="#333333"></stop>
            <stop offset="0.5983"></stop>
            <stop offset="0.8033" stop-color="#333333"></stop>
            <stop offset="1"></stop>
        </lineargradient>
        <radialgradient id="paint7_radial01" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(64.6762 30.1908) rotate(-179.333) scale(26.1227 64.9034)">
            <stop offset="0" stop-color="white" stop-opacity="0.8"></stop>
            <stop offset="1" stop-color="white" stop-opacity="0.01"></stop>
        </radialgradient>
    </defs>
    <!-- Animation-->
    <animatemotion xlink:href="#car-1" dur="15s" begin="0s" fill="freeze" repeatCount="indefinite" rotate="auto-reverse">
        <mpath xlink:href="#motionPath-1"></mpath>
    </animatemotion>
</svg>
<!-- animation -->


<!-- Start services Area -->
<section class="services-area mar-desk">
    <div class="container">
        <div class="row section-title">
            <h1><strong>What Services we offer to our clients</strong></h1>
            <p>Who are in extremely love with eco friendly system.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 single-service">
                <img style="border-radius: 33%; padding: 15px; border: 2px solid black;" src="{{asset('assets/frontend/uploads/frontal-taxi-cab.png')}}" alt="img">
                <a href="#">
                    <h4>Taxi Service</h4>
                </a>
                <p>
                    Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                </p>
            </div>
            <div class="col-lg-4 single-service">
                <img style="border-radius: 33%; padding: 15px; border: 2px solid black;" src="{{asset('assets/frontend/uploads/location.png')}}" alt="img">
                <a href="#">
                    <h4>Office Pick-ups</h4>
                </a>
                <p>
                    Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                </p>
            </div>
            <div class="col-lg-4 single-service">
                <img style="border-radius: 33%; padding: 15px; border: 2px solid black;" src="{{asset('assets/frontend/uploads/red-carpet.png')}}" alt="img">
                <a href="#">
                    <h4>Event Transportation</h4>
                </a>
                <p>
                    Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End services Area -->

<!-- rating -->
<div _ngcontent-wcm-c63="" class="row review-icons-bg mar-desk">
    <div _ngcontent-wcm-c63="" class="text-center ng-star-inserted">
        <div _ngcontent-wcm-c63="" class="ng-star-inserted">
            <div _ngcontent-wcm-c63="" class="row align-items-center my-2 mx-0">
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63="" class="tripadvisor-icon website-icon ng-star-inserted">
                        <img src="{{asset('assets/frontend/uploads/tripadvisor.png')}}" width="70" alt="img">
                    </div>
                </div>
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63=""> Trip Advisor </div>
                    <div _ngcontent-wcm-c63="" class="tripadvisor-rating website-rating-image">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <div _ngcontent-wcm-c63="">
                        <div _ngcontent-wcm-c63="" class="reviews-text mt-1">(295 reviews)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div _ngcontent-wcm-c63="" class="text-center ng-star-inserted">
        <div _ngcontent-wcm-c63="" class="ng-star-inserted">
            <div _ngcontent-wcm-c63="" class="row align-items-center my-2 mx-0">
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63="" class="google-icon website-icon ng-star-inserted">
                        <img src="{{asset('assets/frontend/uploads/google.png')}}" width="70" alt="img">
                    </div>
                </div>
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63=""> Google </div>
                    <div _ngcontent-wcm-c63="" class="google-rating website-rating-image">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <div _ngcontent-wcm-c63="">
                        <div _ngcontent-wcm-c63="" class="reviews-text mt-1">(3101 reviews)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div _ngcontent-wcm-c63="" class="text-center ng-star-inserted">
        <div _ngcontent-wcm-c63="" class="ng-star-inserted">
            <div _ngcontent-wcm-c63="" class="row align-items-center my-2 mx-0">
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63="" class="playstore-icon website-icon ng-star-inserted">
                        <img src="{{asset('assets/frontend/uploads/playstore.png')}}" width="70" alt="img">
                    </div>

                </div>
                <div _ngcontent-wcm-c63="" class="px-2">
                    <div _ngcontent-wcm-c63=""> Play Store </div>
                    <div _ngcontent-wcm-c63="" class="google-rating website-rating-image">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked "></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <div _ngcontent-wcm-c63="">
                        <div _ngcontent-wcm-c63="" class="reviews-text mt-1">(7840 reviews)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- rating -->

<!-- Start reviews Area -->
<section class="reviews-area section-gap">
    <div class="container">
        <div class="row section-title">
            <h1>Client’s Reviews</h1>
            <p>Who are in extremely love with eco friendly system.</p>
        </div>
        <div class="gtco-testimonials">

            <div class="owl-carousel owl-carousel1 owl-theme">
                <div>
                    <div class="card text-center"><img class="card-img-top" src="https://images.unsplash.com/photo-1572561300743-2dd367ed0c9a?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=300&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=300" alt="">
                        <div class="card-body">
                            <h5>Ronne Galle <br />
                                <span> Project Manager </span>
                            </h5>
                            <p class="card-text">“ Nam libero tempore, cum
                                soluta
                                nobis est eligendi optio cumque nihil
                                impedit quo minus id quod maxime placeat
                                ” </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="https://images.unsplash.com/photo-1588361035994-295e21daa761?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=301&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=301" alt="">
                        <div class="card-body">
                            <h5>Missy Limana<br />
                                <span> Engineer </span>
                            </h5>
                            <p class="card-text">“ Nam libero tempore, cum
                                soluta
                                nobis est eligendi optio cumque nihil
                                impedit quo minus id quod maxime placeat
                                ” </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="https://images.unsplash.com/photo-1575377222312-dd1a63a51638?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=302&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=302" alt="">
                        <div class="card-body">
                            <h5>Martha Brown<br />
                                <span> Project Manager </span>
                            </h5>
                            <p class="card-text">“ Nam libero tempore, cum
                                soluta
                                nobis est eligendi optio cumque nihil
                                impedit quo minus id quod maxime placeat
                                ” </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card text-center"><img class="card-img-top" src="https://images.unsplash.com/photo-1549836938-d278c5d46d20?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=303&ixid=eyJhcHBfaWQiOjF9&ixlib=rb-1.2.1&q=50&w=303" alt="">
                        <div class="card-body">
                            <h5>Hanna Lisem<br />
                                <span> Project Manager </span>
                            </h5>
                            <p class="card-text">“ Nam libero tempore, cum
                                soluta
                                nobis est eligendi optio cumque nihil
                                impedit quo minus id quod maxime placeat
                                ” </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End reviews Area -->


<!-- Start home-calltoaction Area -->
<section class="home-calltoaction-area relative">
    <div class="container">
        <div class=""></div>
        <div class="row align-items-center section-gap">
            <div class="col-lg-8">
                <h1><strong>Experience Great Support</strong></h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                    eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                    minim
                    veniam, quis nostrud exercitation.
                </p>
            </div>
            <div class="col-lg-4 btn-left">
                <a href="#" style="font-style: bold; border-radius: 50px; padding: 15px 15px 15px 15px;" class="sign primary-btn"><strong>Reach Our Support
                        Team</strong></a>
            </div>
        </div>
    </div>
</section>
<!-- End home-calltoaction Area -->
@include('frontend.common.footer')
@include('frontend.assets.indexjs')