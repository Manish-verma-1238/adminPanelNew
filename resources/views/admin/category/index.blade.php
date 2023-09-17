@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-button">
              <a href="{{route('category.create')}}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
              <div class="breadcrumb-item">All Category</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Category</h2>
            <p class="section-lead">
              You can manage all category, such as editing, deleting and more.
            </p>

            @include('admin.common.message')

            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Category</h4>
                  </div>
                  <div class="card-body">
                    <div class="float-right">
                      <form action="{{route('category.index')}}" method="Get"> 
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
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @if(count($results) > 0)
                        @foreach($results as $key => $result)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucwords($result->category_type) }}</td>
                            <td>{{ $result->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit" href="{{route('category.create',[encrypt($result->id)])}}"><i class="fas fa-pencil-alt"></i></a>
                                <a class="btn btn-danger btn-action delete-btn" data-toggle="tooltip" title="Delete" data-confirm-yes="{{route('category.delete',[encrypt($result->id)])}}" data-confirm="Are You Sure?|This action cannot be undone. Do you want to continue?"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No record found</td>
                        </tr>
                        @endif
                      </table>
                    </div>
                    @if ($results->hasPages())
                    <div class="float-right">
                        <nav>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($results->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $results->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @endif

                                {{-- Page Number Links --}}
                                @foreach ($results->getUrlRange(1, $results->lastPage()) as $page => $url)
                                <li class="page-item {{ $results->currentPage() === $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($results->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $results->nextPageUrl() }}" aria-label="Next">
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
@include('admin.assets.categoryjs')