@props(['name', 'show', 'page', 'url'])
<section class="sub-header-page" style="background-image: url('{{ asset('loginLayout/site') }}/images/sub-header-bg.png');">
    <div class="main-container">
        <div class="sub-header-txt"> {{ $name }} </div>
        <div class="sub-header-liniks">
            <a href="/"> {{ __('Main') }} </a>
            <img src="{{ asset('site') }}/images/arrow.png" alt="">
            @if (isset($show))
                <a href="{{ $url }}"> {{ $page }} </a>
                <img src="{{ asset('site') }}/images/arrow.png" alt="">
            @endif
            <p> {{ $name }} </p>
        </div>
    </div>
</section>
