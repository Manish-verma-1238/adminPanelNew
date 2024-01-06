@include('admin.common.header')

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="{{route('blogs.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Create New Post</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('blogs.index')}}">Posts</a></div>
        <div class="breadcrumb-item">Create New Post</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Create New Post</h2>
      <p class="section-lead">
        On this page you can create a new post and fill in all fields.
      </p>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Write Your Post</h4>
            </div>
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric">
                    <option>Select the blog category.</option>
                    @foreach($category as $cat)
                    <option value="{{$cat->id}}">{{$cat->category_type}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                <div class="col-sm-12 col-md-7">
                  <textarea class="summernote-simple"></textarea>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                <div class="col-sm-12 col-md-7">
                  <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload" />
                  </div>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control inputtags">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric">
                    <option>Publish</option>
                    <option>Draft</option>
                    <option>Pending</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button class="btn btn-primary">Create Post</button>
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