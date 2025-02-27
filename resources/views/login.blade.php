@extends('layout')
@section('content')
    <main class="main-block">
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Sikertelen bejelentkezés!',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    <div class="row formcard  hidden" id="animatedDiv">
                        <h2>Bejelentkezés</h2>
                        <div class="col-md-6 leftreg p-5">
                            <div class="righregcontent">
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="py-3">
                                        <label for="credentials" id="credentials" class="form-label">Email vagy
                                            felhasznlónév:</label>
                                        <input type="text" name="credentials" id="credentials"
                                            class="form-control w-100 rounded-pill" value={{ old('credentials') }}>
                                        @error('credentials')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="py-3">
                                        <label for="password" id="password" class="form-label">Jelszó:</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control w-100 rounded-pill">
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="py-3 text-center">
                                        <button type="submit" class="btn">Belépés!</button>
                                    </div>

                            </div>

                        </div>
                        <div class="col-md-6 rightreg">

                            <div class="righregcontent text-center">
                                <h3>Még nincs fiókod?</h3>
                                <p>Regisztrálj be!</p>
                                <a href="/reg" class="btn">Regisztráció!</a>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>



    </main>
@endsection
