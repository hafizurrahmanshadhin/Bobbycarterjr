@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/brand/logo.png') }}"
                    class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/brand/logo-1.png') }}"
                    class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/brand/logo-2.png') }}"
                    class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/brand/logo-3.png') }}"
                    class="header-brand-img light-logo1" alt="logo">
            </a>
        </div>

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"
                            enable-background="new 0 0 24 24" viewBox="0 0 24 24">
                            <path
                                d="M19.9794922,7.9521484l-6-5.2666016c-1.1339111-0.9902344-2.8250732-0.9902344-3.9589844,0l-6,5.2666016C3.3717041,8.5219116,2.9998169,9.3435669,3,10.2069702V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h2.5h7c0.0001831,0,0.0003662,0,0.0006104,0H18c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-8.7930298C21.0001831,9.3435669,20.6282959,8.5219116,19.9794922,7.9521484z M15,21H9v-6c0.0014038-1.1040039,0.8959961-1.9985962,2-2h2c1.1040039,0.0014038,1.9985962,0.8959961,2,2V21z M20,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2h-2v-6c-0.0018311-1.6561279-1.3438721-2.9981689-3-3h-2c-1.6561279,0.0018311-2.9981689,1.3438721-3,3v6H6c-1.1040039-0.0014038-1.9985962-0.8959961-2-2v-8.7930298C3.9997559,9.6313477,4.2478027,9.0836182,4.6806641,8.7041016l6-5.2666016C11.0455933,3.1174927,11.5146484,2.9414673,12,2.9423828c0.4853516-0.0009155,0.9544067,0.1751099,1.3193359,0.4951172l6,5.2665405C19.7521973,9.0835571,20.0002441,9.6313477,20,10.2069702V19z" />
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide"
                        href="{{ route('admin.subscription.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" class="side-menu__icon" x="0" y="0"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve"
                            class="">
                            <g>
                                <path fill="#e6e6e6" d="M40 44H24a2 2 0 0 1-2-2V24a2 2 0 0 1 2-2h19a2 2 0 0 1 2 2v15z"
                                    opacity="1" data-original="#e6e6e6" class=""></path>
                                <path fill="#f2f2f2" d="M40 44v-5h5z" opacity="1" data-original="#f2f2f2"></path>
                                <path fill="#86a1bf" d="M45 24v2H22v-2a2.006 2.006 0 0 1 2-2h19a2.006 2.006 0 0 1 2 2z"
                                    opacity="1" data-original="#86a1bf"></path>
                                <path fill="#7d97b3" d="M35 8V2l5 3zM29 56v6l-5-3z" opacity="1"
                                    data-original="#7d97b3"></path>
                                <circle cx="54" cy="10" r="8" fill="#8fccc0" opacity="1"
                                    data-original="#8fccc0"></circle>
                                <circle cx="10" cy="54" r="8" fill="#ffd98c" opacity="1"
                                    data-original="#ffd98c"></circle>
                                <path
                                    d="M43 21H24a3 3 0 0 0-3 3v18a3 3 0 0 0 3 3h16a1 1 0 0 0 .707-.293l5-5A1 1 0 0 0 46 39V24a3 3 0 0 0-3-3zm-2 20.586V40h1.586zM44 38h-4a1 1 0 0 0-1 1v4H24a1 1 0 0 1-1-1V27h21zm0-13H23v-1a1 1 0 0 1 1-1h19a1 1 0 0 1 1 1z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M30 30h2v2h-2zM35 30h2v2h-2zM40 30h2v2h-2zM30 34h2v2h-2zM25 34h2v2h-2zM35 34h2v2h-2zM30 38h2v2h-2zM25 38h2v2h-2zM35 38h2v2h-2zM40 34h2v2h-2zM54 1a9 9 0 1 0 9 9 9.01 9.01 0 0 0-9-9zm0 16a7 7 0 1 1 7-7 7.009 7.009 0 0 1-7 7zM10 63a9 9 0 1 0-9-9 9.01 9.01 0 0 0 9 9zm0-16a7 7 0 1 1-7 7 7.009 7.009 0 0 1 7-7z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M52.232 11.414 50.818 10 49.4 11.414l2.121 2.121a1 1 0 0 0 1.414 0L58.6 7.879l-1.418-1.414zM10.5 56h-1a.5.5 0 0 1-.5-.5H7a2.5 2.5 0 0 0 2 2.449V59h2v-1.051A2.5 2.5 0 0 0 10.5 53h-1a.5.5 0 0 1 0-1h1a.5.5 0 0 1 .5.5h2a2.5 2.5 0 0 0-2-2.449V49H9v1.051A2.5 2.5 0 0 0 9.5 55h1a.5.5 0 0 1 0 1zM32 58a25.65 25.65 0 0 1-2-.089V56a1 1 0 0 0-1.515-.857l-5 3a1 1 0 0 0 0 1.714l5 3A1 1 0 0 0 30 62v-2.083c.674.049 1.344.083 2 .083a28.01 28.01 0 0 0 26.4-37.335l-1.884.67A26.011 26.011 0 0 1 32 58zm-4 2.233L25.943 59 28 57.767zM32 6c.65 0 1.317.034 2 .084V8a1 1 0 0 0 1.515.857l5-3a1 1 0 0 0 0-1.714l-5-3A1 1 0 0 0 34 2v2.078A29.686 29.686 0 0 0 32 4 28.01 28.01 0 0 0 5.6 41.335l1.884-.67A26.011 26.011 0 0 1 32 6zm4-2.233L38.057 5 36 6.233z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Subscription</span>
                    </a>
                </li>



                <hr>
                <li class="slide {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 512 512">
                            <path
                                d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                        </svg>
                        <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i>
                    </a>

                    <ul class="slide-menu ">
                        <li><a href="{{ route('profile.setting') }}" class="slide-item">Profile Settings</a></li>
                        <li><a href="{{ route('system.index') }}" class="slide-item">System Settings</a></li>
                        <li><a href="{{ route('mail.setting') }}" class="slide-item">Mail Settings</a></li>
                        <li><a href="{{ route('google.setting') }}" class="slide-item">Google Settings</a></li>
                        <li><a href="{{ route('stripe.index') }}" class="slide-item">Stripe Settings</a></li>

                        <li>
                            <a href="{{ route('settings.dynamic_page.index') }}"
                                class="slide-item {{ request()->is('admin/settings/dynamic-page*') ? 'active' : '' }}">Dynamic
                                Page Settings
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
