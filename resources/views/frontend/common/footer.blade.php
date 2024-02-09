<!-- footer -->
<section class="foot_sec">
    <div class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>About Taxi</h3>
                        <ul>
                            <li><a href="about-us.html"> About Us </a> </li>
                            <li><a href="contact-us.html">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>Terms of Uses </h3>
                        <ul>
                            <li><a href="privacy-policy.html">Privacy
                                    Policy</a>
                            </li>
                            <li><a href="terms-conditions.html">Terms &
                                    Conditions</a></li>
                            <li><a href="refund-policy.html">Refund &
                                    Cancellation
                                    Policy</a></li>
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
                                <li>
                                    <a href="#"> <i class="fa fa-phone"></i>123456789 </a>
                                </li>
                                <li>
                                    <a href="#"> <i class="fa fa-envelope"></i>dummy@zizpap.in</a>
                                </li>
                                <li>
                                    <a href="#"> <i class="fa fa-home"></i>address </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-social-icons">
                            <ul class="social-icons">
                                <li>
                                    <a target="_blank" href="https:#" class="social-icon"> <i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="#" class="social-icon"> <i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="#" class="social-icon"> <i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="#" class="social-icon"> <i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="#" class="social-icon"> <i class="fa fa-youtube"></i></a>
                                </li>
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
                    <p class="text-center"> © 2021 </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer -->

<script type="text/javascript">
    $(function() {
        var localcity = {
            "data": 0
        };
        $(".localcity").autocomplete({
            source: localcity,
            messages: {
                noResults: '',
                results: function() {}
            },
            select: function(e, ui) {
                e.preventDefault()

                $(".localcity").val(ui.item.label);
                return false;
            },
            focus: function(e, ui) {
                e.preventDefault();
                return false;
            },
            autoFocus: true,
            minLength: 0,
            delay: 0,
        });
    });



    $(function() {
        var transcity = {
            "data": 0
        };
        $(".transcity").autocomplete({
            source: transcity,
            messages: {
                noResults: '',
                results: function() {}
            },
            select: function(e, ui) {
                e.preventDefault()

                $(".transcity").val(ui.item.label);
                return false;
            },
            focus: function(e, ui) {
                e.preventDefault();
                return false;
            },
            autoFocus: true,
            minLength: 0,
            delay: 0,
        });
    });

    function initAutocomplete() {
        $("input[id*='location']").each(function() {
            autocomplete = new google.maps.places.Autocomplete((this));
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcTmELSehXo7fqusqkvu4FKYtkQM_5--8&amp;libraries=places&loading=async&amp;callback=initAutocomplete"></script>

<script src="{{asset('assets/frontend/assets/cdnjs.cloudflare.com/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/maxcdn.bootstrapcdn.com/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/owl.carousel.min2.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/wow.js')}}"></script>

<script src="{{asset('assets/frontend/assets/frontuser/js/jquery.datetimepicker.full.js')}}"></script>

<script async defer src="{{asset('assets/frontend/assets/frontuser/js/validation.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/custom.js')}}"></script>
<!-- <script src="{{asset('assets/frontend/assets/frontuser/js/datevalidation.js')}}"></script> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('not-found-error'))
<script>
    Swal.fire({
        icon: "error",
        // iconHtml: '<img src="{{asset('assets/frontend/uploads/logo nav.png')}}" style="width: 50px;">',
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

</html>