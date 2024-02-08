<script>
    $(document).ready(function() {
        $.validator.addMethod("consecutiveNumbers", function(value, element, params) {
            var isValid = true;

            // Loop through each pair of starting and ending inputs
            $('.price').each(function() {
                var startingInput = $(this).find('.price-range-starting');
                var endingInput = $(this).find('.price-range-ending');
                var startingValue = parseInt(startingInput.val());
                var endingValue = parseInt(endingInput.val());

                // Check if ending value is less than starting value
                if (endingValue < startingValue) {
                    isValid = false;
                    return false; // Exit the loop early
                }

                // Check if there are overlapping ranges
                $('.price').not($(this)).each(function() {
                    var otherStartingValue = parseInt($(this).find('.price-range-starting').val());
                    var otherEndingValue = parseInt($(this).find('.price-range-ending').val());

                    if ((startingValue >= otherStartingValue && startingValue <= otherEndingValue) ||
                        (endingValue >= otherStartingValue && endingValue <= otherEndingValue) ||
                        (startingValue <= otherStartingValue && endingValue >= otherEndingValue)) {
                        isValid = false;
                        return false; // Exit the loop early
                    }
                });
            });

            return isValid;
        }, "Please enter valid consecutive numbers without overlapping ranges.");

        $(".add-more").click(function() {
            // Create a new div element with specified HTML content
            var currentDate = Date.now();
            var newDiv = $("<div class='row position-relative price'>" +
                "<div class='form-group col-md-3 col-12'>" +
                "<label>Starting Price range</label>" +
                "<input type='text' name='price[" + currentDate + "][range][from]' class='form-control price-range-starting' placeholder='Enter a range. Eg. 0-10'>" +
                "</div>" +
                "<div class='form-group col-md-3 col-12'>" +
                "<label>Ending Price range</label>" +
                "<input type='text' name='price[" + currentDate + "][range][to]' class='form-control price-range-ending' placeholder='Enter a range. Eg. 0-10'>" +
                "</div>" +
                "<div class='form-group col-md-6 col-12'>" +
                "<label>Price per Km</label>" +
                "<input type='text' name='price[" + currentDate + "][price]' class='form-control price-of-range' placeholder='Enter a price. Eg. 20'>" +
                "</div>" +
                "<a class='position-absolute cross-button' title='Remove'>X</a>" +
                "</div>");

            // Append the new div to the container with class "more-price-range"
            $(".more-price-range").append(newDiv);

            // Add validation rules to the newly added input fields
            newDiv.find('.price-range-starting').rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Starting Price Range is required",
                    number: "Please enter a valid number"
                }
            });

            newDiv.find('.price-range-ending').rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Ending Price Range is required",
                    number: "Please enter a valid number"
                }
            });

            newDiv.find('.price-of-range').rules("add", {
                required: true,
                number: true,
                messages: {
                    required: "Price is required",
                    number: "Please enter a valid number"
                }
            });
        });

        $('#name').on('keyup', function() {
            $('.name-error').hide();
        });

        $('#priority').on('keyup', function() {
            $('.priority-error').hide();
        });

        $(document).on('click', '.cross-button', function() {
            // Remove the parent div when cross button is clicked
            $(this).closest('.row').remove();
        });

        // Call the function to update hidden input fields
        updateHiddenInputs();

        $('#priceForm').validate({
            rules: {
                car: {
                    required: true
                },
                trip: {
                    required: true
                },
                price_name: {
                    required: true
                },
                priority: {
                    required: true,
                    number: true,
                }
            },
            messages: {
                car: {
                    required: "Please select a cab"
                },
                trip: {
                    required: "Please select a trip type"
                },
                price_name: {
                    required: "Please enter a name"
                },
                priority: {
                    required: "Please enter priority",
                    number: "Please enter a valid number"
                }
            }
        });

        // Adding validation for each element with the class .price-range-starting
        $(".price-range-starting").each(function() {
            $(this).rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Starting Price Range is required",
                    number: "Enter a valid number"
                }
            });
        });

        $(".price-range-ending").each(function() {
            $(this).rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Ending Price Range is required",
                    number: "Enter a valid number"
                }
            });
        });

        $(".price-of-range").each(function() {
            $(this).rules("add", {
                required: true,
                number: true,
                messages: {
                    required: "Price is required",
                    number: "Enter a valid number"
                }
            });
        });

        $(".selected-location").on('click', function() {
            var locationName = $(this).text();
            $('#selected-hidden-inputs input[value="' + locationName + '"]').remove();
            $(this).remove();
            $('.exists-error').hide();

            if ($("#selected-locations li").length < 1) {
                $(".selected-location-div").css({
                    "border": "1px solid red",
                    "border-radius": "5px",
                    "padding": "5px"
                });
                $(".error-selected-locations").css({
                    "display": "block"
                });
                $(".error-selected-locations").text("Locations are required");
            }
            // updateLocalStorage();
        });

    });

    function updateHiddenInputs() {
        $('#selected-hidden-inputs .selected-inputs').remove();
        var selectedLocations = $('#selected-locations .selected-location').map(function() {
            return $(this).text().trim(); // Return the text content of each <li> element
        }).get(); // Convert jQuery object to array

        selectedLocations.forEach(function(location) {
            $('#selected-hidden-inputs').append('<input type="hidden" class="selected-inputs" name="selectedLocations[]" value="' + location + '">');
        });
    }

    function initMap() {
        var options = {
            types: [],
            componentRestrictions: {
                country: 'in'
            }
        };

        const input = document.getElementById('location-input');
        const autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                if (!isLocationAlreadySelected(place.formatted_address)) {
                    addSelectedLocation(place.formatted_address);
                    input.value = ''; // Clear input after selection
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "'" + place.formatted_address + "' Location already selected.",
                    });
                }
            }
        });

        // Prevent form submission on Enter key press
        $('#location-input').on('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
            }
        });

        // Handle Enter key press to select the first suggestion
        $('#location-input').on('keyup', function(event) {
            if (event.key === 'Enter') {
                const suggestions = $('.pac-container .pac-item');
                if (suggestions.length > 0) {
                    const firstSuggestion = $(suggestions[0]);
                    firstSuggestion.trigger('click');
                }
            }
        });

        function isLocationAlreadySelected(locationName) {
            return $('.selected-location:contains("' + locationName + '")').length > 0;
        }

        // function addSelectedLocation(locationName) {
        //     const selectedLocationsList = $('#selected-locations');
        //     const listItem = $(' <li class = "selected-location"> ' + locationName + '</li>');

        //     listItem.on('click', function() {
        //         $('#selected-hidden-inputs input[value="' + locationName + '"]').remove();
        //         $(this).remove();
        //         $('.exists-error').hide();

        //         if ($("#selected-locations li").length < 1) {
        //             $(".selected-location-div").css({
        //                 "border": "1px solid red",
        //                 "border-radius": "5px",
        //                 "padding": "5px"
        //             });
        //             $(".error-selected-locations").css({
        //                 "display": "block"
        //             });
        //             $(".error-selected-locations").text("Locations are required");
        //         }
        //         updateLocalStorage();
        //     });

        //     $(".selected-location-div").css({
        //         "border": "none"
        //     });
        //     $(".error-selected-locations").css({
        //         "display": "none"
        //     });
        //     $(".error-selected-locations").text('');

        //     selectedLocationsList.append(listItem);
        //     updateHiddenInputs();
        //     updateLocalStorage();
        // }

        function addSelectedLocation(locationName) {
            const selectedLocationsList = $('#selected-locations');

            // Check if the location already exists in the list
            if (!isLocationAlreadySelected(locationName)) {
                const listItem = $('<li class="selected-location">' + locationName + '</li>');

                listItem.on('click', function() {
                    $('#selected-hidden-inputs input[value="' + locationName + '"]').remove();
                    $(this).remove();
                    $('.exists-error').hide();

                    if ($("#selected-locations li").length < 1) {
                        $(".selected-location-div").css({
                            "border": "1px solid red",
                            "border-radius": "5px",
                            "padding": "5px"
                        });
                        $(".error-selected-locations").css({
                            "display": "block"
                        });
                        $(".error-selected-locations").text("Locations are required");
                    }
                    updateLocalStorage();
                });

                $(".selected-location-div").css({
                    "border": "none"
                });
                $(".error-selected-locations").css({
                    "display": "none"
                });
                $(".error-selected-locations").text('');

                selectedLocationsList.append(listItem);
                updateHiddenInputs();
                updateLocalStorage();
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "'" + locationName + "' Location already selected.",
                });
            }
        }


        function isLocationAlreadySelected(locationName) {
            return $('.selected-location').filter(function() {
                return $(this).text().trim() === locationName;
            }).length > 0;
        }

        function updateLocalStorage() {
            const selectedItems = [];
            $('.selected-location').each(function(key, value) {
                const text = $(this).text().trim();
                if (!selectedItems.includes(text)) {
                    selectedItems.push(text);
                }
            });
            localStorage.setItem('selectedItems', JSON.stringify(selectedItems));
        }

        // Load selected items from localStorage on page load
        // function loadSelectedItems() {
        //     const selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
        //     console.log(selectedItems);
        //     selectedItems.forEach(function(item) {
        //         addSelectedLocation(item);
        //     });
        // }

        function loadSelectedItems() {
            const selectedItems = JSON.parse(localStorage.getItem('selectedItems')) || [];
            selectedItems.forEach(function(item) {
                // Check if item already exists in the UI
                if (!isLocationAlreadySelected(item)) {
                    addSelectedLocation(item);
                }
            });
        }

        // Call the function to load selected items from localStorage
        loadSelectedItems();

        // function clearLocalStorage() {
        //     localStorage.removeItem('selectedItems');
        // }
    }
</script>