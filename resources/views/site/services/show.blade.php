@extends('site.layouts.app')
@section('title', __('خدماتنا'))

@section('pageTitle', __('تفاصيل الخدمة'))

@section('header-pages')
    @include('site.layouts.header_page')

@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
@endpush


@section('content')
    <main id="app">

        <section class="servies-details-page mr-section">
            <div class="main-container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="img-servies-details">
                            <img src="{{ $service->image_path }}" alt="">
                        </div>
                        <div class="text-servies-details">
                            <h2>
                                {{ $service->name }}
                            </h2>
                            <p>
                                {{ $service->price . ' ' . __('EGP') }}
                            </p>
                            <p>
                                {{ $service->desc }}
                            </p>


                            @auth
                                <button class="ctm-btn " id="btn-show"> {{ __('اطلب الخدمة الان') }}</button>
                            @else
                                <a href="{{ route('site.login') }}" class="ctm-btn " id="">
                                    {{ __('تسجيل الدخول') }}</a>
                            @endauth
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="more-page">
                            <div class="title-start">
                                <h2>{{ __('خدمات أخرى') }}</h2>
                            </div>

                            <ul class="more-servies">
                                @forelse ($services as $other_service)
                                    <li>
                                        <a href="{{ route('site.services.show', $other_service->slug) }}">
                                            <div class="img-more-servies">
                                                <img src="{{ $other_service->image_path }}" alt="">
                                                <h2>
                                                    {{ $other_service->name }}
                                                </h2>

                                                {{-- <p>
                                                    {{ $other_service->price . ' ' . __('EGP') }}
                                                </p> --}}
                                            </div>
                                            <i class="bi bi-arrow-left"></i>
                                        </a>
                                    </li>
                                @empty

                                    <div>
                                        <div class="alert alert-danger">
                                            {{ __('لا توجد خدمات حاليا') }}
                                        </div>
                                    </div>
                                @endforelse



                            </ul>
                        </div>
                    </div>
                </div>

                <div class="order-services">
                    <form action="{{ route('site.services.store') }}" method="post" id="service_order">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="service_id" value="{{ $service->id }}">



                                <!-- حقل الوقت -->
                                <div class="input-form mb-3">
                                    <label for="reservation_date"> {{ __('تاريخ الحجز') }} </label>
                                    <input type="datetimelocal" id="reservation_date" name="reservation_date"
                                        class="form-control" placeholder="{{ __('اختر تاريخ الحجز') }}">

                                </div>
                            </div>

                            {{-- <div class="col-lg-12">
                                <div class="input-form">
                                    <textarea class="form-control" placeholder="{{ __('الرسالة') }}" name="message" id=""></textarea>
                                </div>
                            </div> --}}

                            <div class="text-center mt-3 col-lg-12">
                                <button class="ctm-btn ctm-btn-services {{ auth()->user() ? '' : 'auth_login' }}">
                                    {{ __('ارسال') }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>




    </main>



@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            // flatpickr مع onChange لتفعيل الـ change event يدويًا
            flatpickr("#reservation_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:00",
                time_24hr: false,
                minuteIncrement: 60,
                onChange: function(selectedDates, dateStr, instance) {
                    $("#reservation_date").val(dateStr).trigger('change');
                }
            });

            // لما يتغير التاريخ، امسح previousValue عشان الريكوست يتنفذ تاني
            $("#reservation_date").on('change', function() {
                $(this).removeData('previousValue');
            });

            // ترجمة النصوص
            window.request_service = "{{ __('طلب الخدمة') }}";
            window.cancel_service = "{{ __('إلغاء طلب الخدمة') }}";

            // إضافة ميثود notPast
            $.validator.addMethod("notPast", function(value, element) {
                if (!value) return false;
                const selectedDate = new Date(value);
                const now = new Date();
                selectedDate.setSeconds(0, 0);
                now.setSeconds(0, 0);
                return this.optional(element) || selectedDate >= now;
            }, window.messge_date);

            // تفعيل الـ validation
            $("#service_order").validate({
                rules: {
                    reservation_date: {
                        required: true,
                        notPast: true,
                        remote: {
                            url: "{{ route('site.check.date') }}",
                            type: "post",
                            cache: false,
                            data: {
                                reservation_date: function() {
                                    return $("#reservation_date").val();
                                },
                                service_id: function() {
                                    return "{{ $service->id }}";
                                },
                                _token: "{{ csrf_token() }}"
                            },
                            dataFilter: function(data) {
                                const json = JSON.parse(data);
                                return json.message ? "\"" + json.message + "\"" : true;
                            }
                        }
                    }
                },

                errorElement: "span",
                errorLabelContainer: ".errorTxt",

                submitHandler: function(form) {
                    $('.ctm-btn-services').prop('disabled', true).hide();
                    const dateInput = $("#reservation_date");

                    // نعيد التحقق قبل الإرسال النهائي
                    if (!dateInput.valid()) {
                        console.log("error");
                        return;
                    }

                    $('.ctm-btn-services').parent().append(`
                        <div class="spinner-border text-warning" style="width: 3rem;height: 3rem;margin: auto;margin-top: 16px;display: flex;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    `);

                    var formData = new FormData(form);
                    let url = form.action;
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            showToast(data.message, 'success');
                            form.reset();
                        },
                        error: function(data) {
                            let errors = 'حدث خطأ ما، حاول مرة أخرى.';
                            if (data.status === 401) {
                                errors = 'يرجى تسجيل الدخول أولا';
                            } else if (data.responseJSON?.errors?.reservation_date?.[0]) {
                                errors = data.responseJSON.errors.reservation_date[0];
                            }
                            showToast(errors, 'error');
                        }
                    });
                },
            });

            function showToast(message, type) {
                $('.ctm-btn-services').prop('disabled', false).show();
                $('.ctm-btn-services').next('.spinner-border').remove();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    }
                });

                Toast.fire({
                    icon: type,
                    title: message
                });
            }
        });
    </script>
@endpush
