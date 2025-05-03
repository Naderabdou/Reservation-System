@extends('site.layouts.app')
@section('title', __('Order Details'))

@section('content')

    <x-sub-header :name="__('Order Details')" :show="true" :page="__('Order')" :url="route('site.myorders')" />
    <section class="orders-details">
        <div class="main-container">
            <div class="row-gap-4 row">
                <div class="col-lg-4 col-md-12">
                    <x-profile :user="auth()->user()" />

                </div>
                <!--  -->
                <div class="col-lg-8 col-md-12">
                    <div class="order-det-section">
                        <h4 class="orders-section-header"> {{ __('Order Details') }}</h4>
                        <div class="orders-details-content">
                            <div class="details-header">
                                <div class="order-header-info">
                                    <div class="order-number">
                                        <h4> {{ __('Order Number') }} #{{ $order->order_number }}</h4>

                                        <p> {{ __('Order Reservation Date :') . '  ' . $order->reservation_date }} </p>
                                        <p> {{ __('Order Status') . ' : ' . __($order->status) }} </p>
                                    </div>
                                    <div class="order-price icon-saudi_riyal">
                                        <h4>{{ $order->service_price . ' ' . __('EGY') }} </h4>

                                    </div>

                                </div>
                                <!--  -->

                                <div class="order-status"
                                    style="--progress-width: {{ $order->status == 'completed' ? '100%' : ($order->status == 'canceled' ? '100%' : '0%') }}">


                                    <div class="order-status-icon done init" data-firstorder="{{ __('جاري الانتظار') }}">
                                        <div class="init-group animate  first done">
                                            <div class="init-group ">
                                                <img src="{{ asset('loginLayout/site/images/preper.svg') }}" />
                                            </div>
                                        </div>
                                    </div>


                                    @if ($order->status == 'completed')
                                        <div class="order-status-icon {{ $order->status == 'completed' ? 'done init' : '' }}"
                                            data-seconedOrder="{{ __('تم اكتمال الطلب') }}">
                                            <div
                                                class="init-group animate {{ $order->status == 'completed' ? 'first done' : '' }}">
                                                <div class="init-group animate ">
                                                    <img src="{{ asset('loginLayout/site/images/Simplification.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @elseIf ($order->status == 'canceled')
                                        <div class="order-status-icon {{ $order->status == 'canceled' ? 'done init' : '' }}"
                                            data-seconedOrder="{{ __('تم الغاء الطلب') }}">
                                            <div
                                                class="init-group animate {{ $order->status == 'canceled' ? 'first done' : '' }}">
                                                <div class="init-group animate ">
                                                    <img src="{{ asset('site/images/cancel.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="order-status-icon {{ $order->status == 'pending' ? 'done init' : '' }}"
                                            data-seconedOrder="{{ __('جاري الاكتمال') }}">
                                            <div
                                                class="init-group animate {{ $order->status == 'pending' ? 'first done' : '' }}">
                                                <div class="init-group animate ">
                                                    <img src="{{ asset('loginLayout/site/images/Simplification.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endif





                                </div>
                                <!--  -->
                            </div>




                            <!--  -->

                            <!--  -->
                            <div class="current-orders">

                                <!--  -->
                                <div class="current-orders-body">
                                    <div class="order-item">
                                        <div class="order-item-img">
                                            <img src="{{ $order?->service?->image_path ?? asset('storage/' . $setting->logo) }}"
                                                alt="" />
                                        </div>
                                        <div class="order-item-details">
                                            <h5 class="item-name"> {{ $order->service->name ?? $order->service_name }}</h5>

                                            <h5 class="item-quantity">
                                                {{ Str::limit($order?->service?->desc ?? 'تم حذف هذا الخدمة', 100) }}
                                            </h5>
                                            <h5 class="item-price icon-saudi_riyal">
                                                {{ $order->service_price . ' ' . __('EGY') }}</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
