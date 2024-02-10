<!-- footer -->
<section class="foot_sec">
    <div class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>About Taxi</h3>
                        <ul>
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>Terms of Use</h3>
                        <ul>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                            <li><a href="refund-policy.html">Refund & Cancellation Policy</a></li>
                            <li><a href="faq.html">FAQs</a></li>
                            <li><a href="blog-list.html">Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>Address</h3>
                        <div class="site-link">
                            <ul>
                                <li><a href="#"><i class="fa fa-phone"></i>123456789</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>dummy@zizpap.in</a></li>
                                <li><a href="#"><i class="fa fa-home"></i>address</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-icons">
                            <ul class="social-icons">
                                <li><a target="_blank" href="https://facebook.com" class="social-icon"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://twitter.com" class="social-icon"><i class="fa fa-twitter"></i></a></li>
                                <li><a target="_blank" href="https://linkedin.com" class="social-icon"><i class="fa fa-linkedin"></i></a></li>
                                <li><a target="_blank" href="https://instagram.com" class="social-icon"><i class="fa fa-instagram"></i></a></li>
                                <li><a target="_blank" href="https://youtube.com" class="social-icon"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom mobile-view-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <p class="text-center">© 2021</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer -->

<script>
    function initAutocomplete() {
        $("input[id*='location']").each(function() {
            var autocomplete = new google.maps.places.Autocomplete((this));
            autocomplete.setComponentRestrictions({
                'country': 'IN'
            });
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var dest = $('#location').val();
                var sour = $('#location101').val();
                if ((dest != '') && (sour != '') && (dest === sour)) {
                    $('#location').val('');
                    Swal.fire("Pickup Location and Drop Location Should Be different!");
                }
            });
        });
    }
</script>

<script src="{{asset('assets/frontend/assets/frontuser/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/code.jquery.com/jquery-ui.min.js')}}" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcTmELSehXo7fqusqkvu4FKYtkQM_5--8&libraries=places&loading=async&callback=initAutocomplete"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/jquery.datetimepicker.full.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/datevalidation.js')}}"></script>
<script src="{{asset('assets/frontend/assets/cdnjs.cloudflare.com/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/maxcdn.bootstrapcdn.com/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/owl.carousel.min2.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/wow.js')}}"></script>
<script async defer src="{{asset('assets/frontend/assets/frontuser/js/validation.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('not-found-error'))
<script>
    Swal.fire({
        icon: "error",
        title: "No Result Found",
        text: "There are no cabs in your search criteria, We'll be here soon!",
        footer: '<a href="#">Contact us: 8427997675</a>'
    });
</script>
@endif

<script>
    (function() {
        "use strict";
        var carousels = function() {
            $(".owl-carousel1").owlCarousel({
                loop: true,
                center: true,
                margin: 0,
                responsiveClass: true,
                nav: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    680: {
                        items: 2,
                        nav: false,
                        loop: false
                    },
                    1000: {
                        items: 3,
                        nav: true
                    }
                }
            });
        };
        (function($) {
            carousels();
        })(jQuery);
    })();
