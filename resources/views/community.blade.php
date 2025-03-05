@extends('layout')
@section('content')
    <main class="main-block2">
        <div class="section3 ">
            <h1 class="pt-5 text-center">Közösségi felület</h1>


            @if (Auth::check())
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ujbej">
                    Új bejegyzés hozzáadása!
                </button>
                <div class="modal fade" id="ujbej" tabindex="-1" aria-labelledby="ujbejModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="ujbej">Új bejegyzés posztolás!</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/community" method="post">
                                    @csrf
                                    <div class="py-2">
                                        <label for="message" id="message" class="form-label text-black">Üzenet:
                                            <span class="text-danger">*</span></label>
                                        <textarea name="message" id="message" rows="6" class="form-control"
                                            placeholder="Ide tudod írni az üzenetet amit szertnél megosztani a közösséggel..."></textarea>
                                        @error('message')
                                            <p class="text-danger"><b>{{ $message }}</b></p>
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
                    <div class="row newpost">
                        <div class="col-md-12">
                            <img src="{{ Storage::url($row->user->user_profile_picture) }}" alt="Profilkép"
                                style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                            <p style="font-size: 15px; font-style:italic; float: right;">
                                {{ date_format(date_create($row->User_Posted_Time), 'Y. m. d. H:i:s') }}
                            </p>
                            <p class="py-3">{{ $row->user->username }}</p>

                            <p>{{ $row->User_Message }}</p>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>

    </main>
@endsection
