<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ getSetting('site_name_' . app()->getLocale()) }} | @yield('title')</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- OWL Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/global.css">
    <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/main.css">
    <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/responsive2.css">

    @if (app()->getLocale() == 'en')
        <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/en.css">
    @endif

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('loginLayout/site') }}/css/ar.css">
    @endif
    <style>
        .error {
            color: red;
        }
    </style>
    @stack('auth-css')
</head>

<body>


    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script src="{{ asset('jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    @if (app()->getLocale() == 'ar')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
    @endif
    <script>
        @php
            $messages = [
                'phoneMessage' => __('الهاتف يجب ان يحتوي علي ارقام فقط'),
                'emailmessage' => __('الرجاء ادخال الايميل بشكل صحيح'),
                'phoneMinLengthMessage' => __('يجب ان لا يقل الهاتف عن 10 ارقام'),
                'phoneMaxLengthMessage' => __('يجب ان لا يزيد الهاتف عن 15 رقم'),
                'stringMessage' => __('يجب ان يحتوي علي حروف فقط'),
                'noSpecialChars' => __('لا يمكن استخدام الرموز الخاصة'),
                'linked' => __('تم نسخ الرابط بنجاح'),
                'fileError' => __('الملف يجب ان يكون بصيغة (pdf, doc, docx, txt, dot)'),
                'fileSize' => __('الملف يجب أن يكون بحجم أقل من أو يساوي 6 ميجا'),
                'phoneSaudi' => __('رقم الهاتف يجب أن يكون رقمًا محليًا سعوديًا يبدأ بـ 05.'),
                'fileSizeEvent' => __('الملف يجب ان يكون بحجم اقل من او يساوي 5 ميجا'),
            ];
        @endphp

        @foreach ($messages as $key => $message)
            window.{{ $key }} = "{{ $message }}";
        @endforeach
    </script>

    @if (session()->has('success'))
        <script>
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
                icon: 'success',
                title: "{{ session()->get('success') }}"
            })
        </script>
    @endif

    @if (session()->has('error'))
        <script>
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
                icon: 'error',
                title: "{{ session()->get('error') }}"
            })
        </script>
    @endif

    @stack('auth-js')
</body>

</html>
