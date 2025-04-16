@extends('layout')
@section('content')
    <main>
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Siker',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <section class="welcomeblade">
            <h1>Care and Play</h1>
            <h5>"Produktivan, egy szebb jovoert..."</h5>
            <div class="custom-shape-divider-bottom-1741029606">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
        </section>

        <div class="section2">
            <div class="sliding">
                <div class="slidingcontainer">
                    <div class="szoveg">
                        <div class="szovegsliding" id="tranc">
                            <div class="szoveg-item ">
                                <span class="movingtext">Jövő</span>
                                Produktív <span class="movingtext">Törödés</span>
                                Foglalkozás Szeretet <span class="movingtext">Jövő</span>
                                Produktív <span class="movingtext">Törödés</span>
                                Foglalkozás
                                Szeretet <span class="movingtext">Jövő</span>
                                Produktív <span class="movingtext">Törödés</span>
                                Foglalkozás Szeretet <span class="movingtext">Jövő</span>
                                Produktív <span class="movingtext">Törödés</span>
                                Foglalkozás
                                Szeretet
                            </div>

                        </div>
                    </div>
                    <div class="szoveg">
                        <div class="szovegsliding " id="tranb">
                            <div class="szoveg-item ">
                                Egymásért Lehetőség Bizalom Közösség <span class="movingtext">Ajándék</span>
                                Egymásért Lehetőség Bizalom Közösség
                                <span class="movingtext">Ajándék</span>
                                Egymásért Lehetőség Bizalom Közösség <span class="movingtext">Ajándék</span>
                                Egymásért Lehetőség
                                Bizalom Közösség
                                <span class="movingtext">Ajándék</span><br>
                            </div>
                        </div>
                    </div>
                    <div class="szoveg">
                        <div class="szovegsliding" id="trana">
                            <div class="szoveg-item ">
                                Kreatív Ösztönző <span class="movingtext">Esélyek</span>
                                Kihívások Kreatív Ösztönző <span class="movingtext">Esélyek</span>
                                Kihívások
                                Csodák <span class="movingtext">Célok</span>
                                Előre Játék Tartalom Kreatív Ösztönző <span class="movingtext">Esélyek</span>
                                Kihívások Kreatív
                                Ösztönző <span class="movingtext">Esélyek</span>
                                Kihívások
                                Csodák <span class="movingtext">Célok</span>
                                Előre Játék Tartalom
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <section class="welcomeblade2">
            <div class="custom-shape-divider-top-1741025554">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                    preserveAspectRatio="none">
                    <path
                        d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                        class="shape-fill"></path>
                </svg>
            </div>
            <div class="hiddenc">

                <h4>Rólunk</h4>
                <div class="rolunk">
                    <div class="rolunkbox">
                        <p>A célünk ezzel a weboldallal hogy interaktív játékokkal lehessen pontokat szerezni
                            ami
                            átalakul bizonyos összegű pénzzé és ezt, egy felhasználó által választott
                            jótékonysági
                            cégnak a javára továbbítjuk.</p>
                    </div>
                    <div class="rolunkbox">
                        <img src="{{ asset('assets/img/create me a group people working on a project .jpg') }}"
                            alt="2 people doing business.jpg">

                    </div>
                </div>
            </div>
            <div class="contentright">
                <div class="rolunk">
                    <div class="rolunkbox">
                        <img src="{{ asset('assets/img/2 people doing business.jpg') }}" alt="2 people doing business.jpg">
                    </div>
                    <div class="rolunkbox">
                        <p>Az első partnerünk a "Carty" volt. 2022-ben sikerült egy dinamikus kapcsolatot
                            kiépíteni
                            velük, és közösen segítünk az embereknek azóta is töretlenül...</p>
                    </div>
                </div>
            </div>

        </section>
        <div class="section2">
            <div class="blob">
                <div class="custom-shape-divider-top-1741034294">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                        preserveAspectRatio="none">
                        <path
                            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                            class="shape-fill"></path>
                    </svg>
                </div>
            </div>

            <h2>Partnereink</h2>
            <hr class="text-black w-50">
            <div class="logos mb-3">
                <div class="logo"><img src="{{ asset('assets/img/cartylogo.png') }}" alt=""></div>
                <div class="logo kettes"><img src="{{ asset('assets/img/everyone.png') }}" alt=""></div>
                <div class="divider"></div>
                <div class="logo"><img src="{{ asset('assets/img/ftplogo.png') }}" alt=""></div>
                <div class="logo"><img src="{{ asset('assets/img/hand.png') }}" alt=""></div>
            </div>
        </div>

    </main>
@endsection
