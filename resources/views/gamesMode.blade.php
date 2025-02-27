@extends('layout')
@section('content')
    <main class="main-block">
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    <div class="row formcard  hidden" id="animatedDiv">
                        <h2>Válassz játékmódot!</h2>
                        <hr>
                        <div class="col-md-6 leftreg p-5">
                            <div class="righregcontent">
                                <span>{{ $solo->Game_Mode }}</span>
                                <span>{{ $solotext->Game_Mode_Info }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 rightreg p-5">
                            <div class="righregcontent text-center">
                                <span>{{ $multi->Game_Mode }}</span>
                                <span>{{ $multiinfo->Game_Mode_Info }}</span>
                            </div>
                        </div>

                    </div>

                </div>



    </main>
@endsection
