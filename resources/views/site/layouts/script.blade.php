<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('site/js/anime.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('site/js/lightgallery.min.js') }}"></script>
<script src="https://kit.fontawesome.com/392319d0e8.js" crossorigin="anonymous"></script>



<script src="{{ asset('site/js/custom.js') }}"></script>


<script src="{{ asset('jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (app()->getLocale() == 'ar')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_ar.min.js"></script>
@else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_en.min.js"></script>
@endif
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

<script>
    @php
        $messages = [
            'phoneMessage' => __('الهاتف يجب ان يحتوي علي ارقام فقط'),
            'emailmessage' => __('الرجاء ادخال الايميل من نطاق (gmail, yahoo, hotmail, outlook)'),
            'phoneMinLengthMessage' => __('يجب ان لا يقل الهاتف عن 10 ارقام'),
            'phoneMaxLengthMessage' => __('يجب ان لا يزيد الهاتف عن 15 رقم'),
            'stringMessage' => __('يجب ان يحتوي علي حروف فقط'),
            'noSpecialChars' => __('لا يمكن استخدام الرموز الخاصة'),
            'linked' => __('تم نسخ الرابط بنجاح'),
            'messge_date' => __('يجب اختيار تاريخ ووقت بدءًا من الآن أو لاحقًا.'),
        ];
    @endphp

    @foreach ($messages as $key => $message)
        window.{{ $key }} = "{{ $message }}";
    @endforeach
</script>
<script>
    var lang = '{{ app()->getLocale() }}';

    if (lang == 'ar') {
        var message = 'يجب عليك التسجيل لاستخدام هذه الميزة ';
        var message_sure = 'هل تريد التسجبل ؟';
        var yes = 'نعم';
        var no = 'لا';
        var message_close = 'تم الالغاء بنجاح';
        var paynow = 'اشتري الان';
    } else {

        var message = 'You must register to use this feature';
        var message_sure = 'Do you want to register ?';
        var yes = 'Yes';
        var no = 'No';
        var message_close = 'Canceled successfully';
        var paynow = 'Pay Now';
    }

    $(document).on('click', '.auth_login', function(e) {
        e.preventDefault();
        Swal.fire({
            title: message_sure,
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#52b694',
            cancelButtonColor: '#d33',
            confirmButtonText: yes,
            cancelButtonText: no
        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = "/login";


            } else {

            }
        })

    });
</script>


<script>
    AOS.init();
</script>



@stack('js')
