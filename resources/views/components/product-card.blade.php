<a href="{{ route('site.products.show', $service->slug) }}" class="product-index">
    <div class="img">
        <img src="{{ $service->image_path }}" alt="{{ $service->title }}">
    </div>

    <div class="txt">
        <div class="desc">{{ $service->title }}</div>
        <div class="price">
            {{-- <p>Price: <span class="icon-saudi_riyal"></span> 100</p> --}}

            <p class="icon-saudi_riyal"> {{$service->price }}</p>

        </div>


    </div>
</a>
