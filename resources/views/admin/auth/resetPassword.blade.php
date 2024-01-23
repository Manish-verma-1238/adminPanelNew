@include('admin.auth.common.header')

<div id="app">
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="login-brand">
            <h3 style="color:#6777ef;">{{ucwords($userProfile['panel_name']) ?? 'Admin Panel'}}</h3>
          </div>

          @if (session('success'))
          <div class="alert alert-success success-messages">
            {{ session('success') }}
          </div>
          @elseif (session('error'))
          <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          <div class="card card-primary">
            <div class="card-header">
              <h4>Reset Password</h4>
            </div>

            <div class="card-body">
              <form method="POST" action="{{route('reset')}}" class="needs-validation" novalidate="">
                @csrf
                <input type="hidden" name="id" value="{{$id}}">
                <div class="form-group">
                  <label for="password">New Password</label>
                  <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" value="{{ old('password') }}" required>
                  <div class="invalid-feedback">
                    Please fill your password
                  </div>
                  @error('password')
                  <span class="error">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="password-confirm">Confirm Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" tabindex="2" required>
                  <div class="invalid-feedback">
                    Please fill your confirm-password
                  </div>
                  @error('password_confirmation')
                  <span class="error">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Reset Password
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="mt-5 text-muted text-center">
            Do you have an account? <a href="{{route('view.login')}}">Login Here.</a>
          </div>
          <div class="simple-footer">
            Copyright &copy; {{ucwords($userProfile['panel_name']) ?? 'Admin Panel'}}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('admin.auth.common.footer')