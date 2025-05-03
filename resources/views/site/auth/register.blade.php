@extends('site.authLayouts.authApp')
@section('title', __('Register'))

@section('content')

    <main>

        <div class="login-page">
            <div class="loginform">

                <x-auth-logo></x-auth-logo>


                <form action="{{ route('site.register') }}" method="post" id="register_form">
                    @csrf
                    <div class="frm-head"> {{ __('إنشاء حساب جديد') }}</div>

                    <div class="input-frm">
                        <label for="name"> {{ __('الاسم') }} </label>
                        <input type="text" placeholder="{{ __('الاسم كامل') }}" id="name" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-frm">
                        <label for="email"> {{ __('البريد الالكتروني') }} </label>
                        <input type="email" placeholder="{{ __('البريد الالكتروني') }}" id="email" name="email"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-frm">
                        <label for="phone"> {{ __('رقم الهاتف') }} </label>
                        <input type="text" placeholder="{{ __('رقم الهاتف') }}" id="phone" name="phone"
                            value="{{ old('phone') }}">
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>











                    <div class="input-frm">
                        <label for="password"> {{ __('كلمة المرور') }}</label>
                        <input type="password" id="password" class="frm-pass-text" placeholder="{{ __('كلمة المرور') }}" name="password">
                        <div class="icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-frm">
                        <label for="password_confirmation"> {{ __('تاكيد كلمة المرور') }} </label>
                        <input type="password" id="password_confirmation" class="frm-pass-text"
                            placeholder="{{ __('تاكيد كلمة المرور') }}" name="password_confirmation">
                        <div class="icon"> <i class="fa-regular fa-eye-slash"></i> </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="input-frm-check">
                        <input type="checkbox" id="check" name="remeberMe" {{ old('remeberMe') ? 'checked' : '' }}>
                        <label for="check"> {{ __('تذكرني') }} </label>
                    </div>

                    <button class="register_btn" type="submit"> {{ __('تسجيل دخول') }}</button>

                    <div class="not-have-account">
                        <p> {{ __('بالفعل لدي حساب') }}</p>
                        <a href="{{ route('site.login') }}"> {{ __('تسجيل دخول') }}</a>
                    </div>
                </form>
            </div>
            <x-side-auth></x-side-auth>

        </div>

    </main>

@endsection

@push('auth-js')
    <script>
        $.validator.addMethod("noSpecialChars", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9\u0600-\u06FF ]*$/.test(value);
        }, window.noSpecialChars);

        $.validator.addMethod('string', function(value, element) {
            return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/i.test(value);
        }, window.stringMessage);

        $.validator.addMethod("phone_type", function(value, element) {
            return this.optional(element) || /^[0-9+]+$/.test(value);
        }, window.phoneMessage);

        $.validator.addMethod("validEmailFormat", function(value, element) {
            // Regular expression for a valid email
            // const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            // const emailRegex = /^(?!.*\.\.)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            const emailRegex = /^(?!\.)(?!.*\.\.)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            return this.optional(element) || emailRegex.test(value);
        }, "البريد الإلكتروني غير صالح!");


        $("#register_form").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2,
                    maxlength: 100,
                    noSpecialChars: true,
                    string: true
                },
                email: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                    email: true,
                    validEmailFormat: true,
                    // domain: true,
                    remote: {
                        url: "{{ route('site.check.email') }}",
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
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 15,
                    phone_type: true,
                    remote: {
                        url: "{{ route('site.check.phone') }}",
                        type: "post",
                        data: {
                            phone: function() {
                                return $("#phone").val();
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
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                phone: {
                    minlength: window.phoneMinLengthMessage,
                    maxlength: window.phoneMaxLengthMessage
                }
            },
            errorElement: "span",
            errorLabelContainer: ".errorTxt",


            submitHandler: function(form) {

                $('.register_btn').prop('disabled', true);
                // Hide the button
                $('.register_btn').hide();


                // Add a spinner
                $('.register_btn').parent().append(
                    `<div class="spinner-border"  style="width: 3rem;height: 3rem;margin: auto;/* padding: 24px; */display: flex;"   role="status">
                <span class="sr-only">Loading...</span>
                </div>
                    `
                );
                form.submit();
            }
        });
    </script>
@endpush
