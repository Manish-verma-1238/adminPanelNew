@include('admin.common.header')
@include('admin.price.css')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('location.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>@if(isset($location) && !empty($location)) Edit Location @else Add New Locations @endif</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('taxis.index')}}">Locations</a></div>
                <div class="breadcrumb-item">@if(isset($location) && !empty($location)) Edit Location @else Add New Location @endif</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">@if(isset($location) && !empty($location)) Edit Location @else Add New Locations @endif</h2>
            <p class="section-lead">
                @if(isset($location) && !empty($location))
                On this page you can edit location and fill in all fields.
                @else
                On this page you can add a new locations and fill in all fields.
                @endif
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@if(isset($location) && !empty($location)) Edit Location & Taxi @else Add Locations @endif</h4>
                        </div>
                        <div class="card-body">
                            <form id="priceForm" action="{{route('location.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>Price type Name</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ $location->name ?? old('name') }}" placeholder="Enter a name Eg. Plane" required>
                                        @error('name')
                                        <span class="error name-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Search cities & locations</label>
                                        <input type="text" id="location-input" class="form-control search-input">
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Give priority for rate calculation</label>
                                        <input type="tel" id="priority" name="priority" class="form-control" value="{{ $location->priority ?? old('priority') }}" placeholder="Enter a priority. Eg. 4" required>
                                        @error('priority')
                                        <span class="error priority-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="selected-location-div">
                                            <label>Selected locations</label>
                                            <ul id="selected-locations" class="selected-locations">
                                                @if(isset($location) && !empty($location) && $location->details->isNotEmpty())
                                                @foreach($location->details as $detail)
                                                <li class="selected-location">{{$detail->name}}</li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            <div id="selected-hidden-inputs">

                                            </div>
                                        </div>
                                        <label class="error error-selected-locations"></label>
                                        @if(Session::has('location_exists_error'))
                                        <span class="error exists-error">{{ Session::get('location_exists_error') }}</span>
                                        @endif
                                    </div>
                                    @if(isset($location) && !empty($location))
                                    <input type="hidden" name="id" class="form-control" value="{{ encrypt($location->id) ?? '' }}">
                                    @endif
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-12">
                                        <button class="btn btn-primary">@if(isset($location) && !empty($location)) Edit @else Add @endif</button>
                                        <a href="{{route('location.index')}}" class="btn btn-danger">Cancel</a>
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
@include('admin.assets.pricejs')