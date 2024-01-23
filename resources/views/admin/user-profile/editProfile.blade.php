@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, {{ucwords($user->name) ?? 'User'}}</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>
            @include('admin.common.message')
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{asset('/assets/admin/assets/img/upload/user-profile/').'/'.$user->userProfile->panel_logo ?? asset('/assets/admin/assets/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">{{$user->name ?? 'User'}}
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> {{$user->userProfile->panel_name ?? 'Admin Panel'}}
                                </div>
                            </div>
                            {!! $user->userProfile->about ?? 'About Admin Panel' !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form method="post" action="{{route('save.user.profile')}}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->name}}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the name
                                        </div>
                                        @error('name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Brand Name</label>
                                        <input type="text" name="brand-name" class="form-control" value="{{$user->userProfile->panel_name ?? 'Admin Panel'}}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the brand name
                                        </div>
                                        @error('brand-name')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="tel" name="phone" class="form-control" value="{{$user->userProfile->phone ?? '9988776655'}}" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the contact number
                                        </div>
                                        @error('phone')
                                        <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-5 col-12">
                                        <label>Brand logo</label>
                                        <div class="col-sm-12 col-md-7">
                                            <div id="image-preview" class="image-preview">
                                                <label for="image-upload" id="image-label">Choose File</label>
                                                <input type="file" name="brand-logo" id="image-upload" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>About</label>
                                        <textarea class="form-control summernote-simple" name="about">{!! $user->userProfile->about ?? 'About Admin Panel' !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.common.footer')
@include('admin.assets.userProfileJs')