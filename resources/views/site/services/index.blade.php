@extends('site.layouts.app')
@section('title', __('خدماتنا'))

@section('pageTitle', __('خدماتنا'))

@section('header-pages')
    @include('site.layouts.header_page')

@endsection


@section('content')
    <!-- start app ====
            ===============================
            ================================
            ============== -->
    <main id="app">


        <section class="servies-page mr-section">
            <div class="main-container">
                <div class="title-start">
                    <h2>{{ __('خدماتنا') }}</h2>
                    <p>
                        {{ __('نقدم مجموعة من الخدمات التي تغطي جميع جوانب سوق العقارات:') }}
                    </p>
                </div>
                <div class="row">

                    @forelse ($services as $service)
                        <div class="col-lg-4">
                            <div class="sub-servies-index">
                                <div class="title-servies-index">
                                    <h2>
                                        {{ $service->name }}
                                    </h2>
                                    <img src="{{ $service->image_path }}" alt="">
                                </div>

                                <p>
                                    {{ $service->price . ' ' . __('EGP') }}
                                </p>
                                <p>
                                    {{ Str::limit($service->desc ?? '-', 150) }}

                                </p>
                                <a href="{{ route('site.services.show', $service->slug) }}">{{ __('اطلب الخدمة') }}</a>
                            </div>
                        </div>
                    @empty
                        <div>
                            <div class="alert alert-danger">
                                {{ __('لا توجد خدمات حاليا') }}
                            </div>
                        </div>
                    @endforelse


                </div>
            </div>
        </section>



















    </main>



    <!-- end app ====
            =============================
            ==================================
            ==================== -->



@endsection
@push('js')
@endpush
