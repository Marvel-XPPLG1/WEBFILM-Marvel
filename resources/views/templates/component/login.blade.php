@guest
<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        Sign In & Sign Up
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <section>
        <div class="modal-body">
          <div class="w3_login_module">
            <div class="module form-module">
              <div class="toggle"><i class="fa fa-times fa-pencil"></i>
              <div class="tooltip">Click Me</div>
              </div>
              <div class="form">
              <h3>Login to your account</h3>
              @if ($errors->any() && old('_form') === 'login')
                <div class="alert alert-danger" style="padding:8px;">{{ $errors->first() }}</div>
              @endif
              <form action="{{ route('login.post') }}" method="post">
                @csrf
                <input type="hidden" name="_form" value="login">
                <input type="email" name="email" placeholder="Email" value="{{ old('_form') === 'login' ? old('email') : '' }}" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="submit" value="Login">
              </form>
              </div>
              <div class="form">
              <h3>Create an account</h3>
              @if ($errors->any() && old('_form') === 'register')
                <div class="alert alert-danger" style="padding:8px;">
                  @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                  @endforeach
                </div>
              @endif
              <form action="{{ route('register.post') }}" method="post">
                @csrf
                <input type="hidden" name="_form" value="register">
                <input type="text" name="name" placeholder="Nama" value="{{ old('_form') === 'register' ? old('name') : '' }}" required="">
                <input type="email" name="email" placeholder="Email Address" value="{{ old('_form') === 'register' ? old('email') : '' }}" required="">
                <input type="password" name="password" placeholder="Password" required="">
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required="">
                <input type="submit" value="Register">
              </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script>
  $('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms
    $('.form').animate({
    height: "toggle",
    'padding-top': 'toggle',
    'padding-bottom': 'toggle',
    opacity: "toggle"
    }, "slow");
  });
</script>
@if ($errors->any() && old('_form'))
<script>
  $(window).on('load', function () {
    $('#myModal').modal('show');
    @if (old('_form') === 'register')
      $('.toggle').trigger('click');
    @endif
  });
</script>
@endif
@endguest