</script>
<script>
    // Function to store latest form data in local storage
    function storeFormData(formId) {
        localStorage.clear();
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const formDataObject = {};
        for (let [key, value] of formData.entries()) {
            formDataObject[key] = value;
        }
        if (formId == "roundTripForm") {
            localStorage.setItem('appendedStopHtml', $('#more-stops').html());
        }
        if (formId == "airportForm") {
            localStorage.setItem('airport-source', $('#airport-source').html());
            localStorage.setItem('airport-destination', $('#airport-destination').html());
        }
        localStorage.setItem('latestFormData', JSON.stringify({
            formId: formId,
            formData: formDataObject
        }));
    }

    // Function to initialize form data restoration
    function initializeForm() {
        // append incase of round-trip
        const storedAppendedStopHtml = localStorage.getItem('appendedStopHtml');
        if (storedAppendedStopHtml) {
            $('.airport-input').hide();
            $('#airport-source').html('');
            $('#airport-destination').html('');
            $('.airport-input').html('');
            $('#more-stops').html(storedAppendedStopHtml);
        }

        // append incase of airport
        const storedAirportSource = localStorage.getItem('airport-source');
        if (storedAppendedStopHtml) {
            $('.airport-input').hide();
            $('#airport-source').html('');
            $('#airport-destination').html('');
            $('.airport-input').html('');
            $('#airport-source').html(storedAppendedStopHtml);
        }

        const storedAirportDestination = localStorage.getItem('airport-destination');
        if (storedAppendedStopHtml) {
            $('#airport-destination').html(storedAppendedStopHtml);
        }

        const storedData = localStorage.getItem('latestFormData');
        if (storedData) {
            const {
                formId,
                formData
            } = JSON.parse(storedData);

            if (formId == "roundTripForm") {
                $('#outstation-tab').addClass('active');
                $('#local-tab').removeClass('active');
                $('#outstation').addClass('show active');
                $('#local').removeClass('show active');
                $('#round-trip-tab').addClass('active');
                $('#one-way-tab').removeClass('active');
                $('#round-trip').addClass('show active');
                $('#one-way').removeClass('show active');
            } else if (formId == "onewayForm") {
                $('#outstation-tab').addClass('active');
                $('#local-tab').removeClass('active');
                $('#outstation').addClass('show active');
                $('#local').removeClass('show active');
                $('#round-trip-tab').removeClass('active');
                $('#one-way-tab').addClass('active');
                $('#round-trip').removeClass('show active');
                $('#one-way').addClass('show active');
            } else if (formId == "airportForm") {
                $('#outstation-tab').removeClass('active');
                $('#local-tab').addClass('active');
                $('#outstation').removeClass('show active');
                $('#local').addClass('show active');
                $('#hourly-tab').removeClass('active');
                $('#railway-tab').removeClass('active');
                $('#airport-tab').addClass('active');
                $('#hourly').removeClass('show active');
                $('#railway').removeClass('show active');
                $('#airport').addClass('show active');
                var jsonObject = JSON.parse(storedData);
                console.log(jsonObject.formData.airport);
                if(jsonObject.formData.airport == 'pick'){
                    $('#airportDrop').prop('checked', false);
                    $('#airportPick').prop('checked', true);
                }else{
                    $('#airportDrop').prop('checked', true);
                    $('#airportPick').prop('checked', false);
                }
            }

            if (formId) {
                const form = document.getElementById(formId);
                if (form) {
                    for (let key in formData) {
                        const input = form.querySelector(`[name='${key}']`);
                        if (input) {
                            input.value = formData[key];
                        }
                    }
                }
            }
        }
    }

    // Call initializeForm function when the page loads
    window.onload = initializeForm;
