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

        $("#priceForm").submit(function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            // Get the form data
            var formData = $(this).serialize();

            // Send an AJAX request
            $.ajax({
                type: 'POST',
                url: "{{route('price.save')}}",
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    if (response.status == 'error') {
                        $('.error-msg').html('<div class="alert alert-danger alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button>' +
                            response.message + '</div>');
                        $('.error-msg').show();
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                    } else if (response.status == 'success') {
                        window.location.href = response.url;
                    } else {
                        $('.error-msg').hide();
                        $('.success-messages').hide();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                }
            });
        });

    });
</script>