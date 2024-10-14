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
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 512 512"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <path
                                    d="m498.147 222.58-57.298-57.298V15c0-8.284-6.716-15-15-15h-64.267c-8.284 0-15 6.716-15 15v56.017l-57.174-57.174C280.482 4.916 268.614 0 255.99 0c-12.625 0-24.494 4.916-33.42 13.843L13.832 222.582c-18.428 18.427-18.428 48.411 0 66.838 8.927 8.927 20.795 13.843 33.419 13.843 2.645 0 5.253-.229 7.812-.651v154.223c0 30.419 24.748 55.166 55.167 55.166h97.561c8.284 0 15-6.716 15-15V383.467h66.4V497c0 8.284 6.716 15 15 15h97.56c30.419 0 55.166-24.747 55.166-55.166V302.611c2.558.423 5.165.651 7.81.651h.003c12.622 0 24.49-4.916 33.419-13.844 8.926-8.926 13.842-20.794 13.843-33.418-.002-12.624-4.918-24.493-13.845-33.42zM376.583 30h34.267v105.283l-34.267-34.268zm25.167 452h-82.56V368.467c0-8.284-6.716-15-15-15h-96.4c-8.284 0-15 6.716-15 15V482h-82.561c-13.877 0-25.167-11.289-25.167-25.166V285.025L255.99 114.101l170.926 170.926v171.808c0 13.876-11.289 25.165-25.166 25.165zm75.186-213.795a17.155 17.155 0 0 1-12.208 5.058 17.156 17.156 0 0 1-12.204-5.055l-.004-.004L266.597 82.281c-5.856-5.859-15.354-5.857-21.213 0L59.459 268.203l-.005.005c-3.26 3.26-7.593 5.055-12.203 5.055s-8.945-1.795-12.206-5.056c-6.73-6.73-6.73-17.682 0-24.412L243.783 35.056A17.152 17.152 0 0 1 255.99 30c4.61 0 8.945 1.796 12.205 5.056l82.781 82.78 125.958 125.957c6.731 6.73 6.731 17.683.002 24.412z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.subscription.*')" data-bs-toggle="slide"
                        href="{{ route('admin.subscription.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" class="side-menu__icon" x="0" y="0"
                            viewBox="0 0 64 64" style="enable-background:new 0 0 512 512" xml:space="preserve">
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
                            class="icon icon-tabler icons-tabler-outline icon-tabler-hexagons">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 18v-5l4 -2l4 2v5l-4 2z" />
                            <path d="M8 11v-5l4 -2l4 2v5" />
                            <path d="M12 13l4 -2l4 2v5l-4 2l-4 -2" />
                        </svg>
                        <span class="side-menu__label">Course Module</span>
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
