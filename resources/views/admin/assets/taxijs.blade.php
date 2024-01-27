<script>
    $(document).ready(function() {
        var validationRules = {
            name: {
                    required: true,
                },
                similar_cars: {
                    required: true,
                },
                passengers: {
                    required: true,
                    digits: true,
                    range: [1, 99]
                },
                bags: {
                    required: true,
                    digits: true,
                    range: [1, 99]
                },
                price: {
                    required: true,
                    number: true,
                },
                about: {
                    required: true,
                },
        };
        @if (!isset($taxi->image) || $taxi->image === null)
            validationRules.image = {
                required: true,
                extension: "jpg|jpeg|png|gif",
                filesize: 2048000 // 2048000 bytes = 2 MB
            };
        @endif
        $('#taxiForm').validate({
            rules: validationRules,
            messages: {
                name:{
                    required: "Please enter the cab type name. (Eg. Sedan, Crista)",
                },
                similar_cars: {
                    required: "Please enter related cabs.",
                },
                passengers: {
                    required: "Please enter number of seats available in cab.",
                    range: "Please enter a number of max 2 digits. (Eg 4 or 24)"
                },
                bags: {
                    required: "Please enter number of bags allowed in cab",
                    range: "Please enter a number of max 2 digits. (Eg 4 or 12)"
                },
                price: {    
                    required: "Please enter the price per kilometer of cab."
                },
                image: {
                    required: "Please select an image file.",
                    extension: "Please upload a valid image file (jpg, jpeg, png, gif).",
                    filesize: "File size must be less than 2 MB."
                },
            },
            errorPlacement: function(error, element) {
                // Custom error placement for the image input
                if (element.attr("name") === "image") {
                    error.appendTo(element.closest(".form-group").find(".col-md-7"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                // Highlight the input field with a red border on error
                $(element).addClass('error-input');
            },
            unhighlight: function(element, errorClass, validClass) {
                // Remove the red border on success
                $(element).removeClass('error-input');
            }
        });
    });
</script>