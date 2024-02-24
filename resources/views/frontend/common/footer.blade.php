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
<script src="{{asset('assets/frontend/assets/frontuser/js/intlTelInput.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>