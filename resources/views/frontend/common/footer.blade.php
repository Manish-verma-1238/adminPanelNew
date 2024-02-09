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
                            <!-- <li><a href="driver.html">Driver</a></li> -->
                            <!-- <li><a href="https://www.zipzap.in/sitemap.xml"
                                                                                target="_blank">Sitemap</a></li> -->

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
                                    <a href="#"> <i class="fa fa-phone"></i>
                                        123456789 </a>
                                </li>
                                <li>
                                    <a href="#"> <i class="fa fa-envelope"></i>
                                        dummy@zizpap.in</a>
                                </li>
                                <li>

                                    <a href="#"> <i class="fa fa-home"></i>
                                        address </a>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIpgqinOun7JOpmVn2QbZ9jPfU-WGRgos&amp;libraries=places&amp;callback=initAutocomplete"></script>



<script src="{{asset('assets/frontend/assets/cdnjs.cloudflare.com/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/maxcdn.bootstrapcdn.com/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/owl.carousel.min2.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/wow.js')}}"></script>



<script src="{{asset('assets/frontend/assets/frontuser/js/jquery.datetimepicker.full.js')}}"></script>

<script async defer src="{{asset('assets/frontend/assets/frontuser/js/validation.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/custom.js')}}"></script>
<script src="{{asset('assets/frontend/assets/frontuser/js/datevalidation.js')}}"></script>


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