@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">
            <div class="profbag">
                <div class="row w-100 badgesek">
                    <div class="col-md-6 profw">
                        <div class="d-grid">

                            @if ($user->user_profile_picture == 'assets/img/default-avatar.jpg')
                                <img src="{{ asset('assets/img/default-avatar.jpg') }}"
                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/img/profile_picture/' . $user->user_profile_picture) }}"
                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                            @endif


                            <h5 class="pt-3 text-nowrap">{{ $user->username }} Profilja</h5>
                        </div>

                        <div class="profile-info">
                            <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        </div>

                    </div>
                    <div class="col-md-6 profw ">

                        <div class="badges-section mx-auto">
                            <h2 class="text-center text-white">{{ $user->username }} Elért Badgejei!</h2>
                            <div class="badges">
                                @foreach ($achievedBadges as $badge)
                                    <div class="badge">

                                        @if ($achievedBadges->contains($badge))
                                            <img src="{{ asset($badge->Badge_Image_Path) }}"
                                                alt="{{ $badge->Badge_Name }}" />
                                            {{-- @else
                                            <img src="{{ asset($badge->Badge_Image_Path) }}"
                                                style="filter: grayscale(100%);" alt="{{ $badge->Badge_Name }}" /> --}}
                                        @endif

                                        <div class="dropbox">
                                            <p>{{ $badge->Badge_Name }}</p>
                                            <p>{{ $badge->Badge_Description }}</p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <h5 class="text-white py-3 text-center display-6" style="font-family:FairyDustB">Bejegyzések</h5>
            @foreach ($posts as $post)
                <div class="row newpost">
                    <div class="col-md-12">
                        <div class="post">
                            <div class="row py-2">
                                <div class="col-md-6 d-flex ">
                                    @if ($user->user_profile_picture !== 'assets/img/default-avatar.jpg')
                                        <img src="{{ asset('assets/img/profile_picture/' . $user->user_profile_picture) }}"
                                            alt="Profilkép"
                                            style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('assets/img/default-avatar.jpg') }}"
                                            alt="Alapértelmezett profilkép"
                                            style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;">
                                    @endif
                                    <p class="my-auto ms-3">{{ $post->user->username }}</p>
                                </div>
                                <div class="col-md-6 ">
                                    <p style="font-size: 15px; font-style:italic; float: right; margin-top: 0;">
                                        {{ date_format(date_create($post['User_Posted_Time']), 'Y. m. d. H:i:s') }}
                                    </p>
                                </div>


                            </div>
                            <div class="row py-2">
                                <div class="col">
                                    <p class="my-auto">{{ $post['User_Message'] }}</p>

                                </div>
                            </div>

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
