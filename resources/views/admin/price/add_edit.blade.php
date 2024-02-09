@include('admin.common.header')
@include('admin.price.css')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('price.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>@if(isset($cabWithLocation) && !empty($cabWithLocation))Edit Cab Price @else Add Cab Price @endif</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('price.index')}}">Cabs & Taxis</a></div>
                <div class="breadcrumb-item">@if(isset($cabWithLocation) && !empty($cabWithLocation))Edit Cab Price @else Add Cab Price @endif</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">@if(isset($cabWithLocation) && !empty($cabWithLocation))Edit Cab Price @else Add Cab Price @endif</h2>
            <p class="section-lead">
                @if(isset($cabWithLocation) && !empty($cabWithLocation))
                On this page you can edit cab price and fill in all fields.
                @else
                On this page you can add a new cab price and fill in all fields.
                @endif
            </p>
            @include('admin.common.message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@if(isset($cabWithLocation) && !empty($cabWithLocation)) Edit Cab Price @else Add Cab Price @endif</h4>
                        </div>
                        <div class="card-body">
                            <form id="priceForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>Cab & Taxi</label>
                                        <select class="form-control" name="car">
                                            <option value="">Select a cab</option>
                                            @if(isset($taxi) && count($taxi) > 0)
                                            @foreach($taxi as $cab)
                                            <option value="{{ isset($cab['id']) ? $cab['id'] : '' }}" {{ (isset($cabWithLocation) && !empty($cabWithLocation) && $cabWithLocation->car_id == $cab['id']) ? 'selected' : '' }}>
                                                {{ isset($cab['name']) ? ucwords($cab['name']) : '' }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Price Location type</label>
                                        <select class="form-control" name="trip">
                                            <option value="oneway" {{ (isset($cabWithLocation) && !empty($cabWithLocation) && $cabWithLocation->trip == 'oneway') ? 'selected' : 'selected' }}>Oneway</option>
                                            <option value="round-trip" {{ (isset($cabWithLocation) && !empty($cabWithLocation) && $cabWithLocation->trip == 'round-trip') ? 'selected' : '' }}>Round Trip</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Trip type</label>
                                        <select class="form-control" name="location">
                                            @if(isset($location) && count($location) > 0)
                                            @foreach($location as $loc)
                                            <option value="{{$loc['id'] ?? ''}}" {{ (isset($cabWithLocation) && !empty($cabWithLocation) && $cabWithLocation->location_id == $loc['id']) ? 'selected' : '' }}>{{ucwords($loc['name']) ?? ''}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                @if(isset($priceWithRange) && !empty($priceWithRange))
                                @foreach($priceWithRange as $key => $priceRange)
                                @php
                                $range = explode("-", $priceRange->range); 
                                @endphp
                                <div class="row  @if ($key > 0)position-relative @endif price">
                                    <div class="form-group col-md-3 col-12">
                                        <label>Starting Price range</label>
                                        <input type="text" name="price[{{$key+1}}][range][from]" class="form-control price-range-starting" value="{{$range[0] ?? ''}}" placeholder="Enter a range from. Eg. 0" required>
                                    </div>
                                    <div class="form-group col-md-3 col-12">
                                        <label>Ending Price range</label>
                                        <input type="text" name="price[{{$key+1}}][range][to]" class="form-control price-range-ending" value="{{$range[1] ?? ''}}" placeholder="Enter a range to. Eg. 10" required>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Price per Km</label>
                                        <input type="text" name="price[{{$key+1}}][price]" class="form-control price-of-range" value="{{$priceRange->price ?? ''}}" placeholder="Enter a price. Eg. 20" required>
                                    </div>
                                    @if ($key > 0)
                                    <a class='position-absolute cross-button' title='Remove'>X</a>
                                    @endif
                                </div>
                                @endforeach
                                <input type="hidden" name="string" value="{{ (isset($cabWithLocation) && !empty($cabWithLocation) && $cabWithLocation->car_id) }}">
                                @else
                                <div class="row price">
                                    <div class="form-group col-md-3 col-12">
                                        <label>Starting Price range</label>
                                        <input type="text" name="price[0][range][from]" class="form-control price-range-starting" value="" placeholder="Enter a range from. Eg. 0" required>
                                    </div>
                                    <div class="form-group col-md-3 col-12">
                                        <label>Ending Price range</label>
                                        <input type="text" name="price[0][range][to]" class="form-control price-range-ending" value="" placeholder="Enter a range to. Eg. 10" required>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Price per Km</label>
                                        <input type="text" name="price[0][price]" class="form-control price-of-range" placeholder="Enter a price. Eg. 20" required>
                                    </div>
                                </div>
                                @endif
                                <div class="more-price-range mb-2"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a class="add-more"><i class="fa fa-plus"></i> Add more</a>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-12">
                                        <button class="btn btn-primary">@if(isset($cabWithLocation) && !empty($cabWithLocation)) Edit @else Add @endif</button>
                                        <a href="{{route('price.index')}}" class="btn btn-danger">Cancel</a>
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
@include('admin.assets.cabPricejs')