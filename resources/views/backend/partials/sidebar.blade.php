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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor"
                            class="icon icon-tabler icons-tabler-filled icon-tabler-trophy side-menu__icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z"
                                fill="#000000" />
                        </svg>
                        <span class="side-menu__label">Subscription</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('course-type.index.*')" data-bs-toggle="slide"
                        href="{{ route('course-type.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-olympics">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 9m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M18 9m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M12 9m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M9 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
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

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.article.*')" data-bs-toggle="slide"
                        href="{{ route('admin.article.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-news">
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
