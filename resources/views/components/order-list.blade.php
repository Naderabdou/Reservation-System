<div class="current-orders-header">
    <h4> {{ __('Order Number') }} #{{ $order->order_number }}</h4>
    <a href="{{ route('site.order.show', $order->id) }}">
        {{ __('Order Details') }}</a>
    @if ($order->status == 'pending')
        <a class="cancel-order" href="{{ route('site.order.cancel', $order->id) }}">
            {{ __('Order Cancel') }}</a>
    @endif

</div>

<!--  -->
<div class="current-orders-body">

    <div class="order-item" data-status="{{ $order->status }}">
        <div class="order-item-img">
            <img src="{{ $order?->service?->image_path ?? asset('storage/' . $setting->logo) }}" alt="" />
        </div>

        <div class="order-item-details">
            <h5 class="item-name name">
                {{ $order->service?->name ?? $order->service_name }}
            </h5>
            <h5 class="item-quantity">
                {{ Str::limit($order?->service?->desc ?? 'تم حذف هذا الخدمة', 100) }}
            </h5>

            <h5 class="item-price icon-saudi_riyal">
                {{ $order->service_price . ' ' . __('EGP') }}
            </h5>
            <h5 class="item-date">
                {{ __('Order Status') . ' : ' . __($order->status) }}
            </h5>

            <h5 class="item-date">

                {{ __('Order Reservation Date :') . '  ' . $order->reservation_date }}
            </h5>
        </div>
    </div>

</div>
