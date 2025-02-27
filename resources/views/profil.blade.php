@extends('layout')
@section('content')
    <main class="main-block">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Siker!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="home-page">
            <div class="content" id="content">
                <section>
                    <div class="py-3 fs-5">
                        <h2 class="text-center display-5">Üdvözöljük, {{ Auth::user()->username }} !</h2>
                        <p><b>Email:</b> <a href="mailto:{{ Auth::user()->Email }}">{{ Auth::user()->email }}</a></p>
                        <p><a class="btn btn-info" href="/newpass">Jelszó módosítás</a></p>
                        <p><a class="btn btn-danger" href="/logout">Kilépés</a></p>
                    </div>
                </section>

            </div>
        </div>

    </main>
@endsection
