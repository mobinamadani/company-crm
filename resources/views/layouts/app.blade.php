<!DOCTYPE html>
    <html lang="fa" dir="rtl">

        <head>
            <meta charset="utf-8">
            <meta name="viewport"
                  content="width=device-width, initial-scale=1">

            <meta name="csrf-token"
                  content="{{ csrf_token() }}">


            <title>@yield('title', 'CRM')</title>

            <!-- Bootstrap RTL CSS -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
                rel="stylesheet">

            <!-- Bootstrap Icons -->
            <link
                rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

            <!-- Persian Datepicker -->
            <link rel="stylesheet"
                  href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

        </head>

        <body class="bg-light">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

            <div class="container">

                <!-- Logo -->
                <a class="navbar-brand fw-bold"
                   href="{{ route('dashboard') }}">

                    Company CRM

                </a>

                @auth

                    <div class="d-flex align-items-center gap-3">

                        <!-- Username -->
                        <span class="text-white">

                    {{ auth()->user()->name }}

                </span>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="btn btn-danger btn-sm">

                                <i class="bi bi-box-arrow-right"></i>

                                خروج

                            </button>

                        </form>

                    </div>

                @endauth

            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">

            <div class="container">

                @yield('content')

            </div>

        </main>

        <!-- Bootstrap JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>

        @stack('scripts')

    </body>
</html>

