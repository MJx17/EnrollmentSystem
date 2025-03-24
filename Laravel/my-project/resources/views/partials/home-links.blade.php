<!-- resources/views/components/header.blade.php -->
<header class="main-header clearfix" role="header">
    <div class="logo">
        <a href="{{ route('home') }}"><em>Grad</em> School</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>

    @if (Route::currentRouteName() != 'login')
        <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
                <!-- Home Link -->
                <li>
                    <a href="{{ Route::currentRouteName() == 'home' ? '#section1' : route('home') }}">Home</a>
                </li>

                <!-- About Us Submenu -->
                <li class="has-submenu">
                    <a href="{{ Route::currentRouteName() == 'home' ? '#section2' : route('about') }}">About Us</a>
                    <ul class="sub-menu">
                        <li><a href="{{ Route::currentRouteName() == 'home' ? '#section2' : route('who_we_are') }}">Who we are?</a></li>
                        <li><a href="{{ Route::currentRouteName() == 'home' ? '#section3' : route('what_we_do') }}">What we do?</a></li>
                        <li><a href="{{ Route::currentRouteName() == 'home' ? '#section3' : route('how_it_works') }}">How it works?</a></li>
                        <li><a href="https://templatemo.com/about" rel="sponsored" class="external">External URL</a></li>
                    </ul>
                </li>

                <!-- Other Links -->
                <li><a href="{{ Route::currentRouteName() == 'home' ? '#section4' : route('courses') }}">Courses</a></li>
                <li><a href="{{ Route::currentRouteName() == 'home' ? '#section6' : route('contact') }}">Contact</a></li>
                <li><a href="https://templatemo.com" class="external">External</a></li>

                <!-- Authentication Links -->
                @include('partials.auth-links')
            </ul>
        </nav>
    @endif
</header>
