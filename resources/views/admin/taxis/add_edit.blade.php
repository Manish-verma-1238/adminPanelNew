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
            <h1>@if(isset($taxi) && !empty($taxi)) Edit Cab @else Add New Cab @endif</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('taxis.index')}}">Cabs & Taxis</a></div>
                <div class="breadcrumb-item">@if(isset($taxi) && !empty($taxi)) Edit Cab @else Add New Cab @endif</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">@if(isset($taxi) && !empty($taxi)) Edit Cab @else Add New Cab @endif</h2>
            <p class="section-lead">
                @if(isset($taxi) && !empty($taxi))
                On this page you can edit cab and fill in all fields.
                @else
                On this page you can add a new cab and fill in all fields.
                @endif
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@if(isset($taxi) && !empty($taxi)) Edit Cab & Taxi @else Add Cab & Taxi @endif</h4>
                        </div>
                        <div class="card-body">
                            <form id="taxiForm" action="{{route('taxis.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control" value="{{$taxi->name ?? ''}}">
                                        @error('name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Similar cars</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="similar_cars" class="form-control" value="{{$taxi->similar_cars ?? ''}}">
                                        @error('similar_cars')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Passengers</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="passengers" class="form-control" value="{{$taxi->passengers ?? ''}}">
                                        @error('passengers')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bags</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="bags" class="form-control" value="{{$taxi->bags ?? ''}}">
                                        @error('bags')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price per kilometer</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="price" class="form-control" value="{{$taxi->price ?? ''}}">
                                        @error('price')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if(isset($taxi->image))
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Uploaded Image</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div>
                                            <img alt="image" src="{{asset('/assets/admin/assets/img/upload/taxis/').'/'.$taxi->image}}" width="250" data-toggle="title" title="{{$taxi->name}}">
                                        </div>
                                    </div>
                                </div>
                                @endif
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
                                        <textarea class="summernote-simple" name="about">{!!$taxi->other_details ?? ''!!}</textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{(isset($taxi) && !empty($taxi)) ? encrypt($taxi->id) : ''}}" />
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary">@if(isset($taxi) && !empty($taxi)) Edit @else Add @endif</button>
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