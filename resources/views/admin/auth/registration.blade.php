@include('admin.auth.common.header')

<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
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
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="{{route('register')}}" class="needs-validation" novalidate="">
                   @csrf
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="frist_name">Full Name</label>
                      <input id="frist_name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                      <div class="invalid-feedback">
                        Please fill your name
                      </div>
                      @error('name')
                        <span class="error">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                    @error('email')
                      <span class="error">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" value="{{ old('password') }}" data-indicator="pwindicator" name="password" required>
                      <div class="invalid-feedback">
                        Please fill your password
                      </div>
                      @error('password')
                        <span class="error">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                      <div class="invalid-feedback">
                        Please confirm your password
                      </div>
                      @error('password_confirmation')
                          <span class="error">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">I agree with the <a href="#terms&conditions">Terms and conditions</a></label>
                      <div class="invalid-feedback">
                        Please read the terms & conditions
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Do you have an account? <a href="{{route('view.login')}}">Login Here.</a>
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
