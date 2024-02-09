<script>
    $(document).ready(function() {
        // Custom validator method for consecutive numbers
        $.validator.addMethod("consecutiveNumbers", function(value, element, params) {
            var isValid = true;
            $('.price').each(function() {
                var startingInput = $(this).find('.price-range-starting');
                var endingInput = $(this).find('.price-range-ending');
                var startingValue = parseInt(startingInput.val());
                var endingValue = parseInt(endingInput.val());
                if (endingValue < startingValue) {
                    isValid = false;
                    return false;
                }
                $('.price').not($(this)).each(function() {
                    var otherStartingValue = parseInt($(this).find('.price-range-starting').val());
                    var otherEndingValue = parseInt($(this).find('.price-range-ending').val());
                    if ((startingValue >= otherStartingValue && startingValue <= otherEndingValue) ||
                        (endingValue >= otherStartingValue && endingValue <= otherEndingValue) ||
                        (startingValue <= otherStartingValue && endingValue >= otherEndingValue)) {
                        isValid = false;
                        return false;
                    }
                });
            });
            return isValid;
        }, "Please enter valid consecutive numbers without overlapping ranges.");

        // Function to add new price range
        function addPriceRange() {
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

            $(".more-price-range").append(newDiv);
            addValidation(newDiv);
        }

        // Function to add validation to new price range inputs
        function addValidation(element) {
            element.find('.price-range-starting').rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Starting Price Range is required",
                    number: "Please enter a valid number"
                }
            });

            element.find('.price-range-ending').rules("add", {
                required: true,
                number: true,
                consecutiveNumbers: true,
                messages: {
                    required: "Ending Price Range is required",
                    number: "Please enter a valid number"
                }
            });

            element.find('.price-of-range').rules("add", {
                required: true,
                number: true,
                messages: {
                    required: "Price is required",
                    number: "Please enter a valid number"
                }
            });
        }

        // Click event for adding more price range
        $(".add-more").click(function() {
            addPriceRange();
        });

        // Remove price range when cross button is clicked
        $(document).on('click', '.cross-button', function() {
            var closestDivOrRow = $(this).closest('div, .row');
            console.log(closestDivOrRow);
            $(".deleted-items").append(closestDivOrRow);
            $(this).closest('.row').remove();
        });

        // Keyup event to hide errors
        $('#name, #priority').on('keyup', function() {
            $('.' + $(this).attr('id') + '-error').hide();
        });

        // Form validation
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
            },
            submitHandler: function(form) {
                // Form submission via AJAX
                $.ajax({
                    type: 'POST',
                    url: "{{route('price.save')}}",
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status == 'error') {
                            $('.error-msg').html('<div class="alert alert-danger alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span></button>' +
                                response.message + '</div>').show();
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
                        console.error(error);
                    }
                });
            }
        });

        // Add initial validation
        addValidation($('.price'));

    });
</script>