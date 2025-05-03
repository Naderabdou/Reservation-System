@extends('site.layouts.app')
@section('title', __('الرئيسية'))


@section('header')

@endsection

@section('content')
    <!-- start app ====
                ===============================
                ================================
                ============== -->
    <main id="app">


        <!-- start servies-index  -->
        <section class="servies-index pg-section">
            <div class="bg-animation"></div>
            <div class="main-container">
                <div class="title-start">
                    <h2>
                        {{ __('خدماتنا') }}
                    </h2>
                    <p>
                        {{ __('نقدم مجموعة من الخدمات التي تغطي جميع جوانب سوق العقارات:') }}
                    </p>
                </div>


                <div class="owl-carousel owl-theme maincarousel" id="slider-servies">
                    @forelse ($services as $service)
                        <div class="item">
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
                                    {{ Str::limit($service->desc, 100) }}
                                </p>


                                <a href="{{ route('site.services.show', $service->slug) }}">{{ __('اطلب الخدمة') }}</a>
                            </div>
                        </div>
                    @empty

                        <div>
                            <h2>
                                {{ __('لا يوجد خدمات') }}
                            </h2>
                        </div>
                    @endforelse


                </div>
            </div>
        </section>
        <!-- end servies-index  -->




    </main>



    <!-- end app ====
                =============================
                ==================================
                ==================== -->



@endsection
