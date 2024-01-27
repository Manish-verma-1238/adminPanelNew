@include('admin.common.header')
<style>
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .toggle-slider {
        position: absolute;
        /* cursor: pointer; */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked+.toggle-slider {
        background-color: #2196F3;
    }

    input:checked+.toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-switch input {
        display: none;
    }
</style>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Cabs & Taxis</h1>
            <div class="section-header-button">
                <a href="{{route('taxis.create')}}" class="btn btn-primary">Add New</a>
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
                                <form action="{{route('taxis.index')}}" method="Get">
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
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Passengers</th>
                                        <th>Bags</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                    </tr>
                                    @if(isset($taxis) && count($taxis) > 0)
                                    @foreach($taxis as $key => $taxi)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$taxi->name}}<br>( {{$taxi->similar_cars}} )
                                            <div class="table-links">
                                                <a href="#">View</a>
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a class="text-danger" data-toggle="tooltip" title="Delete" data-confirm-yes="{{route('category.delete',[encrypt($taxi->id)])}}" data-confirm="Are You Sure?|Do you want to Delete '<b>{{$taxi->name}}</b>'?" style="cursor:pointer;">Delete</a>
                                            </div>
                                        </td>
                                        <td>
                                            <img alt="image" src="{{asset('/assets/admin/assets/img/upload/taxis/').'/'.$taxi->image}}" width="80" data-toggle="title" title="{{$taxi->name}}">
                                        </td>
                                        <td>{{$taxi->passengers}} Members</td>
                                        <td>{{$taxi->bags}}</td>
                                        <td>{{$taxi->price}} ₹ Per Km</td>
                                        <td>
                                            @if($taxi->status == 'show')
                                            <a data-confirm-yes="{{route('taxis.status', [encrypt($taxi->id), encrypt('hide')])}}" data-confirm="Are You Sure?|Want to hide cab to the user?">
                                                <label class="toggle-switch">
                                                    <input type="checkbox" checked>
                                                    <span class="toggle-slider"></span>
                                                </label>
                                            </a>
                                            @else
                                            <a data-confirm-yes="{{route('taxis.status', [encrypt($taxi->id), encrypt('show')])}}" data-confirm="Are You Sure?|Want to show cab to the user?">
                                                <label class="toggle-switch">
                                                    <input type="checkbox">
                                                    <span class="toggle-slider"></span>
                                                </label>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center">No record found</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            @if ($taxis->hasPages())
                            <div class="float-right">
                                <nav>
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($taxis->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $taxis->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @foreach ($taxis->getUrlRange(1, $taxis->lastPage()) as $page => $url)
                                        <li class="page-item {{ $taxis->currentPage() === $page ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($taxis->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $taxis->nextPageUrl() }}" aria-label="Next">
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