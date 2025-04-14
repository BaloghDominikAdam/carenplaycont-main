@extends('layout')
@section('content')
    <main class="main-block2">
        <div class="section3 ">
            <h1 class="pt-5 text-center">Véleményezési felület</h1>


            @if (Auth::check())
                <div class="text-center">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ujbej">
                        Új Értékelés Közzététele!
                    </button>
                </div>

                <div class="modal fade" id="ujbej" tabindex="-1" aria-labelledby="ujbejModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="ujbej">Új Értékelés posztolás!</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/community" method="post">
                                    @csrf
                                    <div class="py-2">
                                        <span class="text-black fs-3 my-2">Melyik játékot érékeled</span>
                                        <div class="d-flex">

                                            <input type="radio" id="memoria" name="game" class="mx-2"
                                                value="Memória Játék">
                                            <label for="memoria" class="text-black ">Memória Játék</label><br>

                                            <input type="radio" id="quiz" name="game" class="mx-2"
                                                value="Quiz Játék">
                                            <label for="quiz" class="text-black ">Quiz Játék</label><br>

                                            <input type="radio" id="wordle" name="game" class="mx-2"
                                                value="Wordle Játék">
                                            <label for="wordle" class="text-black ">Wordle Játék</label><br>

                                            <input type="radio" id="2048" name="game" class="mx-2"
                                                value="2048">
                                            <label for="2048" class="text-black ">2048</label>
                                        </div>
                                        @error('game')
                                            <p><b class="text-danger fs-5 ">{{ $message }}</b></p>
                                        @enderror
                                        <span class="text-black fs-3 my-2">Értékelj egy játékot</span>
                                        <input class="w-100 " type="range" name="range" id="range" min="1"
                                            step="1" max="5">


                                        <label for="message" id="message" class="form-label text-black">Üzenet:
                                        </label>
                                        <textarea name="message" id="message" rows="6" class="form-control"
                                            placeholder="Ide tudod írni az üzenetet amit szertnél megosztani a közösséggel..."></textarea>
                                        @error('message')
                                            <p><b class="text-danger fs-5 ">{{ $message }}</b></p>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <button type="submit" class="btn btn-info">Beküld</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
            @else
                <h2 class="text-center py-2 text-white" style="font-family: FairyDustB;"> Ha szeretne a közösségi felültre
                    írni akkor <a href="/login">jelentkezzen
                        be</a>, vagy <a href="/reg">regisztráljon!</a>
                </h2>
                <hr>
            @endif

            <div class="container">
                @foreach ($result as $row)
                    <div class="newpostcontainer">
                        <div class="row newpost">
                            <div class="col-md-12">
                                <div class="rating-display d-flex" style="float: right; font-style:italic">
                                    <div class="star-rating" data-rating="{{ $row->Games_Review }}"></div>


                                    <span class="rating-text my-auto">({{ $row->Games_Review }} /5)</span>
                                </div>
                                <div class="personal d-flex ">
                                    @if (auth()->id() == $row->Games_Review_User_Id)
                                        @if ($row->user->user_profile_picture == 'assets/img/default-avatar.jpg')
                                            <a href="/profil"><img src="{{ asset('assets/img/default-avatar.jpg') }}"
                                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                        @else
                                            <a href="/profil"><img
                                                    src="{{ asset('assets/img/profile_picture/' . auth()->user()->user_profile_picture) }}"
                                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                        @endif
                                    @elseif (auth()->id() !== $row->Games_Review_User_Id)
                                        @if ($row->user->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                            <a href="/profile/{{ $row->Games_Review_User_Id }}"><img
                                                    src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                        @else
                                            <a href="/profile/{{ $row->Games_Review_User_Id }}"><img
                                                    src="{{ asset('assets/img/profile_picture/' . $row->user->user_profile_picture) }}"
                                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                        @endif
                                    @endif





                                    <div class="d-grid">
                                        <p class="px-3">{{ $row->user->username }}</p>
                                        <p style="font-size: 15px; font-style:italic;" class="text-muted px-3">
                                            {{ date_format(date_create($row->User_Posted_Time), 'Y. m. d. H:i:s') }}
                                        </p>
                                    </div>


                                </div>
                                <p class="my-3" style="font-style: italic">{{ $row->Game_Review_Name }}</p>
                                <p>{{ $row->Games_Review_Text }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>
        </div>
        <script>
            document.querySelectorAll('.star-rating').forEach(element => {
                const rating = parseInt(element.dataset.rating);
                element.innerHTML = '★'.repeat(rating) + '☆'.repeat(5 - rating);
            });
        </script>

    </main>
@endsection
