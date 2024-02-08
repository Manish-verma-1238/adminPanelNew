@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Cabs & Taxis</h1>
            <div class="section-header-button">
                <a href="{{route('price.add')}}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item">All Cabs & Taxis</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Cabs & Taxis</h2>
            <p class="section-lead">
                You can manage all Cabs & Taxis, such as editing, deleting and more.
            </p>
            @include('admin.common.message')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <form action="{{route('price.index')}}" method="Get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search" value="{{$search}}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Cab (With location type)</th>
                                        <th>Trip</th>
                                        <th>Price View</th>
                                        <th>Actions</th>
                                    </tr>
                                    @if(isset($locations) && count($locations) > 0)
                                    @foreach($locations as $key => $location)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$location->name}} ( {{$location->location_name}} )</td>
                                        <td>{{ucwords($location->trip)}}</td>
                                        <td><a href="#viewCabDetails">View all</a></td>
                                        <td><a href="">View all</a></td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">No record found</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @if (isset($locations) && $locations->hasPages())
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($locations->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $locations->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @foreach ($locations->getUrlRange(1, $locations->lastPage()) as $page => $url)
                                        <li class="page-item {{ $locations->currentPage() === $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($locations->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $locations->nextPageUrl() }}" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                        @else
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                                <span class="sr-only">Next</span>
                                            </span>
                                        </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.common.footer')