</script>
<script>
    $(document).ready(function() {
        $(".add-more-stops").on("click", function() {
            if ($('#location1').val() !== '') {
                var lastInput = $('#more-stops input:last');
                if (lastInput.val() !== '') {
                    const currentDatetime = new Date().toISOString().replace(/[^0-9]/g, ''); // Generate current datetime
                    const stopHtml = `
                        <div class="stop-location field field_v3 mb-3 position-relative">
                            <label for="city" class="ha-screen-reader">Stop Location</label>
                            <input name="stops[${currentDatetime}]" class="field__input location1" placeholder="" required>
                            <span class="field__label-wrap" aria-hidden="true">
                                <span class="field__label">Stop Location</span>
                            </span>
                            <span class="remove-stop position-absolute" style="color: red; cursor: pointer;">&times;</span>
                        </div>
                    `;
                    $('#more-stops').append(stopHtml);
                    $('.location1').each(function() {
                        var autocomplete = new google.maps.places.Autocomplete(this, {
                            types: ['geocode'],
                            componentRestrictions: {
                                country: "in"
                            }
                        });
                        autocomplete.setTypes(['address']);
                        autocomplete.addListener('place_changed', function() {
                            var place = autocomplete.getPlace();
                            // Do something with the selected place object (e.g. get its latitude and longitude)
                        });
                    });
                }
            }
        });

        $(document).on("click", ".remove-stop", function() {
            $(this).closest('.stop-location').remove();
        });

        $('#airportPick').on('change', function() {
            if ($(this).prop('checked')) {
                $('#airportDrop').prop('checked', false);
                $('#airportPick').prop('checked', true);
                $('.airport-input').hide();
                $('#airport-source').html('');
                $('#airport-destination').html('');
                $('.airport-input').html('');
                $('#airport-source').show();
                $('#airport-destination').show();
                appendPickupAirport()
                appendDropOffLocation()
            } else {
                $('#airportPick').prop('checked', false);
                $('#airportDrop').prop('checked', true);
                $('.airport-input').hide();
                $('#airport-source').html('');
                $('#airport-destination').html('');
                $('#airport-source').show();
                $('#airport-destination').show();
                $('.airport-input').html('');
                appendDropOffAirport()
                appendPickupLocation()
            }
        });

        $('#airportDrop').on('change', function() {
            if ($(this).prop('checked')) {
                $('#airportPick').prop('checked', false);
                $('#airportDrop').prop('checked', true);
                $('.airport-input').hide();
                $('#airport-source').html('');
                $('#airport-destination').html('');
                $('.airport-input').html('');
                $('#airport-source').show();
                $('#airport-destination').show();
                appendDropOffAirport()
                appendPickupLocation()
            } else {
                $('#airportDrop').prop('checked', false);
                $('#airportPick').prop('checked', true);
                $('.airport-input').hide();
                $('#airport-source').html('');
                $('#airport-destination').html('');
                $('#airport-source').show();
                $('#airport-destination').show();
                $('.airport-input').html('');
                appendPickupAirport()
                appendDropOffLocation()
            }
        });

        function appendPickupLocation() {
            $('#airport-source').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Pick-up Location</label>
                    <input type="text" name="source" id="pickupLocation" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Pick-up Location</span>
                    </span>
                </div>
            `);
            locationSearch('pickupLocation');
        }

        function appendDropOffAirport() {
            $('#airport-destination').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Drop off Airport</label>
                    <input type="text" name="destination" id="dropoffAirport" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Drop off Airport</span>
                    </span>
                </div>
            `);
            airportSearch('dropoffAirport');
        }

        function appendPickupAirport() {
            $('#airport-source').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Pick-up Airport</label>
                    <input type="text" name="source" id="pickupAirport" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Pick-up Airport</span>
                    </span>
                </div>
            `);
            airportSearch('pickupAirport');
        }

        function appendDropOffLocation() {
            $('#airport-destination').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Drop off Location</label>
                    <input type="text" name="destination" id="dropoffLocation" placeholder="" class="field__input">
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Drop off Location</span>
                    </span>
                </div>
            `);
            locationSearch('dropoffLocation');
        }

        function airportSearch(inputId) {
            var options = {
                types: ['airport'],
                componentRestrictions: {
                    country: 'in'
                }
            };

            var id = document.getElementById(inputId);
            var autocompleteOnewayFrom = new google.maps.places.Autocomplete(id, options);
            $('#' + inputId).change(function() {

                autocompleteOnewayFrom.addListener('place_changed', function() {
                    var place = autocompleteOnewayFrom.getPlace();
                    var oneWayFromPlace = place.formatted_address;
                    var oneWayFromLat = place.geometry.location.lat();
                    var oneWayFromLng = place.geometry.location.lng();
                });
            });
        }

        function locationSearch(inputId) {
            var options = {
                types: [],
                componentRestrictions: {
                    country: 'in'
                }
            };

            var id = document.getElementById(inputId);
            var autocompleteOnewayFrom = new google.maps.places.Autocomplete(id, options);
            $('#' + inputId).change(function() {

                autocompleteOnewayFrom.addListener('place_changed', function() {
                    var place = autocompleteOnewayFrom.getPlace();
                    var oneWayFromPlace = place.formatted_address;
                    var oneWayFromLat = place.geometry.location.lat();
                    var oneWayFromLng = place.geometry.location.lng();
                });
            });
        }
        airportSearch('drops-airport');
    });
</script>
</body>

</html>