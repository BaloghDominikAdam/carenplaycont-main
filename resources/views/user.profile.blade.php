@extends('layout')

@section('content')
    <main class="main-block">
        <div class="section3 container">
            <div class="profbag">
                <div class="row">
                    <div class="col-md-6">
                        @if ($user->user_profile_picture)
                            <img src="{{ Storage::url($user->user_profile_picture) }}" alt="Profilkép"
                                style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;">
                        @else
                            <img src="{{ asset('assets/img/default-avatar.jpg') }}" alt="Alap profilkép"
                                style="width: 100px; height: auto; border-radius: 50px; cursor: pointer;">
                        @endif
                        <h5 class="pt-3">{{ $user->username }} </h5>
                        <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    </div>
                    <div class="col-md-6">
                        <h2>Bejegyzések:</h2>
                        @foreach ($posts as $post)
                            <div>
                                <p>{{ $post->User_Message }}</p>
                                <small>{{ $post->User_Posted_Time }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
