@extends('site.layouts.app')
@section('title', __('profile'))

@section('content')

    <x-sub-header :name="__('profile')" />
    <section class="my-account">
        <div class="main-container">
            <div class="row-gap-4 row">
                <div class="col-lg-4 col-md-12">
                    <x-profile :user="$user" />
                </div>
                <div class="col-lg-8 coll-md-12">
                    <div class="my-account-content">
                        <h4>{{ __('Edit Account Data') }}</h4>
                        <form action="{{ route('site.user.update') }}" method="post" id="profile-update-form">

                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="">{{ __('name') }}</label>
                                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                                        class="" placeholder="{{ __('name') }}" />
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="email">{{ __('email') }}</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                        class="" placeholder="{{ __('email') }}" />
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="phone">{{ __('phone') }}</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" id="phone"
                                        class="" placeholder="{{ __('phone') }}" />
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">
                                    <button type="submit" class="mt-3 btn btn-primary">
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-account-content">
                        <h4>{{ __('reset password') }}</h4>
                        <form action="{{ route('site.user.resetpassword') }}" method="post" id="reset-password-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="old_password"> {{ __('old password') }}</label>
                                    <div class="input-group">
                                        <input type="password" name="old_password" id="old_password" class=""
                                            placeholder=" {{ __('old password') }}" />
                                        <img src="{{ asset('site') }}/images/icons.svg" alt="" />
                                    </div>
                                    @error('old_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="new-password"> {{ __('new password') }}</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="new-password" class=""
                                            placeholder="  {{ __('new password') }} " />
                                        <img src="{{ asset('site') }}/images/icons.svg" alt="" />
                                    </div>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 form-group">
                                    <label for="confirm-password"> {{ __('new password confirmation') }}</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="confirm-password"
                                            class="" placeholder="{{ __('new password confirmation') }}" />

                                        <img src="{{ asset('site') }}/images/icons.svg" alt="" />
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <button type="submit" class="mt-3 btn btn-primary">
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
@push('js')
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

        $.validator.addMethod("phone_saudi", function(value, element) {
            // Regular expression for full and local numbers
            // const fullNumberRegex = /^(?:\+966|00966)\d{9}(\+)?$/;
            const localNumberRegex = /^05\d{8}$/;
            // return this.optional(element) || fullNumberRegex.test(value) || localNumberRegex.test(value);
            return this.optional(element) || localNumberRegex.test(value);
        }, "{{ __('رقم الهاتف يجب أن يكون رقمًا محليًا سعوديًا يبدأ بـ 05.') }}");


        $("#profile-update-form").validate({
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
                            id: function() {
                                return {{ $user->id }};
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
                            id: function() {
                                return {{ $user->id }};
                            },
                            _token: "{{ csrf_token() }}"

                        },
                        dataFilter: function(data) {
                            const json = JSON.parse(data);
                            return json.message ? "\"" + json.message + "\"" : true;
                        }
                    }
                },



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
                form.submit();
            }
        });


        $("#reset-password-form").validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 8,
                    remote: {
                        url: "{{ route('site.check.password') }}",
                        type: "post",


                        data: {
                            old_password: function() {
                                return $("#old_password").val();
                            },
                            id: function() {
                                return {{ $user->id }};
                            },
                            _token: "{{ csrf_token() }}"

                        },
                        dataFilter: function(data) {
                            const json = JSON.parse(data);
                            return json.message ? '"' + json.message + '"' : true;
                        },
                    },
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#new-password",
                },

            },

            errorElement: "span",
            errorLabelContainer: ".errorTxt",


            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
