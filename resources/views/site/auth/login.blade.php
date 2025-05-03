@extends('site.authLayouts.authApp')
@section('title', __('Login'))

@section('content')

    <main>

        <div class="login-page">
            <div class="loginform">

                <x-auth-logo></x-auth-logo>


                <form action="{{ route('site.login') }}" method="post" id="login_form">
                    @csrf
                    <div class="frm-head"> {{ __('login') }} </div>

                    <div class="input-frm">
                        <label for="email"> {{ __('email') }} </label>
                        <input type="email" placeholder="{{ __('email') }}" id="email" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <span class="email-error error-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-frm">
                        <label for="password"> {{ __('password') }} </label>
                        <input type="password" class="frm-pass-text" placeholder="{{ __('password') }}" id="password"
                            name="password" value="">
                        <div class="icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                        @error('password')
                            <span class="password-error error-text text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- <div class="input-frm-check">
                        <input type="checkbox" id="check" name="remeberMe" {{ old('remeberMe') ? 'checked' : '' }}>
                        <label for="check"> {{ __('remeber me') }} </label>
                    </div> --}}

                    <button class="login-btn" type="submit"> {{ __('login') }} </button>

                    <div class="not-have-account">
                        <p> {{ __('i dont have account') }} </p>
                        <a href="{{ route('site.register') }}"> {{ __('create new account') }} </a>
                    </div>
                </form>
            </div>
            <x-side-auth></x-side-auth>

        </div>

    </main>

@endsection

@push('auth-js')
    <script>
        $.validator.addMethod("validEmailFormat", function(value, element) {

            const emailRegex = /^(?!\.)(?!.*\.\.)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            return this.optional(element) || emailRegex.test(value);
        }, window.emailmessage);

        $("#login_form").validate({
            rules: {
                email: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                    email: true,
                    validEmailFormat: true,
                    remote: {
                        url: "{{ route('site.check.email.dns') }}",
                        type: "post",
                        data: {
                            email: function() {
                                return $("#email").val();
                            },

                            _token: "{{ csrf_token() }}"
                        },
                        dataFilter: function(data) {
                            const json = JSON.parse(data);
                            return json.message ? "\"" + json.message + "\"" : true;
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8
                },
            },

            errorElement: "span",
            errorClass: "error-text text-danger",

            submitHandler: function(form) {
                $('.login-btn').prop('disabled', true).text("{{ __('جاري تسجيل الدخول.') }}");

                let formData = $(form).serialize();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('site.login') }}",
                    data: formData,
                    success: function(response) {
                        window.location.href = response.redirect ?? '/';
                    },
                    error: function(xhr) {
                        $('.login-btn').prop('disabled', false).text("{{ __('login') }}");

                        if (xhr.status === 429) {

                            let seconds = xhr.responseJSON?.retry_after ?? 60;
                            showCountdownError(seconds);
                        } else if (xhr.status === 422) {
                            showToast(xhr.responseJSON.errors, 'error');
                        }else {
                            showToast('something wrong Please try again', 'error');
                        }
                    }
                });
            }
        });

        function showCountdownError(seconds) {
            console.log(seconds);
            let msgBox = $('.login-btn');
            msgBox.text('لقد قمت بعدة محاولات، انتظر ' + seconds + ' ثانية.');

            $('.login-btn').prop('disabled', true);

            let countdown = setInterval(function() {
                seconds--;
                msgBox.text('لقد قمت بعدة محاولات، انتظر ' + seconds + ' ثانية.');

                if (seconds <= 0) {
                    clearInterval(countdown);
                    msgBox.text('');
                    $('.login-btn').prop('disabled', false).text("{{ __('login') }}");
                }
            }, 1000);
        }

        function showToast(message , type) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: type,
                title: message
            })
        }
    </script>
@endpush
@push('auth-js')
@endpush
