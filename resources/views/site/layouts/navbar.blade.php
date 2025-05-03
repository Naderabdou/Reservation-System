       <!-- start header =====
        ============ -->
       <header class="header active">
           <!-- start top bar  -->
           <div class="top-bar">
               <div class="main-container">
                   <div class="content-header">
                       <a target="__blank" href="tel:{{ $setting->phone }}">
                           {{ __('اتصل بنا') }} :
                           <span>
                               {{ $setting->phone }}
                           </span>
                       </a>
                       <a href="mailto::{{ $setting->email }}">
                           {{ __('البريد الالكتروني') }}:
                           <span>
                               {{ $setting->email }}
                           </span>
                       </a>
                   </div>

                   <div class="sco-media">
                       <ul>
                           {{-- <li>
                               <a href="{{ route('site.lang', app()->getLocale() == 'ar' ? 'en' : 'ar') }}">
                                   {{ app()->getLocale() == 'ar' ? 'En' : 'Ar' }}
                               </a>

                           </li> --}}
                           <li>
                               <a target="__blank" href="{{ $setting->instagram }}"><i class="bi bi-instagram"></i></a>
                           </li>

                           <li>
                               <a target="__blank" href="{{ $setting->facebook }}"><i class="bi bi-facebook"></i></a>
                           </li>





                       </ul>
                   </div>
               </div>
           </div>
           <!-- end top bar  -->


           <nav class="nav-bar">
               <div class="main-container">
                   <div class="logo">
                       <a href="/">
                           <img src="{{ asset('storage/' . $setting->logo) }} " alt="" style="width: 200px;">
                       </a>
                   </div>

                   <div class="element">
                       <ul>
                           <li><a href="/" class="{{ isActiveRoute('site.home') }}">{{ __('الرئيسية') }}</a>
                           </li>
                           <li><a href="{{ route('site.services') }}"
                                   class="{{ isActiveRoute('site.services') }}">{{ __('خدماتنا') }}</a></li>
                       </ul>

                   </div>
                   @guest

                       <div class="btns-nav-bar">
                           <a href="{{ route('site.login') }}" class="ctm-btn">{{ __('تسجيل الدخول') }}</a>

                           <div class="menu-div">
                               <div class="content" id="times-ican">
                                   <a href="#" title="Navigation menu" class="navicon" aria-label="Navigation">
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                   </a>
                               </div>
                           </div>

                       </div>

                   @endguest

                   @auth
                       <div class="btns-nav-bar">
                           <a href="{{ route('site.profile') }}" class="ctm-btn">{{ __('الملف الشخصي') }}</a>

                           <div class="menu-div">
                               <div class="content" id="times-ican">
                                   <a href="#" title="Navigation menu" class="navicon" aria-label="Navigation">
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                   </a>
                               </div>
                           </div>

                           <a href="{{ route('site.logout') }}" class="ctm-btn" style="background-color: red ; margin-right: 20px">{{ __('تسجيل الخروج') }}</a>

                           <div class="menu-div">
                               <div class="content" id="times-ican">
                                   <a href="#" title="Navigation menu" class="navicon" aria-label="Navigation">
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                       <span class="navicon__item"></span>
                                   </a>
                               </div>
                           </div>

                       </div>


                   @endauth


               </div>

           </nav>

           @yield('header-pages')

       </header>
       <!-- end header =====
        ============== -->
