@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="{{route('category.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            @if(isset($id) && !empty($id))
            <h1>Edit Category</h1>
            @else
            <h1>Create New Category</h1>
            @endif
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></div>
              @if(isset($id) && !empty($id))
              <div class="breadcrumb-item">Edit Category</div>
              @else
              <div class="breadcrumb-item">Create New Category</div>
              @endif
            </div>
          </div>

          <div class="section-body">
            @if(isset($id) && !empty($id))
            <h2 class="section-title">EditCategory</h2>
            <p class="section-lead">
              On this page you can edit Category and fill in all fields.
            </p>
            @else
            <h2 class="section-title">Create New Category</h2>
            <p class="section-lead">
              On this page you can create a new Category and fill in all fields.
            </p>
            @endif

            @include('admin.common.message')

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>@if(isset($id) && !empty($id)) Edit @else Write @endif Your Category</h4>
                  </div>
                  <form id="categoryId" action="{{route('category.save')}}" method="POST">
                    @csrf
                    <div class="card-body">
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                          @if(isset($id) && !empty($id))
                          <input type="hidden" value="{{encrypt($id)}}" name="url_string"></input>
                          @endif
                          <input type="text" class="form-control" name="title" value="@if(isset($data) && !empty($data)){{$data->category_type}}@else{{old('title')}}@endif" required>
                          @error('title')
                            <span class="error">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button class="btn btn-primary" type="submit">@if(isset($id) && !empty($id)) Update @else Create @endif Category</button>
                          <a href="{{route('category.index')}}" class="btn btn-danger">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

@include('admin.common.footer')
@include('admin.assets.categoryjs')