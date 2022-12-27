<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full antialiased">
<head>
    {!! Meta::toHtml() !!}
    <meta charset="utf-8" />
    <meta name="description" content="Site description" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="/favicon.ico" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Site title" />
    <meta property="og:description" content="Site description" />
    <meta property="og:image" content="http://via.placeholder.com/1200x630.jpg" />
    <meta property="og:url" content="" />
    <meta name="twitter:card" content="summary_large_image" />
    <!-- <script src="https://polyfill.io/v3/polyfill.min.js" defer></script>1.1875 -->

    <script type="module" crossorigin src="/assets/js/app.js"></script>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/assets/css/app.css" />

    @yield('header-scripts')
    @yield('header-css')

</head>
<body>
<body class="h-full bg-white font-brand text-base leading-tighter text-primary-500">
<div id="app" class="contents">
    <div class="flex min-h-full flex-col">
        @include('layouts.partials.header')
        <main class="grow">
            <section class="account container mt-4 pb-32 md:mt-5">
                @include('layouts.partials.topbar')
                <div class="lg:flex">
                    @include('layouts.partials.menu')
                    <div class="min-w-0 grow">
                        @section('main')

                        @show
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer section -->
        @include('layouts.partials.footer')
    </div>
</div>

@yield('footer-scripts')
</body>
