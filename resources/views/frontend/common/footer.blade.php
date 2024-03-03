<!-- footer -->
<section class="foot_sec">
    <div class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>Quick links</h3>
                        <ul>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                            <li><a href="javascript::void(0)">Our Packages</a></li>
                            <li><a href="javascript::void(0)">Hotels</a></li>
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
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="foot_box">
                        <h3>Address</h3>
                        <div class="site-link">
                            <ul>
                                <li><a href="tel:9888799313"><i class="fa fa-phone"></i>+91 98887 99313</a></li>
                                <li><a href="mailto:zipzaptaxichd@gmail.com"><i class="fa fa-envelope"></i>zipzaptaxichd@gmail.com</a></li>
                                <li><a href="javascript::void(0)"><i class="fa fa-home"></i>46, Krishna Enclave, Dhakoli, Zirakpur, Punjab 140603, India</a></li>
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
                    <p class="text-center">© 2024 ZipZap Taxi. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer -->

<!-- congratulations -->
<div class='modelboxcong'>
    <div class="modal fade" id="booking-success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> </div>
                <div class="card">
                    <!-- <div class="card-img">
                        <img class="img-fluid" src="uploads/about-img.png">
                    </div> -->
                    <div class="card-title">
                        <p>Cab Booked!</p>
                    </div>
                    <div class="card-text">
                        <p>Thankyou! For choosing ZipZap Taxi.</p>
                    </div>
                    <button class="btn">Your Booking ID: <span id="booking-id">ZIPZAP127584</span></button>
                    <div class="card-text text-center">
                        <small>An email has been sent to your registred email
                            address.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.9.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>