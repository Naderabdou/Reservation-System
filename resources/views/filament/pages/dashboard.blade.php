
<x-filament::page>
    <x-filament::section>
        <div class="app-content content mt-4">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <!-- Dashboard Analytics Start -->
                    <section id="dashboard-analytics">
                        <div class="row match-height justify-content-center">
                            <!-- Greetings Card starts -->

                            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                                <div class="card shadow-lg border-0 rounded-lg">
                                    <div class="card-header py-3 bg-primary text-white">
                                        <h6 class="m-0 font-weight-bold">{{ __('المقدمة') }}</h6>
                                    </div>
                                    <div class="card-body animate__animated animate__bounce p-4">
                                        <div class="d-flex justify-content-center mb-4">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 rounded-circle shadow"
                                                style="width: 25rem; filter: drop-shadow(5px 5px 5px rgba(0, 0, 0, 0.68));"
                                                src="{{ asset('quto.webp') }}" alt="...">
                                        </div>
                                        <div class="text-justify ltr ">
                                            <p class="mb-3">
                                                The vision is to create a world where everyone has equal opportunities to succeed.
                                            </p>
                                            <p class="mb-3">
                                                We offer businesses multiple solutions to their problems without the hassle of selecting the best options, leaving the decision directly in their hands.
                                            </p>
                                            <p class="mb-4">
                                                We believe that individuals have the potential to be successful by creating opportunities to learn and grow their skills, and by finding work that is both challenging and rewarding through participating in challenges and winning prizes.
                                            </p>

                                            <x-filament::link href="https://code-quests.com/">
                                                &rarr; Visit our official website for more about Code Quests
                                            </x-filament::link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Greetings Card ends -->
                        </div>
                    </section>
                    <!-- Dashboard Analytics end -->
                </div>
            </div>
        </div>
        <style>
             :root {
                --c-400: 34, 139, 34; /* Example RGB value for dark green */
                --tw-text-opacity: 1; /* Example opacity value */
            }
            .fi-section-content-ctn {
                margin-top: 20px;
            }

            h6.m-0.font-weight-bold {
                color: #817dbf
            }
        </style>

    </x-filament::section>

</x-filament::page>
