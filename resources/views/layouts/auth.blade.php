<!DOCTYPE html>
@php
    use App\Models\Utility;

    $setting = Utility::settings();
    $company_logo = $setting['company_logo_dark'] ?? '';
    $company_logos = $setting['company_logo_light'] ?? '';
    $company_favicon = $setting['company_favicon'] ?? '';

    $logo = \App\Models\Utility::get_file('uploads/logo/');

    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    if(isset($setting['color_flag']) && $setting['color_flag'] == 'true')
    {
        $themeColor = 'custom-color';
    }
    else {
        $themeColor = $color;
    }

    $company_logo = \App\Models\Utility::GetLogo();
    $SITE_RTL = isset($setting['SITE_RTL']) ? $setting['SITE_RTL'] : 'off';

    $lang = \App::getLocale('lang');
    if ($lang == 'ar' || $lang == 'he') {
        $SITE_RTL = 'on';
    }
    elseif($SITE_RTL == 'on')
    {
        $SITE_RTL = 'on';
    }
    else {
        $SITE_RTL = 'off';
    }

    $metatitle = isset($setting['meta_title']) ? $setting['meta_title'] : '';
    $metsdesc = isset($setting['meta_desc']) ? $setting['meta_desc'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($setting['meta_image']) ? $setting['meta_image'] : '';
    $get_cookie = isset($setting['enable_cookie']) ? $setting['enable_cookie'] : '';

@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    <title>
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'ERPGO') }}
        - @yield('page-title')</title>

    <meta name="title" content="{{ $metatitle }}">
    <meta name="description" content="{{ $metsdesc }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $metatitle }}">
    <meta property="og:description" content="{{ $metsdesc }}">
    <meta property="og:image" content="{{ $meta_image . $meta_logo }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $metatitle }}">
    <meta property="twitter:description" content="{{ $metsdesc }}">
    <meta property="twitter:image" content="{{ $meta_image . $meta_logo }}">


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="WorkDo" />

    <!-- Favicon icon -->
    <link rel="icon"
        href="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')  . '?' . time() }}"
        type="image/x-icon" />

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- vendor css -->

    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
    @endif

    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @endif

    @if ($SITE_RTL != 'on' && $setting['cust_darklayout'] != 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif


    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-auth-rtl.css') }}" id="main-style-link">
        @else
        <link rel="stylesheet" href="{{ asset('assets/css/custom-auth.css') }}" id="main-style-link">
    @endif

    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-auth-dark.css') }}" id="main-style-link">
    @endif

    <style>
        :root {
            --color-customColor: <?= $color ?>;
        }
        
        body {
            /* overflow-y: auto; */
            /* max-height: 90vh; */
            margin: 0;
            padding: 0;
            /* background: #f2f4f7; */
        }
        
        .login-container {
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            /* display: flex; */
            /* align-items: center; */
            /* justify-content: center; */
            /* padding: 2rem 0; */
            /* margin: 50px; */
        }

        /* Original desktop styles */
        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 1200px;
            background-color: #f2f4f7;
            border-radius: 15px;
            padding: 50px;
        }

        .flex-div {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .name-content {
            margin-right: 7rem;
        }

        .name-content .logo {
            font-size: 3.5rem;
            color: #0CAF60;
        }

        .name-content p {
            font-size: 1.3rem;
            font-weight: 500;
            margin-bottom: 5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            background: #fff;
            padding: 2rem;
            width: 530px;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgb(0 0 0 / 10%), 0 8px 16px rgb(0 0 0 / 10%);
        }

        form input,
        form label {
            font-size: 1.1rem;
        }

        form input {
            outline: none;
            padding: 0.8rem 1rem;
            margin-bottom: 0.8rem;
            border: 1px solid #ddd;
        }

        form input:focus {
            border: 1.8px solid #1877f2;
        }

        form .btn-primary {
            outline: none;
            border: none;
            background: #0CAF60;
            padding: 0.8rem 1rem;
            border-radius: 0.4rem;
            font-size: 1.1rem;
            color: #fff;
        }

        form .btn-primary:hover {
            background: #099e54;
            cursor: pointer;
        }

        form a {
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
            padding-top: 0.8rem;
            color: #1877f2;
        }

        .form-check-label {
            font-size: 0.95rem;
        }

        .invalid-feedback,
        .error {
            font-size: 0.95rem;
            color: #dc3545;
        }

        .form-check-input[type="checkbox"] {
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
            border: 2px solid #0CAF60;
            background-color: #fff;
            transition: background 0.2s, border-color 0.2s;
            margin-top: 0.2em;
            cursor: pointer;
        }

        .form-check-input[type="checkbox"]:checked {
            background-color: #0CAF60;
            border-color: #0CAF60;
        }

        .form-check-input[type="checkbox"]:focus {
            outline: none;
            box-shadow: 0 0 0 2px #b7f5d0;
        }

        .form-check-label {
            margin-left: 0.5em;
            font-size: 1rem;
            cursor: pointer;
            user-select: none;
            color: #333;
        }

        .form-check-label a {
            color: #0CAF60 !important;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .form-check-label a:hover,
        .form-check-label a:focus {
            color: #099e54 !important;
        }

        .form-check.custom-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        /* Tablet Styles (matches your original media query) */
        @media (max-width: 1200px) {
            .content {
                position: relative;
                top: auto;
                left: auto;
                transform: none;
                width: 100%;
                padding: 2rem;
                box-sizing: border-box;
            }
            
            .flex-div {
                flex-direction: column;
                justify-content: center;
            }
            
            .name-content {
                margin: 0 0 3rem 0;
                text-align: center;
            }
            
            .name-content p {
                margin-bottom: 2rem;
            }
            
            form {
                width: 450px;
                max-width: 100%;
            }
        }

        /* Mobile Styles */
        @media (max-width: 576px) {
            .name-content .logo {
                font-size: 2.5rem;
            }
            
            .name-content p {
                font-size: 1.1rem;
            }
            
            form {
                padding: 1.5rem;
            }
            
            form input,
            form label {
                font-size: 1rem;
            }
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/custom-color.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>

<body class="{{ $themeColor }}">
    <div class="custom-login">
        <!-- <div class="login-bg-img">
            <img src="{{ isset($setting['color_flag']) && $setting['color_flag'] == 'false' ? asset('assets/images/auth/'.$color.'.svg') : asset('assets/images/auth/theme-3.svg') }}" class="login-bg-1">
            <img src="{{ asset('assets/images/auth/common.svg') }}" class="login-bg-2">
        </div> -->
        <!-- <div class="bg-login bg-primary"></div> -->
        <div class="custom-login-inner">
            <!-- <header class="dash-header">
                <nav class="navbar navbar-expand-md default">
                    <div class="container">
                        <div class="navbar-brand">

                        <a class="navbar-brand" href="#">
                            @if ($setting['cust_darklayout'] == 'on')
                                <img class="logo"
                                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png') . '?' . time() }}"
                                    alt="" loading="lazy"/>
                            @else
                                <img class="logo"
                                    src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?' . time() }}"
                                    alt="" loading="lazy"/>
                            @endif
                        </a>


                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarlogin">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarlogin">
                            <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                                @include('landingpage::layouts.buttons')
                                @yield('language-bar')
                            </ul>
                        </div>
                    </div>
                </nav>
            </header> -->
            <main class="custom-wrapper">
                <div class="custom-row">
                    <div class="card">
                        @yield('content')
                    </div>
                </div>
            </main>
            <!-- <footer>
                <div class="auth-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span>&copy; {{ date('Y') }}
                                    {{ App\Models\Utility::getValByName('footer_text') ? App\Models\Utility::getValByName('footer_text') : config('app.name', 'Storego Saas') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>

    @if ($get_cookie == 'on')
        @include('layouts.cookie_consent')
    @endif

    <!-- [ auth-signup ] end -->

    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>


    <script>
        feather.replace();
    </script>

    @if (\App\Models\Utility::getValByName('cust_darklayout') == 'on')
        <style>
            .g-recaptcha {
                filter: invert(1) hue-rotate(180deg) !important;
            }
        </style>
    @endif


    <script>
        feather.replace();
        var pctoggle = document.querySelector("#pct-toggler");
        if (pctoggle) {
            pctoggle.addEventListener("click", function() {
                if (
                    !document.querySelector(".pct-customizer").classList.contains("active")
                ) {
                    document.querySelector(".pct-customizer").classList.add("active");
                } else {
                    document.querySelector(".pct-customizer").classList.remove("active");
                }
            });
        }

        var themescolors = document.querySelectorAll(".themes-color > a");
        for (var h = 0; h < themescolors.length; h++) {
            var c = themescolors[h];

            c.addEventListener("click", function(event) {
                var targetElement = event.target;
                if (targetElement.tagName == "SPAN") {
                    targetElement = targetElement.parentNode;
                }
                var temp = targetElement.getAttribute("data-value");
                removeClassByPrefix(document.querySelector("body"), "theme-");
                document.querySelector("body").classList.add(temp);
            });
        }
        function removeClassByPrefix(node, prefix) {
            for (let i = 0; i < node.classList.length; i++) {
                let value = node.classList[i];
                if (value.startsWith(prefix)) {
                    node.classList.remove(value);
                }
            }
        }
    </script>
    @stack('custom-scripts')

</body>

</html>
