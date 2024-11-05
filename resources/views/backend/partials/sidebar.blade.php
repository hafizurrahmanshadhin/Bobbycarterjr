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
                            xmlns:xlink="http://www.w3.org/1999/xlink" class="side-menu__icon" x="0" y="0"
                            viewBox="0 0 511 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve">
                            <g>
                                <path
                                    d="M498.7 222.695c-.016-.011-.028-.027-.04-.039L289.805 13.81C280.902 4.902 269.066 0 256.477 0c-12.59 0-24.426 4.902-33.332 13.809L14.398 222.55c-.07.07-.144.144-.21.215-18.282 18.386-18.25 48.218.09 66.558 8.378 8.383 19.44 13.235 31.273 13.746.484.047.969.07 1.457.07h8.32v153.696c0 30.418 24.75 55.164 55.168 55.164h81.711c8.285 0 15-6.719 15-15V376.5c0-13.879 11.293-25.168 25.172-25.168h48.195c13.88 0 25.168 11.29 25.168 25.168V497c0 8.281 6.715 15 15 15h81.711c30.422 0 55.168-24.746 55.168-55.164V303.14h7.719c12.586 0 24.422-4.903 33.332-13.813 18.36-18.367 18.367-48.254.027-66.633zm-21.243 45.422a17.03 17.03 0 0 1-12.117 5.024H442.62c-8.285 0-15 6.714-15 15v168.695c0 13.875-11.289 25.164-25.168 25.164h-66.71V376.5c0-30.418-24.747-55.168-55.169-55.168H232.38c-30.422 0-55.172 24.75-55.172 55.168V482h-66.71c-13.876 0-25.169-11.29-25.169-25.164V288.14c0-8.286-6.715-15-15-15H48a13.9 13.9 0 0 0-.703-.032c-4.469-.078-8.66-1.851-11.8-4.996-6.68-6.68-6.68-17.55 0-24.234.003 0 .003-.004.007-.008l.012-.012L244.363 35.02A17.003 17.003 0 0 1 256.477 30c4.574 0 8.875 1.781 12.113 5.02l208.8 208.796.098.094c6.645 6.692 6.633 17.54-.031 24.207zm0 0"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('admin.user.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 512 512.001"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <path
                                    d="M210.352 246.633c33.882 0 63.218-12.153 87.195-36.13 23.969-23.972 36.125-53.304 36.125-87.19 0-33.876-12.152-63.211-36.129-87.192C273.566 12.152 244.23 0 210.352 0c-33.887 0-63.22 12.152-87.192 36.125s-36.129 53.309-36.129 87.188c0 33.886 12.156 63.222 36.13 87.195 23.98 23.969 53.316 36.125 87.19 36.125zM144.379 57.34c18.394-18.395 39.973-27.336 65.973-27.336 25.996 0 47.578 8.941 65.976 27.336 18.395 18.398 27.34 39.98 27.34 65.972 0 26-8.945 47.579-27.34 65.977-18.398 18.399-39.98 27.34-65.976 27.34-25.993 0-47.57-8.945-65.973-27.34-18.399-18.394-27.344-39.976-27.344-65.976 0-25.993 8.945-47.575 27.344-65.973zM426.129 393.703c-.692-9.976-2.09-20.86-4.149-32.351-2.078-11.579-4.753-22.524-7.957-32.528-3.312-10.34-7.808-20.55-13.375-30.336-5.77-10.156-12.55-19-20.16-26.277-7.957-7.613-17.699-13.734-28.965-18.2-11.226-4.44-23.668-6.69-36.976-6.69-5.227 0-10.281 2.144-20.043 8.5a2711.03 2711.03 0 0 1-20.879 13.46c-6.707 4.274-15.793 8.278-27.016 11.903-10.949 3.543-22.066 5.34-33.043 5.34-10.968 0-22.086-1.797-33.043-5.34-11.21-3.622-20.3-7.625-26.996-11.899-7.77-4.965-14.8-9.496-20.898-13.469-9.754-6.355-14.809-8.5-20.035-8.5-13.313 0-25.75 2.254-36.973 6.7-11.258 4.457-21.004 10.578-28.969 18.199-7.609 7.281-14.39 16.12-20.156 26.273-5.558 9.785-10.058 19.992-13.371 30.34-3.2 10.004-5.875 20.945-7.953 32.524-2.063 11.476-3.457 22.363-4.149 32.363C.343 403.492 0 413.668 0 423.949c0 26.727 8.496 48.363 25.25 64.32C41.797 504.017 63.688 512 90.316 512h246.532c26.62 0 48.511-7.984 65.062-23.73 16.758-15.946 25.254-37.59 25.254-64.325-.004-10.316-.351-20.492-1.035-30.242zm-44.906 72.828c-10.934 10.406-25.45 15.465-44.38 15.465H90.317c-18.933 0-33.449-5.059-44.379-15.46-10.722-10.208-15.933-24.141-15.933-42.587 0-9.594.316-19.066.95-28.16.616-8.922 1.878-18.723 3.75-29.137 1.847-10.285 4.198-19.937 6.995-28.675 2.684-8.38 6.344-16.676 10.883-24.668 4.332-7.618 9.316-14.153 14.816-19.418 5.145-4.926 11.63-8.957 19.27-11.98 7.066-2.798 15.008-4.329 23.629-4.56 1.05.56 2.922 1.626 5.953 3.602 6.168 4.02 13.277 8.606 21.137 13.625 8.86 5.649 20.273 10.75 33.91 15.152 13.941 4.508 28.16 6.797 42.273 6.797 14.114 0 28.336-2.289 42.27-6.793 13.648-4.41 25.058-9.507 33.93-15.164 8.043-5.14 14.953-9.593 21.12-13.617 3.032-1.973 4.903-3.043 5.954-3.601 8.625.23 16.566 1.761 23.636 4.558 7.637 3.024 14.122 7.059 19.266 11.98 5.5 5.262 10.484 11.798 14.816 19.423 4.543 7.988 8.208 16.289 10.887 24.66 2.801 8.75 5.156 18.398 7 28.675 1.867 10.434 3.133 20.239 3.75 29.145v.008c.637 9.058.957 18.527.961 28.148-.004 18.45-5.215 32.38-15.937 42.582zm0 0"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Users</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.subscription.*')" data-bs-toggle="slide"
                        href="{{ route('admin.subscription.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 64 64"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
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
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 24 24"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g
                                transform="matrix(1.3799999999999981,0,0,1.3799999999999981,-4.749999999999993,-4.750024461746195)">
                                <path
                                    d="M6 21h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2zm-1-6a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1zm12-2a4 4 0 1 0 4 4 4 4 0 0 0-4-4zm0 7a3 3 0 1 1 3-3 3 3 0 0 1-3 3zm-7.39-8h5.78a1.892 1.892 0 0 0 1.563-2.956l-2.867-4.206a1.92 1.92 0 0 0-3.172 0l-2.867 4.2A1.892 1.892 0 0 0 9.61 12zm-.737-2.394L11.74 5.4a.92.92 0 0 1 1.52 0l2.867 4.206A.892.892 0 0 1 15.39 11H9.61a.893.893 0 0 1-.737-1.394z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Course Type</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('course.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 682.667 682.667"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <defs>
                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" fill="#000000" opacity="1"
                                            data-original="#000000"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                    <path
                                        d="M0 0h35c15.63 0 28.3-12.67 28.3-28.29v-276.95h-455.46v276.95c0 15.62 12.67 28.29 28.3 28.29h35"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(420.434 376.125)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0h-39.59v235.24h82.18"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(102.864 105.885)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0h82.18v-235.24h-315.87"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(366.554 341.125)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path
                                        d="M0 0h-53.905C-69.389 0-81.94 12.552-81.94 28.035v.847H28.035v-.847C28.035 12.552 15.483 0 0 0Z"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(282.957 42.006)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path
                                        d="M0 0h-497v-16.623c0-22.721 18.419-41.141 41.141-41.141h414.717C-18.42-57.764 0-39.344 0-16.623Z"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(504.504 70.889)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path
                                        d="M0 0v-42.247c0-25.237-15.071-48.139-38.375-57.826-46.145-19.179-98.205-19.179-144.349 0-23.305 9.687-38.376 32.589-38.376 57.826V0"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(366.554 347.584)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path
                                        d="m0 0 98.07-51.95c16.28-8.63 16.28-31.96 0-40.59l-145.03-76.83a42.892 42.892 0 0 0-40.12 0l-145.03 76.83c-16.28 8.63-16.28 31.96 0 40.59l145.03 76.83a42.892 42.892 0 0 0 40.12 0l20.76-11"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(323.024 469.015)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="m0 0 64.516-73.57v-99.694"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(256.004 396.769)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path
                                        d="m0 0-16.275-28.188c-5.872-10.173 1.468-22.888 13.214-22.888h6.122c11.745 0 19.086 12.715 13.213 22.888z"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(320.52 223.505)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0h150.146"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(100.627 140.885)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0h100.39"
                                        style="stroke-width:15;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(100.627 172.43)" fill="none" stroke="#000000"
                                        stroke-width="15" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                </g>
                            </g>
                        </svg>
                        <span class="side-menu__label">Course</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide"
                        href="{{ route('survay-questions.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink x="0" y="0" viewBox="0 0 511.975 511.975"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <path
                                    d="M211.711 403.625c-3.645-8.356-10.324-14.792-18.81-18.124-8.485-3.332-17.761-3.159-26.115.485-8.355 3.644-14.792 10.324-18.124 18.809-3.331 8.485-3.159 17.76.481 26.108l.091.21c3.645 8.356 10.324 14.792 18.811 18.124a34.091 34.091 0 0 0 12.481 2.379c4.633 0 9.26-.957 13.634-2.864 8.355-3.644 14.792-10.324 18.123-18.809 3.332-8.485 3.159-17.76-.481-26.108zm-13.39 20.835a19.001 19.001 0 0 1-10.157 10.542 19.008 19.008 0 0 1-14.638.271 19.01 19.01 0 0 1-10.63-10.36 18.992 18.992 0 0 1-.271-14.637 19.001 19.001 0 0 1 10.157-10.542 18.997 18.997 0 0 1 14.637-.271 18.997 18.997 0 0 1 10.539 10.15c2.124 4.729 2.261 10.022.363 14.847zM491.828 172.134a7.5 7.5 0 0 0-12.124 8.833c14.595 20.03 20.323 45.323 15.716 69.393-7.577 39.584-40.868 69.415-80.957 72.543-6.739.526-12.48 5.373-14.292 12.078l-2.919 10.907a19.019 19.019 0 0 1-8.915 11.62 18.994 18.994 0 0 1-14.514 1.907 18.986 18.986 0 0 1-11.614-8.909 18.997 18.997 0 0 1-1.908-14.517l2.92-10.917c5.981-22.315 25.376-38.512 48.26-40.304 22.952-1.792 42.017-18.893 46.362-41.589 4.757-24.888-9.751-49.797-33.742-57.939-13.521-4.597-28.192-3.132-40.429 3.253.692-6.696.824-13.513.323-20.396a115.017 115.017 0 0 0-3.159-19.632c18.121-5.692 37.607-5.548 55.571.548a88.347 88.347 0 0 1 19.973 9.733 7.495 7.495 0 0 0 10.383-2.167 7.5 7.5 0 0 0-2.168-10.383 103.309 103.309 0 0 0-23.367-11.387c-21.015-7.133-43.805-7.293-64.979-.621-16.15-40.875-54.888-70.588-100.548-73.578-57.464-3.772-109.029 35.516-121.345 90.772-26.086-14.16-57.154-16.74-85.182-6.647-51.299 18.482-80.005 73.998-65.355 126.37a103.997 103.997 0 0 0 4.884 13.735c3.645 8.356 10.324 14.792 18.809 18.123 8.484 3.331 17.757 3.158 26.114-.487 8.355-3.645 14.791-10.326 18.122-18.813s3.158-17.76-.485-26.108a37.604 37.604 0 0 1-1.712-4.802c-5.071-18.145 4.924-37.381 22.76-43.796 16.836-6.069 35.81 1.297 44.137 17.133 7.611 14.485 4.614 32.364-7.289 43.48-21.419 20.005-27.892 51.581-16.106 78.567l4.512 10.352c5.592 12.821 18.165 20.485 31.34 20.484 4.543 0 9.159-.912 13.583-2.838 8.354-3.645 14.791-10.326 18.122-18.813s3.158-17.76-.484-26.105l-4.512-10.364c-.246-.564-.129-1.147.137-1.394a104.071 104.071 0 0 0 8.788-9.294 7.5 7.5 0 1 0-11.519-9.608 88.601 88.601 0 0 1-7.503 7.936c-4.958 4.619-6.426 11.995-3.654 18.351l4.513 10.367a18.978 18.978 0 0 1 .272 14.63 19.004 19.004 0 0 1-10.152 10.543c-9.668 4.21-20.965-.227-25.181-9.89l-4.513-10.355c-9.247-21.176-4.185-45.934 12.597-61.607 16.827-15.715 21.074-40.971 10.328-61.422-11.792-22.428-38.664-32.86-62.496-24.267-25.189 9.06-39.3 36.27-32.12 61.963a52.876 52.876 0 0 0 2.404 6.745 18.981 18.981 0 0 1 .272 14.631 18.999 18.999 0 0 1-10.157 10.544c-4.683 2.043-9.88 2.14-14.635.273s-8.499-5.474-10.54-10.155a89.096 89.096 0 0 1-4.184-11.764c-12.548-44.86 12.046-92.402 55.988-108.233 25.715-9.26 54.437-6.046 77.704 8.493-.25 3.123-.391 6.26-.391 9.385 0 20.62 16.776 37.396 37.396 37.396l.105-.003c6.403 18.83 6.387 39.329-.174 58.312a7.5 7.5 0 0 0 14.178 4.899c7.452-21.562 7.663-44.807.769-66.305 13.236-5.764 22.517-18.966 22.517-34.3 0-1.966.136-3.932.402-5.846 2.989-21.418 22.342-37.07 44.049-35.637 20.505 1.343 37.093 17.805 38.586 38.293 1.367 18.739-9.989 36.18-27.616 42.413-30.647 10.835-51.239 40.073-51.239 72.754v12.681c0 20.62 16.775 37.396 37.395 37.396s37.396-16.776 37.396-37.396v-12.681c0-1.032.567-1.953 1.379-2.24 35.179-12.439 61.422-40.781 72.199-74.976 9.391-12.038 25.811-16.992 40.365-12.044 16.947 5.751 27.193 23.343 23.834 40.917-3.078 16.074-16.564 28.186-32.8 29.453-29.209 2.287-53.955 22.933-61.579 51.379l-2.92 10.915c-2.361 8.804-1.152 18.002 3.406 25.898 4.56 7.898 11.922 13.545 20.725 15.899a33.904 33.904 0 0 0 25.896-3.406c7.894-4.558 13.541-11.918 15.903-20.729l2.915-10.893c.169-.625.628-.992.973-1.019 46.81-3.652 85.679-38.472 94.523-84.677 5.383-28.131-1.296-57.672-18.327-81.044zM301.714 272.32c-6.806 2.406-11.379 8.99-11.379 16.382v12.681c0 12.349-10.047 22.396-22.396 22.396s-22.395-10.047-22.395-22.396v-12.681c0-26.337 16.572-49.891 41.239-58.612 23.982-8.48 39.435-32.185 37.577-57.646-2.034-27.913-24.633-50.341-52.562-52.17a56.667 56.667 0 0 0-3.743-.124c-27.964 0-52.249 20.732-56.145 48.655a57.426 57.426 0 0 0-.547 7.92c0 12.349-10.047 22.396-22.396 22.396-12.35 0-22.396-10.047-22.396-22.396 0-4.713.329-9.46.978-14.109 7.295-52.272 54.365-90.498 107.172-87.038 50.117 3.282 90.663 43.526 94.314 93.61 3.317 45.533-24.365 87.943-67.321 103.132zM367.158 384.292c-8.805-2.359-18.001-1.149-25.896 3.409s-13.542 11.917-15.896 20.704l-.062.231c-4.87 18.177 5.955 36.927 24.131 41.797a34.043 34.043 0 0 0 8.824 1.167c15.066 0 28.894-10.072 32.978-25.313l.053-.198c2.36-8.805 1.149-18.002-3.408-25.897-4.56-7.893-11.919-13.54-20.724-15.9zm9.639 37.931-.053.198c-2.73 10.188-13.24 16.254-23.427 13.525-10.188-2.73-16.255-13.239-13.53-23.408 1.285-5.025 4.479-9.254 8.975-11.845a19 19 0 0 1 14.514-1.911 19 19 0 0 1 11.614 8.912c2.554 4.424 3.233 9.579 1.907 14.529z"
                                    fill="#000000" opacity="1" data-original="#000000"></path>
                                <path
                                    d="M267.939 352.694c-20.62 0-37.395 16.776-37.395 37.396v.248c0 20.62 16.775 37.396 37.395 37.396s37.396-16.776 37.396-37.396v-.248c0-20.621-16.776-37.396-37.396-37.396zm22.396 37.643c0 12.349-10.047 22.396-22.396 22.396s-22.395-10.047-22.395-22.396v-.248c0-12.349 10.047-22.396 22.395-22.396 12.349 0 22.396 10.047 22.396 22.396z"
                                    fill="#000000" opacity="1" data-original="#000000"></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Survay Questions</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.course.module.*')" data-bs-toggle="slide"
                        href="{{ route('admin.course.module.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 682.667 682.667"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <defs>
                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" fill="#000000" opacity="1"
                                            data-original="#000000"></path>
                                    </clipPath>
                                    <clipPath id="b" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" fill="#000000" opacity="1"
                                            data-original="#000000"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                    <path d="M0 0v-163.589l122.938-54.941v154.663"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(10.123 228.53)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0v-154.663l122.938 54.941V63.867"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(133.061 164.663)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="m0 0-122.938 54.941L0 109.881l122.938-54.94Z"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(133.061 173.589)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0v-163.589l122.938-54.941v154.663"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(256 228.53)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="M0 0v-154.663l122.938 54.941V63.867"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(378.938 164.663)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                    <path d="m0 0-122.938 54.941L0 109.881l122.938-54.94Z"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(378.938 173.589)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                </g>
                                <path d="M0 0v-163.589l122.938-54.941"
                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                    transform="matrix(1.33333 0 0 -1.33333 177.415 86.587)" fill="none"
                                    stroke="#000000" stroke-width="20" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none"
                                    stroke-opacity="" data-original="#000000"></path>
                                <path d="m0 0 122.938 54.941V218.53"
                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                    transform="matrix(1.33333 0 0 -1.33333 341.333 377.96)" fill="none"
                                    stroke="#000000" stroke-width="20" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none"
                                    stroke-opacity="" data-original="#000000"></path>
                                <g clip-path="url(#b)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                    <path d="m0 0-122.938 54.94L0 109.881 122.938 54.94Z"
                                        style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(256 392.119)" fill="none" stroke="#000000"
                                        stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000"></path>
                                </g>
                                <path d="M0 0v-28.272"
                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                    transform="matrix(1.33333 0 0 -1.33333 341.333 161.73)" fill="none"
                                    stroke="#000000" stroke-width="20" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none"
                                    stroke-opacity="" data-original="#000000"></path>
                                <path d="M0 0v-50.794"
                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                    transform="matrix(1.33333 0 0 -1.33333 341.333 319.977)" fill="none"
                                    stroke="#000000" stroke-width="20" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none"
                                    stroke-opacity="" data-original="#000000"></path>
                                <path d="M0 0v0"
                                    style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                    transform="matrix(1.33333 0 0 -1.33333 341.333 259.457)" fill="none"
                                    stroke="#000000" stroke-width="20" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="none"
                                    stroke-opacity="" data-original="#000000"></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Course Module</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.article.*')" data-bs-toggle="slide"
                        href="{{ route('admin.article.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 100 100"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <path
                                    d="M23.42 92.06a6.11 6.11 0 0 0 5.83 4.33 6.22 6.22 0 0 0 1.75-.25l39.62-11.93 7.13-.93A6.08 6.08 0 0 0 83 76.46l-3.76-28.7L91.08 29.6 94 25.19 95.4 23a6.77 6.77 0 0 0-11.34-7.41l-1.44 2.21-2.88 4.4-3.23 4.94L74.1 8.79a6.08 6.08 0 0 0-6.82-5.24L25.2 9.08a6.06 6.06 0 0 0-5.27 6.42l-12.1 3.64a6.08 6.08 0 0 0-4.07 7.57zm60.89-71.37 3.16 2.06 3.15 2.06-1.24 1.9-6.31-4.12zm2.26-3.47a3.77 3.77 0 0 1 6.32 4.13l-.62.95L86 18.17zm-5.14 7.88 3.16 2.06 3.15 2.06L68.49 58.7l-3.16-2.06-3.15-2.06zm-23 40.31.6-1.92a4.74 4.74 0 0 1 2.54 1.66l-1.52 1.32a1 1 0 0 1-1.62-1.06zm5.4-2.23a7.65 7.65 0 0 0-3.92-2.56l1-3.27 5.49 3.59zM23.54 13.23a3.09 3.09 0 0 1 2.05-1.18l42.08-5.52a2.83 2.83 0 0 1 .41 0 3.09 3.09 0 0 1 3 2.68L74 31l-7.66 11.71-15.06 2a1.5 1.5 0 0 0 .19 3h.2L64.18 46l-5.33 8.17a.93.93 0 0 0 0 .1.88.88 0 0 0-.09.2l-.93 3-21.32 2.87a1.5 1.5 0 0 0 .2 3h.19l19.87-2.6-1.18 3.82a4 4 0 0 0 1.63 4.53 4 4 0 0 0 2.19.66 4 4 0 0 0 2.62-1l7.88-6.82.08-.09a1 1 0 0 0 .16-.19l6.52-10L80 76.85a3.07 3.07 0 0 1-.61 2.28 3 3 0 0 1-2 1.17l-42.12 5.53a3.08 3.08 0 0 1-3.45-2.66l-8.89-67.66a3.09 3.09 0 0 1 .61-2.28zM8.7 22l11.6-3.49 8.54 65.05a6.09 6.09 0 0 0 6 5.29 5.39 5.39 0 0 0 .8-.06l16.48-2.16-22 6.62a3.07 3.07 0 0 1-3.82-2.05L6.63 25.85A3.09 3.09 0 0 1 8.7 22zm30.24-1.6a1.5 1.5 0 0 1 1.29-1.68l24-3.16a1.5 1.5 0 0 1 .39 3l-24 3.15h-.19a1.51 1.51 0 0 1-1.49-1.31zm-7.26 14.66A1.5 1.5 0 0 1 33 33.38L66 29a1.5 1.5 0 0 1 .39 3l-33.03 4.36h-.19a1.51 1.51 0 0 1-1.49-1.3zM42.89 47.3A1.5 1.5 0 0 1 41.6 49l-6.47.85h-.19a1.5 1.5 0 0 1-.2-3l6.47-.85a1.5 1.5 0 0 1 1.68 1.3zM37 75.5a1.5 1.5 0 0 1 1.29-1.68l11.51-1.51a1.5 1.5 0 1 1 .4 3l-11.53 1.48h-.19A1.5 1.5 0 0 1 37 75.5z"
                                    data-name="Layer 9 copy" fill="#000000" opacity="1" data-original="#000000"
                                    class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Course Article</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.task_answer.*')" data-bs-toggle="slide"
                        href="{{ route('admin.task_answer.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 4000 4000"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g
                                transform="matrix(1.4099999999999973,0,0,1.4099999999999973,-819.9999749755834,-819.9999249267557)">
                                <path
                                    d="M1651.101 1751.901c-27.171-26.159-58.692-46.346-93.688-59.998-36.347-14.18-74.743-20.612-114.129-19.117-68.782 2.614-134.545 30.83-185.174 79.449-50.683 48.67-81.481 113.264-86.721 181.875-3.36 43.894 3.078 86.631 19.135 127.026 8.906 22.406 34.29 33.348 56.694 24.442 22.406-8.906 33.349-34.289 24.443-56.694-11.106-27.938-15.552-57.583-13.214-88.118 7.455-97.617 90.101-177.004 188.151-180.731 54.013-2.048 105.135 17.399 143.945 54.765 38.831 37.385 60.215 87.653 60.215 141.545 0 40.529-53.003 105.726-138.328 170.147-31.719 23.949-57.778 55.738-75.361 91.929-17.284 35.573-26.419 75.455-26.419 115.331v39.138c0 24.11 19.545 43.656 43.656 43.656 24.11 0 43.656-19.546 43.656-43.656v-39.138c0-54.433 25.077-105.864 67.081-137.579 78.935-59.598 173.028-149.583 173.028-239.828 0-39.243-7.873-77.261-23.399-112.998-14.987-34.496-36.376-65.264-63.571-91.446z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <circle cx="1454.298" cy="2567.526" r="65.484" fill="#000000" opacity="1"
                                    data-original="#000000" class=""></circle>
                                <path
                                    d="M2152.797 1323.334h-531.706c19.28-30.976 51.488-91.859 51.488-152.797 0-58.311-22.707-113.129-63.937-154.355-41.227-41.223-96.041-63.926-154.344-63.926s-113.118 22.703-154.344 63.926c-41.23 41.226-63.936 96.044-63.936 154.355 0 60.935 32.203 121.813 51.486 152.797H755.8c-84.252 0-152.796 68.544-152.796 152.796v531.841c0 31.703 17.206 60.947 44.904 76.32 27.672 15.357 61.552 14.495 88.413-2.248 38.575-24.034 78.497-38.383 106.792-38.383 72.216 0 130.968 58.752 130.968 130.968 0 72.217-58.752 130.969-130.968 130.969-28.304 0-68.221-14.354-106.785-38.401-26.864-16.745-60.742-17.605-88.413-2.248-27.703 15.376-44.911 44.618-44.911 76.315v531.863c0 84.252 68.544 152.797 152.796 152.797h531.704c-19.282 30.967-51.486 91.829-51.486 152.797 0 120.36 97.92 218.28 218.28 218.28s218.281-97.92 218.281-218.28c0-60.966-32.206-121.831-51.487-152.797h531.705c84.252 0 152.796-68.545 152.796-152.797v-531.863c0-31.697-17.209-60.938-44.91-76.314-27.671-15.359-61.551-14.498-88.422 2.251-38.557 24.043-78.474 38.397-106.776 38.397-72.216 0-130.969-58.752-130.969-130.969 0-72.216 58.753-130.968 130.969-130.968 28.294 0 68.216 14.349 106.783 38.379 26.87 16.746 60.75 17.611 88.421 2.251 27.698-15.373 44.904-44.617 44.904-76.319V1476.13c0-84.252-68.544-152.796-152.796-152.796zm65.483 684.5c-30.976-19.279-91.858-51.486-152.796-51.486-58.304 0-113.118 22.702-154.345 63.925-41.23 41.227-63.937 96.044-63.937 154.354 0 120.36 97.92 218.281 218.281 218.281 60.963 0 121.834-32.223 152.796-51.51v531.727c0 36.108-29.376 65.484-65.483 65.484h-531.864c-31.69 0-60.926 17.204-76.298 44.898-15.359 27.674-14.497 61.557 2.252 88.427 24.032 38.552 38.379 78.471 38.379 106.784 0 72.216-58.752 130.968-130.968 130.968s-130.968-58.752-130.968-130.968c0-28.314 14.347-68.233 38.379-106.785 16.749-26.869 17.611-60.753 2.251-88.426-15.372-27.694-44.607-44.898-76.298-44.898H755.8c-36.108 0-65.484-29.376-65.484-65.484v-531.727c30.974 19.293 91.841 51.51 152.796 51.51 120.36 0 218.281-97.921 218.281-218.281 0-58.311-22.707-113.128-63.937-154.354-41.227-41.223-96.041-63.925-154.344-63.925-60.931 0-121.81 32.201-152.796 51.486V1476.13c0-36.108 29.376-65.484 65.484-65.484h531.862c31.69 0 60.926-17.204 76.297-44.898 15.36-27.673 14.498-61.556-2.247-88.42-24.035-38.574-38.383-78.496-38.383-106.791 0-72.216 58.752-130.968 130.968-130.968s130.968 58.752 130.968 130.968c0 28.294-14.349 68.215-38.38 106.784-16.749 26.87-17.611 60.753-2.251 88.427 15.372 27.694 44.607 44.898 76.297 44.898h531.864c36.107 0 65.483 29.376 65.483 65.484v531.704z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M3178.716 1192.358c-60.935 0-121.813 32.204-152.797 51.488v-488.05c0-84.252-68.544-152.796-152.796-152.796h-488.208c-31.689 0-60.925 17.204-76.297 44.897-15.359 27.673-14.498 61.556 2.246 88.421 24.035 38.575 38.385 78.497 38.385 106.791 0 72.216-58.752 130.968-130.969 130.968-72.216 0-130.968-58.752-130.968-130.968 0-28.294 14.349-68.216 38.38-106.785 16.748-26.87 17.61-60.753 2.251-88.426-15.372-27.694-44.607-44.898-76.298-44.898h-488.207c-84.252 0-152.796 68.544-152.796 152.796v65.484c0 24.111 19.545 43.656 43.656 43.656s43.656-19.545 43.656-43.656v-65.484c0-36.108 29.376-65.484 65.484-65.484h488.049C2032.208 721.288 2000 782.17 2000 843.109c0 120.36 97.92 218.28 218.28 218.28s218.281-97.92 218.281-218.28c0-60.934-32.204-121.814-51.488-152.797h488.05c36.107 0 65.483 29.376 65.483 65.484v488.207c0 31.69 17.204 60.926 44.897 76.297 27.673 15.36 61.557 14.498 88.421-2.247 38.575-24.035 78.497-38.384 106.791-38.384 72.216 0 130.968 58.752 130.968 130.968s-58.752 130.968-130.968 130.968c-28.294 0-68.216-14.349-106.785-38.38-26.87-16.748-60.754-17.61-88.426-2.25-27.694 15.371-44.898 44.606-44.898 76.297v488.207c0 36.108-29.376 65.484-65.483 65.484h-436.562c-24.11 0-43.656 19.546-43.656 43.656s19.546 43.656 43.656 43.656h436.562c84.252 0 152.796-68.544 152.796-152.797V1577.43c30.976 19.279 91.858 51.487 152.797 51.487 120.36 0 218.28-97.92 218.28-218.281s-97.92-218.278-218.28-218.278z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Task Answer</span>
                    </a>
                </li>

                <li class="slide">
                    <a class="side-menu__item has-link @activeRoute('admin.daily_affirmation.*')" data-bs-toggle="slide"
                        href="{{ route('admin.daily_affirmation.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 64 64"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <path
                                    d="M17.11 62a1 1 0 0 1-.87-1.49l2.08-3.67c1.72-3.05 1.79-6.72.19-9.83l-5.85-11.35c-.07-.12-.14-.26-.2-.41a1 1 0 0 1 1.84-.78c.04.09.08.17.13.25l5.86 11.37c1.91 3.71 1.82 8.09-.23 11.73l-2.08 3.67c-.18.32-.52.51-.87.51zM41.55 62c-.55 0-1-.45-1-1v-5c0-1.1.91-2 2.02-2h3.69c.75 0 1.45-.26 1.97-.73.08-.07.15-.13.22-.21a.997.997 0 1 1 1.48 1.34c-.11.12-.24.24-.36.35-.89.8-2.07 1.25-3.31 1.25h-3.69l-.02 5c0 .55-.45 1-1 1zM52.24 50.7a1 1 0 0 1-.87-1.49c2.88-5.12 3.44-11.23 3.45-11.29.04-.52.48-.91 1-.91h4.17l-4.42-6.28c-.7-1-1.01-2.23-.88-3.45.08-.71.13-1.47.13-2.27 0-11.58-9.6-21-21.4-21h-.25c-.54.05-1.04-.36-1.08-.91s.36-1.04.91-1.08c.14-.01.29-.01.43-.01 12.9 0 23.4 10.32 23.4 23 0 .87-.05 1.71-.14 2.5-.08.73.1 1.47.53 2.07l4.44 6.29c.43.61.48 1.4.13 2.06-.35.67-1.03 1.08-1.79 1.08h-3.28c-.27 1.99-1.14 6.85-3.59 11.19-.18.33-.52.51-.87.51z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M33.91 36c-4.41 0-6.52-1.86-8.38-3.5-.13-.12-.26-.23-.39-.35-1.65.43-3.37.65-5.13.65-9.93 0-18-6.91-18-15.4 0-4.01 1.78-7.79 5.01-10.65a.99.99 0 0 1 1.41.09c.37.41.33 1.05-.08 1.41-2.79 2.48-4.33 5.73-4.33 9.15 0 7.39 7.18 13.4 16 13.4 1.76 0 3.48-.24 5.1-.71.32-.09.66-.02.92.19.28.23.55.47.83.72 1.43 1.26 2.79 2.46 5.24 2.86-.94-1.76-2.08-4.41-1.56-6.13.06-.2.18-.37.34-.5 3.31-2.58 5.13-6.07 5.13-9.83 0-7.39-7.18-13.4-16-13.4-3.02 0-5.97.71-8.52 2.06-.49.26-1.09.07-1.35-.42s-.07-1.09.42-1.35c2.84-1.5 6.11-2.3 9.46-2.3 9.93 0 18 6.91 18 15.4 0 4.21-2.04 8.27-5.61 11.17-.12 1.34 1.26 4.17 2.36 5.88.2.31.21.7.04 1.02-.18.32-.51.52-.88.52z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                                <path
                                    d="M20 25.5c-1.86 0-3.61-.87-4.79-2.38-.34-.44-.26-1.06.17-1.4s1.06-.26 1.4.17c.8 1.03 1.97 1.62 3.21 1.62s2.41-.59 3.21-1.61c.34-.44.97-.52 1.4-.17.44.34.51.97.17 1.4-1.18 1.52-2.93 2.39-4.79 2.39zM15 16.5c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1-1-.45-1-1c0-1.65 1.35-3 3-3s3 1.35 3 3c0 .55-.45 1-1 1zM29 16.5c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1-1-.45-1-1c0-1.65 1.35-3 3-3s3 1.35 3 3c0 .55-.45 1-1 1z"
                                    fill="#000000" opacity="1" data-original="#000000" class=""></path>
                            </g>
                        </svg>
                        <span class="side-menu__label">Daily Affirmation</span>
                    </a>
                </li>

                <hr>
                <li class="slide {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 682.667 682.667"
                            style="enable-background:new 0 0 512 512" xml:space="preserve" class="side-menu__icon">
                            <g>
                                <defs>
                                    <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                        <path d="M0 512h512V0H0Z" fill="#000000" opacity="1"
                                            data-original="#000000"></path>
                                    </clipPath>
                                </defs>
                                <g clip-path="url(#a)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
                                    <path
                                        d="M0 0c-43.446 0-78.667-35.22-78.667-78.667 0-43.446 35.221-78.666 78.667-78.666 43.446 0 78.667 35.22 78.667 78.666C78.667-35.22 43.446 0 0 0Zm220.802-22.53-21.299-17.534c-24.296-20.001-24.296-57.204 0-77.205l21.299-17.534c7.548-6.214 9.497-16.974 4.609-25.441l-42.057-72.845c-4.889-8.467-15.182-12.159-24.337-8.729l-25.835 9.678c-29.469 11.04-61.688-7.561-66.862-38.602l-4.535-27.213c-1.607-9.643-9.951-16.712-19.727-16.712h-84.116c-9.776 0-18.12 7.069-19.727 16.712l-4.536 27.213c-5.173 31.041-37.392 49.642-66.861 38.602l-25.834-9.678c-9.156-3.43-19.449.262-24.338 8.729l-42.057 72.845c-4.888 8.467-2.939 19.227 4.609 25.441l21.3 17.534c24.295 20.001 24.295 57.204 0 77.205l-21.3 17.534c-7.548 6.214-9.497 16.974-4.609 25.441l42.057 72.845c4.889 8.467 15.182 12.159 24.338 8.729l25.834-9.678c29.469-11.04 61.688 7.561 66.861 38.602l4.536 27.213c1.607 9.643 9.951 16.711 19.727 16.711h84.116c9.776 0 18.12-7.068 19.727-16.711l4.535-27.213c5.174-31.041 37.393-49.642 66.862-38.602l25.835 9.678c9.155 3.43 19.448-.262 24.337-8.729l42.057-72.845c4.888-8.467 2.939-19.227-4.609-25.441z"
                                        style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                        transform="translate(256 334.666)" fill="none" stroke="#000000"
                                        stroke-width="40" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-miterlimit="10" stroke-dasharray="none" stroke-opacity=""
                                        data-original="#000000" class=""></path>
                                </g>
                            </g>
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
