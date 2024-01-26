    <div>
      <footer class="main-footer">
        <div class="footer-left">
          <!-- Get user profile from the appServiceProvider -->
          Copyright &copy; {{ucwords($userProfile['panel_name']) ?? 'Admin Panel'}}
        </div>
      </footer>
    </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('assets/admin/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/admin/assets/modules/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/chart.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/admin/assets/js/page/index.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/admin/assets/js/custom.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
      $(document).ready(function() {
        // This is used to hide the success message
        setTimeout(function() {
          $(".success-messages ").fadeOut();
        }, 5000); // 5000 milliseconds = 5 seconds
      });
    </script>
    </body>

    </html>