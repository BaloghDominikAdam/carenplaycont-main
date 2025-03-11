@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">
            <div class="profbag">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-grid">
                            @if ($user->user_profile_picture)
                                <img src="{{ Storage::url($user->user_profile_picture) }}" alt="Profilkép"
                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;">
                            @else
                                <img src="{{ asset('assets/img/default-avatar.jpg') }}" alt="Alapértelmezett profilkép"
                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;">
                            @endif
                            <h5 class="pt-3 text-nowrap">{{ $user->username }} Profilja</h5>
                        </div>

                        <div class="profile-info">
                            <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        </div>

                    </div>
                    <div class="col-md-6">
                        
                    </div>

                </div>

            </div>
            <h5 class="text-white py-3 text-center display-6" style="font-family:FairyDustB">Bejegyzések</h5>
            @foreach ($user->communityfeed as $row)
                <div class="row newpost">
                    <div class="col-md-12">
                        <div class="post">
                            <p style="font-size: 15px; font-style:italic; float: right;">
                                {{ date_format(date_create($row->User_Posted_Time), 'Y. m. d. H:i:s') }}
                            </p>
                            <p class="my-auto">{{ $row->User_Message }}</p>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </main>
@endsection





{{-- <div class="container">
    @foreach ($result as $row)
        <div class="row newpost">
            <div class="col-md-12">
                <a href="{{ route('profile.show', $row->User_Id) }}">
                    <img src="{{ Storage::url($row->user->user_profile_picture) }}" alt="Profilkép"
                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                <p style="font-size: 15px; font-style:italic; float: right;">
                    {{ date_format(date_create($row->User_Posted_Time), 'Y. m. d. H:i:s') }}
                </p>
                <p class="py-3">{{ $row->user->username }}</p>

                <p>{{ $row->User_Message }}</p>
            </div>
        </div>
    @endforeach



</div> --}}
