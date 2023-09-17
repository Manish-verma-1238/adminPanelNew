<script>
    $(document).ready(function () {
        $("#categoryId").validate({
            rules: {
                title: {
                required: true,
                }
            },
            messages: {
                title: {
                required: "Please enter category title.",
                }
            }
        });
    });
</script>