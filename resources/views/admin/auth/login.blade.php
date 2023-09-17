@include('admin.auth.common.header')

  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <h3 style="color:#6777ef;">Jimeet Blogs</h3>
            </div>

            @if (session('success'))
                <div class="alert alert-success success-messages">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <div class="card-body">
                <form method="POST" action="{{route('login')}}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')
                      <span class="error">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="{{route('forgotPassword')}}" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" value="{{ old('email') }}" required >
                    <div class="invalid-feedback">
                      Please fill in your password
                    </div>
                    @error('password')
                      <span class="error">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me"  {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">OR</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-12">
                    <a href="{{route('google.login.view')}}" class="btn btn-block btn-social btn-google text-center">
                      <span class="fab fa-google"></span> Google
                    </a>
                  </div>
                </div>

              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="{{route('registration')}}">Create One</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; Jimeet Blogs 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 @include('admin.auth.common.footer')