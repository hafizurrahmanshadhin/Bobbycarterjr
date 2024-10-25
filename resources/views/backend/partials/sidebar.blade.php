@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header p-0 py-2">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" class="header-brand-img desktop-logo"
                    alt="logo" style="width: 100px; height: 100%;">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" class="header-brand-img toggle-logo"
                    alt="logo" style="width: 100px; height: 100%;">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" class="header-brand-img light-logo"
                    alt="logo" style="width: 100px; height: 100%;">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/logo.png') }}" class="header-brand-img light-logo1"
                    alt="logo" style="width: 100px; height: 100%;">
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
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.user.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="side-menu__label">Users</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.subscription.*')" data-bs-toggle="slide"
                        href="{{ route('admin.subscription.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-trophy side-menu__icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z"
                                class="icon-path" />
                        </svg>
                        <span class="side-menu__label">Subscription</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('course-type.index.*')" data-bs-toggle="slide"
                        href="{{ route('course-type.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path
                                d="M6 2C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V4C20 2.89543 19.1046 2 18 2H6ZM6 4H18V20H6V4ZM8 6H16V8H8V6ZM8 10H16V12H8V10Z" />
                        </svg>
                        <span class="side-menu__label">Course Type</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('course.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                            <path
                                d="M12 2L1 8l11 6 9-4.9V14h2V9.1L12 2zm0 2.2L17.9 8 12 10.9 6.1 8 12 4.2zM1 10v2l4.5 2.5v3c0 1.7 2.9 3 6.5 3s6.5-1.3 6.5-3v-3L23 12v-2l-11 6L1 10zm6.5 4.6l4.5 2.5 4.5-2.5V17c0 .6-1.8 2-4.5 2s-4.5-1.4-4.5-2v-2.4z" />
                        </svg>
                        <span class="side-menu__label">Course</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide"
                        href="{{ route('survay-questions.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M10.854 6.146a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L11 6.793 10.854 6.146z" />
                            <path
                                d="M1 2.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                        </svg>
                        <span class="side-menu__label">Survay Questions</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.course.module.*')" data-bs-toggle="slide"
                        href="{{ route('admin.course.module.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-stack side-menu__icon">
                            <path d="M4 4h16v4H4V4z" fill="currentColor" />
                            <path d="M4 10h16v4H4v-4z" fill="currentColor" />
                            <path d="M4 16h16v4H4v-4z" fill="currentColor" />
                        </svg>
                        <span class="side-menu__label">Course Module</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.article.*')" data-bs-toggle="slide"
                        href="{{ route('admin.article.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-news side-menu__icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11" />
                            <path d="M8 8l4 0" />
                            <path d="M8 12l4 0" />
                            <path d="M8 16l4 0" />
                        </svg>
                        <span class="side-menu__label">Course Article</span>
                    </a>
                </li>


                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.task_answer.*')" data-bs-toggle="slide"
                        href="{{ route('admin.task_answer.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-affiliate side-menu__icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275" />
                            <path d="M11.683 12.317l5.759 -5.759" />
                            <path d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                            <path d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                            <path d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                            <path d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0" />
                        </svg>
                        <span class="side-menu__label">Task Answer</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.daily_affirmation.*')" data-bs-toggle="slide"
                        href="{{ route('admin.daily_affirmation.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-bell-ringing side-menu__icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                            <path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" />
                            <path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" />
                        </svg>
                        <span class="side-menu__label">Daily Affirmation</span>
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
