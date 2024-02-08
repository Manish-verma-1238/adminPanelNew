@include('admin.common.header')
@include('admin.price.css')

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
                            <form id="priceForm" action="{{route('price.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4 col-12">
                                        <label>Cab & Taxi</label>
                                        <select class="form-control" name="car">
                                            <option>Select a cab</option>
                                            @if(isset($taxi) && count($taxi) > 0)
                                            @foreach($taxi as $cab)
                                            <option value="{{$cab['id'] ?? ''}}">{{ucwords($cab['name']) ?? ''}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Price Location type</label>
                                        <select class="form-control" name="trip">
                                            <option value="oneway" selected>Oneway</option>
                                            <option value="round-trip">Round Trip</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 col-12">
                                        <label>Trip type</label>
                                        <select class="form-control" name="location">
                                            @if(isset($location) && count($location) > 0)
                                            @foreach($location as $loc)
                                            <option value="{{$loc['id'] ?? ''}}">{{ucwords($loc['name']) ?? ''}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
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
                                <div class="more-price-range mb-2"></div>
                                <div class="col-12 d-flex justify-content-end">
                                    <a class="add-more"><i class="fa fa-plus"></i> Add more</a>
                                </div>
                                <div class="row text-center">
                                    <div class="col-sm-12 col-md-12">
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
@include('admin.assets.pricejs')