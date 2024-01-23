<!-- JS Libraies -->

<script src="{{asset('assets/admin/assets/modules/summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/jquery-selectric/jquery.selectric.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
<script src="{{asset('assets/admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>

<script>
    "use strict";

    $("select").selectric();
    $.uploadPreview({
        input_field: "#image-upload", // Default: .image-upload
        preview_box: "#image-preview", // Default: .image-preview
        label_field: "#image-label", // Default: .image-label
        label_default: "Choose File", // Default: Choose File
        label_selected: "Change File", // Default: Change File
        no_label: false, // Default: false
        success_callback: null // Default: null
    });
    $(".inputtags").tagsinput('items');
</script>