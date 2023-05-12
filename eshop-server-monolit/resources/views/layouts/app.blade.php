<!DOCTYPE html>
<html>
    <head>
        @include('partials.head')
    </head>
    <body>
        <header>
            @if(\Illuminate\Support\Facades\Request::is('admin'))
                @include('partials.adminNavbar')
            @else
                @include('partials.customerNavbar')
            @endif
        </header>

        <main>
            @include('sweetalert::alert')
            @yield('content')
        </main>

        <footer>
            @include('partials.footer')
        </footer>

    </body>
</html>
