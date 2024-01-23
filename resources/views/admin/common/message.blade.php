@if (session('success'))
<div class="alert alert-success success-messages">
    {{ session('success') }}
</div>
@elseif (session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif