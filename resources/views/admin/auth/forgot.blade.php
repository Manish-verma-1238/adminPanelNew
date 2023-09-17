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
              <div class="card-header"><h4>Forgot Password</h4></div>

              <div class="card-body">
                <p class="text-muted">We will send a link to reset your password</p>
                <form method="POST" action="{{route('forgot')}}" class="needs-validation" novalidate="">
                    @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please enter your email
                    </div>
                    @error('email')
                      <span class="error">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Forgot Password
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
