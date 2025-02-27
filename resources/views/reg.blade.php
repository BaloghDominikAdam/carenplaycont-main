@extends('layout')
@section('content')
    <main class="main-block">
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    <div class="row formcard hidden" id="animatedDiv">
                        <h2>Regisztráció</h2>
                        <div class="col-md-6 leftreg  px-5">
                            <form action="/reg" method="post">
                                @csrf
                                <div class="py-3">
                                    <label for="nev" id="nev" class="form-label ">Név:</label>
                                    <input type="text" name="nev" id="nev"
                                        class="form-control w-100 rounded-pill" placeholder="Pl. Gipsz Jakab"
                                        value={{ old('nev') }}>
                                    @error('nev')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-3">
                                    <label for="email" id="email" class="form-label">Email:</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control w-100 rounded-pill" placeholder="Pl. gipszjakab2@gmail.com"
                                        value={{ old('email') }}>
                                    @error('email')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-3">
                                    <label for="password" id="password" class="form-label">Jelszó:</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control w-100 rounded-pill" placeholder="Pl. GipszJakab01.">
                                    @error('password')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-3">
                                    <label for="password_confirmation" id="password_confirmation" class="form-label">Jelszó
                                        mégegyszer:</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control w-100 rounded-pill" placeholder="Pl. GipszJakab01.">
                                    @error('password_confirmation')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="py-3 text-center">
                                    <button type="submit" class="btn ">Regisztráció!</button>
                                </div>

                        </div>
                        <div class="col-md-6 rightreg py-2 px-5">
                            <div class="righregcontent py-auto">
                                <h3>Már van fiókod?</h3>
                                <p>Jelentkezz be!</p>
                                <a href="/login" class="btn">Belépés!</a>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>





            </div>
        </div>

    </main>
@endsection
