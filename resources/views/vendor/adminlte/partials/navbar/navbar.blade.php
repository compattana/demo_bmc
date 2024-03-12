<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @if(\Illuminate\Support\Facades\Cookie::get('darkmode') != 1)
            <li class="nav-item">
                <a class="nav-link"  href="{{route('dark-mode')}}" role="button">
                    <i class="fas fa-solid fa-moon"></i>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link"  href="{{route('bright-mode')}}" role="button">
                    <i class="fas fa-solid fa-sun"></i>
                </a>
            </li>
        @endif

{{--        @push('js')--}}
{{--            <script>--}}
{{--                function setDarkmode(){--}}
{{--                    document.cookie = "darkmode=1; path=/";--}}
{{--                    location.reload();--}}
{{--                }--}}

{{--                function setBrightmode(){--}}
{{--                    document.cookie = "darkmode=; path=/";--}}
{{--                    location.reload();--}}
{{--                }--}}
{{--            </script>--}}
{{--        @endpush--}}


        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
