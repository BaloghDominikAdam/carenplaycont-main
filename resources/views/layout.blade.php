<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care and Play</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/img/memorygame') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />




</head>

<nav class="navbar navbar-expand-lg px-2" id="navnav" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/">Care and Play</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/gamesMode"><i class="fa-solid fa-gamepad"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/community"><i class="fa-solid fa-globe"></i></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">

                            @if ($totalUnread > 0)
                                <i class="fa-solid fa-comments"><span
                                        class=" translate-middle iconka rounded-pill bg-danger fs-5">
                                        {{ $totalUnread }}
                                        <span class="visually-hidden">Olvasatlan üzenetek</span></i>

                                </span>
                            @else
                                <i class="fa-solid fa-comments"></i>
                            @endif
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $messagesUrl ?? route('messages.index') }}">
                            @if ($totalUnread > 0)
                                <i class="fa-solid fa-comments">
                                    <span class="translate-middle iconka rounded-pill bg-danger fs-5">
                                        {{ $totalUnread }}
                                        <span class="visually-hidden">Olvasatlan üzenetek</span>
                                    </span>
                                </i>
                            @else
                                <i class="fa-solid fa-comments"></i>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profil"><i class="fa-solid fa-user"></i></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/community">Közösség</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reg">Regisztráció</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Bejelentkezés</a>
                    </li>

                @endauth
            </ul>
        </div>
    </div>
</nav>

@yield('content')


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

</html>
