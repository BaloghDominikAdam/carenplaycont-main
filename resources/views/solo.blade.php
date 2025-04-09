@extends('layout')
@section('content')
    <main class="main-block">
        <div class="content container">
            <div class="regpage">
                <div class="gamescontainer">
                    <div class="row row-cols-1 row-cols-ml-2 row-cols-lg-3 row-cols-xl-3 px-auto">
                        <div class="col game1 "><a href="/memorygame">
                                <div class="selectGame py-2 text-center">
                                    <p>Memory game</p>
                                </div>
                                <div class="descr">

                                </div>
                            </a>
                        </div>
                        <div class="col game2 ">
                            <a href="/wordlegame">
                                <div class="selectGame py-2 text-center">
                                    <p>Wordle Game</p>
                                </div>
                            </a>
                        </div>
                        <div class="col game3 ">
                            <div class="selectGame py-2 text-center">
                                <p>3</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



    </main>
@endsection
