@extends('layout')
@section('content')
    <main class="main-block">
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
        <div class="home-page">
            <div class="content" id="content">
                <section>
                    <h1>Care and Play</h1>
                    <h5>"Produktivan, egy szebb jovoert..."</h5>

                </section>
                <section>
                    <div class=" hiddenc">
                        <h4>Partnereink</h4>
                        <div class="logos">
                            <div class="logo hiddenc">
                                <img src="{{ asset('assets/img/logo1.jpg') }}" alt="logo1">
                                <p class="company">"Carty"</p>
                            </div>
                            <div class="logo hiddenc">
                                <img src="{{ asset('assets/img/logo2.jpg') }}" alt="logo2">
                                <p class="company">"For The People"</p>
                            </div>
                            <div class="logo hiddenc">
                                <img src="{{ asset('assets/img/logo3.jpg') }}" alt="logo3">
                                <p class="company">"Everyone counts"</p>

                            </div>
                            <div class="logo hiddenc">
                                <img src="{{ asset('assets/img/logo4.jpg') }}" alt="logo4">
                                <p class="company">"Helping Hand"</p>
                            </div>

                        </div>
                    </div>
                </section>

                <section>

                    <div class="hiddenc">
                        <h4>Rólunk</h4>
                        <div class="rolunk">
                            <div class="rolunkbox">
                                <p>A célünk ezzel a weboldallal hogy interaktív játékokkal lehessen pontokat szerezni ami átalakul bizonyos összegű pénzzé és ezt, egy felhasználó által választott jótékonysági cégnak a javára továbbítjuk.</p>
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
                                <img src="{{ asset('assets/img/2 people doing business.jpg') }}"
                                    alt="2 people doing business.jpg">
                            </div>
                            <div class="rolunkbox">
                                <p>Az első partnerünk a "Carty" volt. 2022-ben sikerült egy dinamikus kapcsolatot
                                    kiépíteni
                                    velük, és közösen segítünk az embereknek azóta is töretlenül...</p>
                            </div>

                        </div>

                    </div>



                </section>
                <section class="hiddenc">

                </section>
            </div>
        </div>
    </main>
@endsection
