@extends('layout')
@section('content')
    <main class="main-block">
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    <div class="row" id="animatedDiv">
                        <h2>Válassz játékot!</h2>
                        <hr>
                        <div class="col-md-3 ">
                            <div class="card mx-auto">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/memoria.mp4') }}" class="w-100"
                                        type="video/mp4" style="border-radius: 15px">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">Memória Játék</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban párosítanod kell az adott elemeket...

                                        </div>
                                        <a href="/memorygame" class="btn btn-primary mt-3">Játszunk</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mx-auto">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/wordle.mp4') }}" class="w-100"
                                        type="video/mp4">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">Wordle Játék</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban egy szót kell kitalálnod a magyar szótárból...

                                        </div>
                                        <a href="/wordlegame" class="btn btn-primary mt-3">Játszunk</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- </div>
                    <div class="row h-50" id="animatedDiv"> --}}
                        <div class="col-md-3 ">
                            <div class="card mx-auto">
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

                                        </div>
                                        <a href="/quizgame" class="btn btn-primary mt-3">Játszunk</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-3 ">
                            <div class="card mx-auto">
                                <video class="rounded-top-only" muted loop>
                                    <source src="{{ asset('assets/img/previewgames/negyvennyolc.mp4') }}" class="w-100"
                                        type="video/mp4" style="border-radius: 15px">
                                </video>
                                <div class="card-body">
                                    <h3 class="card-title">2048</h3>
                                    <div class="card-body">
                                        <div class="card-text">
                                            Ebben a játékban nyilak segítségével kell azonos értékű kockákat egybe húznod

                                        </div>
                                        <a href="/husznegyvennyolc" class="btn btn-primary mt-3">Játszunk</a>
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
