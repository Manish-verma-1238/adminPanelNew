@if (session('success'))
    <div class="alert alert-success success-messages">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif