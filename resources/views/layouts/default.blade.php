<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>

    <div id="app">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                @include('includes.sidebar')

                <div class="col py-3">
                    <main class="main-content">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
