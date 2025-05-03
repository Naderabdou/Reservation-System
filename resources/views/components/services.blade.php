@props(['categories', 'allProducts'])

<section class="most-sales" style="background-image: url('{{ asset('site') }}/images/bg-section.png');">
    <div class="main-container">
        <div class="department_classifications_head">
            <div class="top-title"> {{ __('Best selling products') }}</div>
            <p>{{ __('Browse a selection of the most requested products from our customers.') }}</p>
        </div>

        <div class="products-container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-products-tab" data-bs-toggle="tab"
                        data-bs-target="#all-products" type="button" role="tab" aria-controls="all-products"
                        aria-selected="true">
                        {{ __('All Products') }}
                    </button>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="category-tab-{{ $category->id }}" data-bs-toggle="tab"
                            data-bs-target="#category-{{ $category->id }}" type="button" role="tab"
                            aria-controls="category-{{ $category->id }}" aria-selected="false">
                            {{ $category->name }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="myTabContent">
                <!-- جميع المنتجات -->
                <div class="tab-pane fade show active" id="all-products" role="tabpanel"
                    aria-labelledby="all-products-tab">
                    <div class="products-container-cards">
                        @forelse($allProducts as $product)
                            @include('components.product-card', ['product' => $product])
                        @empty
                            <div class="empty-cart">
                                <h4>{{ __('No products') }}</h4>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- المنتجات حسب التصنيفات -->
                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="category-{{ $category->id }}" role="tabpanel"
                        aria-labelledby="category-tab-{{ $category->id }}">
                        <div class="products-container-cards">
                            @forelse($category->products as $product)
                            @include('components.product-card', ['product' => $product])
                            @empty
                                <div class="empty-cart">
                                    <h4>{{ __('No products') }}</h4>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
