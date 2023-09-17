<!-- General JS Scripts -->
<script src="{{asset('assets/admin/assets/modules/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/popper.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/tooltip.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/moment.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/js/stisla.js')}}"></script>
  
<!-- JS Libraies -->

<!-- Page Specific JS File -->
  
<!-- Template JS File -->
<script src="{{asset('assets/admin/assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/admin/assets/js/custom.js')}}"></script>
<script>
  $(document).ready(function() {
      setTimeout(function() {
        $(".success-messages ").fadeOut();
      }, 5000); // 5000 milliseconds = 5 seconds
  });
</script>

</body>
</html>