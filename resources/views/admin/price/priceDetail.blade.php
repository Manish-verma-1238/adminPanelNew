@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{route('price.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detailed Price</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{route('price.index')}}">Cab Prices</a></div>
                <div class="breadcrumb-item">Detailed Price</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{$cabWithLocation->car_name ?? ''}} ({{$cabWithLocation->location_name ?? ''}}), {{$cabWithLocation->trip ?? ''}}</h2>
            <p class="section-lead">
                You can see detailed price of particular cab in particular area.
            </p>
            @include('admin.common.message')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Range</th>
                                        <th>Price (Per Km)</th>
                                    </tr>
                                    @if(isset($priceWithRange) && count($priceWithRange) > 0)
                                    @foreach($priceWithRange as $key => $price)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$price->range}}</th>
                                        <th>{{$price->price ?? ''}} Rs</th>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-center">No record found</td>
                                    </tr>
                                    @endif
                                </table>
                                <div class="text-center">
                                    <a href="{{route('price.index')}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('price.index')}}" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.common.footer')