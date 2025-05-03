     <!-- start footer ==============================
        ============================== -->
     <footer class="footer" style="background-image: url();">
         <div class="main-container">


             <div class="main-footer">
                 <div class="row">
                     <div class="col-lg-5">
                         <div class="sub-main-footer">
                             <div class="logo-footer">
                                 <a href="index.html">
                                     <img src="{{ asset('storage/' . $setting->logo) }}" alt="" style="width: 68%; margin-right: 94%;"/>
                                 </a>


                             </div>
                         </div>
                     </div>




                 </div>
             </div>
             <div class="end-page">

                <p> {{ __('كل الحقوق محفوظة 2024') }} &copy; {{ __('لشركة ') }} <span> {{ $setting->{'site_name_' . app()->getLocale()} }} </span> </p>
            </div>
         </div>

     </footer>
     <!-- end footer=========================
        ===========================  -->





     <!-- start menu responsive ===
        ======== -->


     <!-- end menu responsive ===
            ======== -->

     </div>


     <div class="bg_menu ">
    </div>
    <div class="menu_responsive" id="menu-div">

        <div class="logo-menu">
           <img src="{{ asset('storage/' . $setting->logo) }} " alt="">
       </div>

        <div class="element_menu_responsive">
            <ul>
                <li><a href="/" class="{{ isActiveRoute('site.home') }}">{{ __('الرئيسية') }}</a></li>


                <li><a href="{{ route('site.home') }}"
                        class="{{ isActiveRoute('site.home') }}">{{ __('خدماتنا') }}</a></li>



            </ul>
        </div>




        <div class="remove-mune">
            <span></span>
        </div>




    </div>

     @include('site.layouts.script')
