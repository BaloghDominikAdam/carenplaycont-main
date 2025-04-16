@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">
            <div class="profbag">
                <div class="row w-100 badgesek">
                    <div class="col-md-6 profw m-auto">
                        <div class="d-grid hah">

                            @if ($user->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}">
                            @else
                                <img src="{{ asset('assets/img/profile_picture/' . $user->user_profile_picture) }}">
                            @endif

                            @auth
                                <a href="{{ route('messages.show', $user->User_id) }}"><i class="fa-solid fa-comments"></i></a>

                            @endauth


                            <h5 class="pt-3 text-nowrap">{{ $user->username }} Profilja</h5>


                        </div>

                        <div class="profile-info">
                            <p><a class="fs-2" href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                        </div>

                    </div>
                    <div class="col-md-6 profw m-auto">

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
                                            <h5>{{ $badge->Badge_Name }}</h5>
                                            <p>{{ $badge->Badge_Description }}</p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <h5 class="text-white py-3 text-center display-6" style="font-family:FairyDustB">Véleményei</h5>
            @foreach ($posts as $post)
                <div class="row newpost m-auto">
                    <div class="col-md-12">
                        <div class="post">
                            <div class="row py-2">
                                <div class="col-md-12">

                                    <div class="personal ">

                                        @if (auth()->id() == $post->Games_Review_User_Id)
                                            @if ($post->user->user_profile_picture == 'assets/img/default-avatar.jpg')
                                                <a href="/profil"><img src="{{ asset('assets/img/default-avatar.jpg') }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @else
                                                <a href="/profil"><img
                                                        src="{{ asset('assets/img/profile_picture/' . auth()->user()->user_profile_picture) }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @endif
                                        @elseif (auth()->id() !== $post->Games_Review_User_Id)
                                            @if ($post->user->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                                <a href="/profile/{{ $post->Games_Review_User_Id }}"><img
                                                        src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @else
                                                <a href="/profile/{{ $post->Games_Review_User_Id }}"><img
                                                        src="{{ asset('assets/img/profile_picture/' . $post->user->user_profile_picture) }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @endif
                                        @endif





                                        <div class="d-grid">
                                            <p class="px-3">{{ $post->user->username }}</p>
                                            <p style="font-size: 15px; font-style:italic;" class="text-muted px-3">
                                                {{ date_format(date_create($post->User_Posted_Time), 'Y. m. d. H:i:s') }}
                                            </p>
                                        </div>


                                    </div>
                                    <div class="rating-display d-flex">
                                        <div class="star-rating" data-rating="{{ $post->Games_Review }}"></div>
                                        <span class="rating-text my-auto">({{ $post->Games_Review }} /5)</span>
                                    </div>
                                    <p class="my-3" style="font-style: italic">{{ $post->Game_Review_Name }}</p>

                                    <p>{{ $post->Games_Review_Text }}</p>


                                </div>
                            </div>
            @endforeach

        </div>
    </main>

    <script>
        document.querySelectorAll('.star-rating').forEach(element => {
            const rating = parseInt(element.dataset.rating);
            element.innerHTML = '★'.repeat(rating) + '☆'.repeat(5 - rating);
        });
    </script>
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
