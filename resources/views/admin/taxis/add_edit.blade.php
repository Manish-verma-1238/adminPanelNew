@include('admin.common.header')

<style>
    .error-input {
        border: 1px solid red;
    }
</style>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('taxis.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Add New Cab</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('taxis.index')}}">Cabs & Taxis</a></div>
                <div class="breadcrumb-item">Add New Cab</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Add New Cab</h2>
            <p class="section-lead">
                On this page you can add a new cab and fill in all fields.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Cab & Taxi</h4>
                        </div>
                        <div class="card-body">
                            <form id="taxiForm" action="{{route('taxis.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control">
                                        @error('name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Similar cars</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="similar_cars" class="form-control">
                                        @error('similar_cars')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Passengers</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="passengers" class="form-control">
                                        @error('passengers')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bags</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="bags" class="form-control">
                                        @error('bags')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price per kilometer</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="price" class="form-control">
                                        @error('price')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Cab Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <!-- <span class="error mb-2"><b>Note:</b> Prefer to upload png image of good quality.</span> -->
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="image" id="image-upload" />
                                        </div>
                                        @error('image')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Other details about Cab</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="summernote-simple" name="about"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">Add</button>
                                        <a href="{{route('taxis.index')}}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.common.footer')
@include('admin.assets.userProfileJs')
@include('admin.assets.taxijs')