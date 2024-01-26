@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Cabs & Taxis</h1>
            <div class="section-header-button">
                <a href="{{route('blogs.create')}}" class="btn btn-primary">Add New</a>
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

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                                    <tr>
                                        <td>1.</td>
                                        <td>Laravel 5 Introduction Laravel 5 Tutorial: Introduction
                                            <div class="table-links">
                                                <a href="#">View</a>
                                                <div class="bullet"></div>
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#" class="text-danger">Trash</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#">Web Developer</a>,
                                            <a href="#">Tutorial</a>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                                                <div class="d-inline-block ml-1">Rizal Fakhri</div>
                                            </a>
                                        </td>
                                        <td>2018-01-20</td>
                                        <td>
                                            <div class="badge badge-primary">Published</div>
                                        </td>
                                        <td> Show </td>
                                    </tr>
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