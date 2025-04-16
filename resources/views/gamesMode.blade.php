@extends('layout')
@section('content')
    <main class="main-block">
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    @auth
                        <h2 id="gamesmode">Válassz játékot!</h2>
                    @else
                        <h2 id="gamesmode">Előzetes betekintés a játékokról</h2>
                    @endauth

                    <hr>
                    <div class="row row-cols-xs-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" id="animatedDiv">


                        <div class="col-3 py-2">
                            <div class="card h-100 mx-auto w-100">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/memoria.mp4') }}" class="w-100"
                                        type="video/mp4" style="border-radius: 15px">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">Memória Játék</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban párosítanod kell az adott elemeket...
                                            <span class="text-black">Készítette: CodingNepal</span>
                                        </div>
                                        @auth
                                            <a href="/memorygame" class="btn btn-primary mt-3">Játszunk</a>
                                        @else
                                            <a href="/login" class="btn btn-primary mt-3 w-100">Ha szeretne játszani,
                                                először
                                                jelentkezzen be!</a>
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-3 py-2">
                            <div class="card h-100 mx-auto w-100">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/wordle.mp4') }}" class="w-100"
                                        type="video/mp4">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">Wordle Játék</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban egy szót kell kitalálnod a magyar szótárból...
                                            <span class="text-black">Készítette: Double D</span>
                                        </div>
                                        @auth
                                            <a href="/wordlegame" class="btn btn-primary mt-3">Játszunk</a>
                                        @else
                                            <a href="/login" class="btn btn-primary mt-3 w-100">Ha szeretne játszani, először
                                                jelentkezzen be!</a>
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- </div>
                    <div class="row h-50" id="animatedDiv"> --}}
                        <div class="col-3  py-2">
                            <div class="card h-100 mx-auto w-100">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/quiz.mp4') }}" class="w-100"
                                        type="video/mp4">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title text-center">Quiz Játék</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban téma választást után kell kérdésekre helyes választ
                                            adnod...
                                            <span class="text-black">Készítette: CodingNepal</span>
                                        </div>
                                        @auth
                                            <a href="/quizgame" class="btn btn-primary mt-3">Játszunk</a>
                                        @else
                                            <a href="/login" class="btn btn-primary mt-3 w-100">Ha szeretne játszani, először
                                                jelentkezzen be!</a>
                                        @endauth
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-3  py-2">
                            <div class="card h-100 mx-auto w-100">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/negyvennyolc.mp4') }}" class="w-100"
                                        type="video/mp4" style="border-radius: 15px">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">2048</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban nyilak segítségével kell azonos értékű kockákat egybe húznod
                                                <span class="text-black">Készítette: Simple Coding Tutorials</span>
                                        </div>
                                        @auth
                                            <a href="/husznegyvennyolc" class="btn btn-primary mt-3">Játszunk</a>
                                        @else
                                            <a href="/login" class="btn btn-primary mt-3 w-100">Ha szeretne játszani, először
                                                jelentkezzen be!</a>
                                        @endauth
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                </div>


                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const cards = document.querySelectorAll('.card');

                        cards.forEach(card => {
                            const video = card.querySelector('video');

                            // Alapállapotban szüneteltetjük a videót
                            video.pause();

                            card.addEventListener('mouseenter', () => {
                                video.currentTime = 0; // Visszaállítjuk az elejére
                                video.play();
                            });

                            card.addEventListener('mouseleave', () => {
                                video.pause();
                            });
                        });
                    });
                </script>
    </main>
@endsection
