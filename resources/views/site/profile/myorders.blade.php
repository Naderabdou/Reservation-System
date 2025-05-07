@extends('site.layouts.app')
@section('title', __('My Orders'))

@section('content')


    <x-sub-header :name="__('My Orders')" :show="true" :page="__('Profile')" :url="route('site.profile')" />
    <section class="my-orders">
        <div class="main-container">
            <div class="row-gap-4 row">
                <div class="col-lg-4 col-md-12">
                    <x-profile :user="auth()->user()" />
                </div>
                @if ($orders->count() > 0)
                    <div class="col-lg-8 col-md-12">
                        <div class="my-orders-header">
                            <h4>{{ __('My Orders') }}</h4>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="current-orders-tab" data-bs-toggle="pill"
                                        data-bs-target="#current-orders" type="button" role="tab"
                                        aria-controls="current-orders" aria-selected="true">
                                        {{ __('Current Orders') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="accepted-orders-tab" data-bs-toggle="pill"
                                        data-bs-target="#accepted-orders" type="button" role="tab"
                                        aria-controls="accepted-orders" aria-selected="true">
                                        {{ __('Accepted Orders') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="completed-orders-tab" data-bs-toggle="pill"
                                        data-bs-target="#completed-orders" type="button" role="tab"
                                        aria-controls="completed-orders" aria-selected="false">
                                        {{ __('Completed Orders') }}
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="canceled-orders-tab" data-bs-toggle="pill"
                                        data-bs-target="#canceled-orders" type="button" role="tab"
                                        aria-controls="canceled-orders" aria-selected="false">
                                        {{ __('Canceled Orders') }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="orders-list" role="tabpanel"
                                aria-labelledby="current-orders-tab" tabindex="0">
                                <div class="current-orders list">
                                    @forelse ($orders as $order)
                                        <div class="order-item" data-status="{{ $order->status }}">
                                            <x-order-list :order="$order" />
                                        </div>
                                    @empty
                                        <div class="empty-cart" style="">
                                        </div>
                                        <h4>No Orders Found</h4>
                                    @endforelse
                                </div>
                                <ul class="pagination custom-pagination"></ul>
                            </div>
                            <!-- Completed and Canceled orders sections go here -->
                        </div>

                    </div>
                @else
                    <div class="col-lg-8 col-md-12">
                        <div class="empty-cart">
                            <h4>{{ __('No Orders Found') }}</h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>





@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        // تعريف قائمة List.js
        const options = {
            valueNames: ['item-name', 'item-price', 'item-date'],
            listClass: 'list',
            page: 4,
            pagination: true,
        };

        const orderList = new List('orders-list', options);

        // دالة الفلترة حسب status
        function filterOrdersByStatus(status) {
            orderList.filter(item => item.elm.dataset.status === status);
        }

        // ربط التابات
        document.getElementById('current-orders-tab').addEventListener('click', function() {
            filterOrdersByStatus('pending');
        });

        document.getElementById('accepted-orders-tab').addEventListener('click', function() {
            filterOrdersByStatus('accepted');
        });

        document.getElementById('completed-orders-tab').addEventListener('click', function() {
            filterOrdersByStatus('completed');
        });

        document.getElementById('canceled-orders-tab').addEventListener('click', function() {
            filterOrdersByStatus('canceled');
        });

        // افتراضياً عرض الطلبات الجارية أولاً
        filterOrdersByStatus('pending');
    </script>
@endpush
