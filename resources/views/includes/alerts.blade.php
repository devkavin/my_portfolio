@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-3">
        {{ session('error') }}
    </div>
@elseif (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3">
        {{ session('success') }}
    </div>
@endif
