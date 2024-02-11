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
            localStorage.setItem('airportSource', $('#airport-source').html());
            localStorage.setItem('airportDestination', $('#airport-destination').html());
        }
        if (formId == "railwayForm") {
            localStorage.setItem('railwaySource', $('#railway-source').html());
            localStorage.setItem('railwayDestination', $('#railway-destination').html());
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
        const storedAirportSource = localStorage.getItem('airportSource');
        if (storedAirportSource) {
            $('.airport-input').hide();
            $('.airport-input').html('');
            $('#airport-source').html('');
            $('#airport-destination').html('');
            $('#airport-source').html(storedAirportSource);
            $('#airport-source').show();

            // Check if #pickupLocation exists
            if ($('#pickupAirport').length > 0) {
                var typesParam = ['airport'];
                var inputId = "pickupAirport";
            } else {
                var typesParam = ['geocode'];
                var inputId = "pickupLocation";
            }

            var options = {
                types: typesParam,
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

        const storedAirportDestination = localStorage.getItem('airportDestination');
        if (storedAirportDestination) {
            $('#airport-destination').html(storedAirportDestination);
            $('#airport-destination').show();
            if ($('#dropoffAirport').length > 0) {
                var typesParam = ['airport'];
                var inputId = "dropoffAirport";
            } else {
                var typesParam = ['geocode'];
                var inputId = "dropoffLocation";
            }

            var options = {
                types: typesParam,
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

        // append incase of railway
        const storedRailwaySource = localStorage.getItem('railwaySource');
        if (storedRailwaySource) {
            $('.railway-input').hide();
            $('.railway-input').html('');
            $('#railway-source').html('');
            $('#railway-destination').html('');
            $('#railway-source').html(storedRailwaySource);
            $('#railway-source').show();

            // Check if #pickupLocation exists
            if ($('#pickupRailway').length > 0) {
                var typesParam = ['train_station'];
                var inputId = "pickupRailway";
            } else {
                var typesParam = ['geocode'];
                var inputId = "pickupLocationRailway";
            }

            var options = {
                types: typesParam,
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

        const storedRailwayDestination = localStorage.getItem('railwayDestination');
        if (storedRailwayDestination) {
            $('#railway-destination').html(storedRailwayDestination);
            $('#railway-destination').show();
            if ($('#dropoffRailway').length > 0) {
                var typesParam = ['train_station'];
                var inputId = "dropoffRailway";
            } else {
                var typesParam = ['geocode'];
                var inputId = "pickupLocationRailway";
            }

            var options = {
                types: typesParam,
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
            } else if (formId == "railwayForm") {
                $('#outstation-tab').removeClass('active');
                $('#local-tab').addClass('active');
                $('#outstation').removeClass('show active');
                $('#local').addClass('show active');
                $('#hourly-tab').removeClass('active');
                $('#railway-tab').addClass('active');
                $('#airport-tab').removeClass('active');
                $('#hourly').removeClass('show active');
                $('#railway').addClass('show active');
                $('#airport').removeClass('show active');
            } else if (formId == "localForm") {
                $('#outstation-tab').removeClass('active');
                $('#local-tab').addClass('active');
                $('#outstation').removeClass('show active');
                $('#local').addClass('show active');
                $('#hourly-tab').addClass('active');
                $('#railway-tab').removeClass('active');
                $('#airport-tab').removeClass('active');
                $('#hourly').addClass('show active');
                $('#railway').removeClass('show active');
                $('#airport').removeClass('show active');
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
                } else {
                    Swal.fire("Please fill the above stop location first.");
                }
            } else {
                Swal.fire("Please fill the above stop location first.");
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

        //RAilway checkbox
        $('#railwayPick').on('change', function() {
            if ($(this).prop('checked')) {
                $('#railwayDrop').prop('checked', false);
                $('#railwayPick').prop('checked', true);
                $('.railway-input').hide();
                $('#railway-source').html('');
                $('#railway-destination').html('');
                $('.railway-input').html('');
                $('#railway-source').show();
                $('#railway-destination').show();
                appendPickupRailway()
                appendDropOffInRailway()
            } else {
                $('#railwayPick').prop('checked', false);
                $('#railwayDrop').prop('checked', true);
                $('.railway-input').hide();
                $('#railway-source').html('');
                $('#railway-destination').html('');
                $('#railway-source').show();
                $('#railway-destination').show();
                $('.railway-input').html('');
                appendDropOffRailway()
                appendPickupInRailway()
            }
        });

        $('#railwayDrop').on('change', function() {
            if ($(this).prop('checked')) {
                $('#railwayPick').prop('checked', false);
                $('#railwayDrop').prop('checked', true);
                $('.railway-input').hide();
                $('#railway-source').html('');
                $('#railway-destination').html('');
                $('.railway-input').html('');
                $('#railway-source').show();
                $('#railway-destination').show();
                appendDropOffRailway()
                appendPickupInRailway()
            } else {
                $('#railwayDrop').prop('checked', false);
                $('#railwayPick').prop('checked', true);
                $('.railway-input').hide();
                $('#railway-source').html('');
                $('#railway-destination').html('');
                $('#railway-source').show();
                $('#railway-destination').show();
                $('.railway-input').html('');
                appendPickupRailway()
                appendDropOffInRailway()
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

        function appendDropOffRailway() {
            $('#railway-destination').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Drop-off Railway station</label>
                    <input type="text" name="destination" id="dropoffRailway" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Drop-off Railway station</span>
                    </span>
                </div>
            `);
            railwaySearch('dropoffRailway');
        }

        function appendPickupRailway() {
            $('#railway-source').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Pick-up Railway station</label>
                    <input type="text" name="source" id="pickupRailway" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Pick-up Railway station</span>
                    </span>
                </div>
            `);
            railwaySearch('pickupRailway');
        }

        function appendPickupInRailway() {
            $('#railway-source').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Pick-up Location</label>
                    <input type="text" name="source" id="pickupLocationRailway" placeholder="" class="field__input" required>
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Pick-up Location</span>
                    </span>
                </div>
            `);
            locationSearch('pickupLocationRailway');
        }

        function appendDropOffInRailway() {
            $('#railway-destination').append(`
                <div class="field field_v3">
                    <label for="city" class="ha-screen-reader">Drop off Location</label>
                    <input type="text" name="destination" id="dropoffLocationRailway" placeholder="" class="field__input">
                    <span class="field__label-wrap" aria-hidden="true">
                        <span class="field__label">Drop off Location</span>
                    </span>
                </div>
            `);
            locationSearch('dropoffLocationRailway');
        }

        airportSearch('drops-airport');
        railwaySearch('drops-railway');

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

        function railwaySearch(inputId) {
            var options = {
                types: ['train_station'],
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
    });
</script>