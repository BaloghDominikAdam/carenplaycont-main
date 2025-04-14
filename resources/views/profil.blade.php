@extends('layout')
@section('content')
    <main class="main-block">
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Siker!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif


        <div class="section3 container">
            <div class="profbag ">
                <div class="row w-100 badgesek ">
                    <div class="col-md-6 profw">
                        <div class="d-grid">
                            @if (auth()->user()->user_profile_picture &&
                                    auth()->user()->user_profile_picture !== 'assets/img/profile_picture/default-avatar.jpg')
                                <img src="{{ asset('assets/img/profile_picture/' . auth()->user()->user_profile_picture) }}"
                                    alt="Profilkép"
                                    style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit:cover;"
                                    onclick="document.getElementById('profile_picture').click();">
                                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <label for="profile_picture" style="display:none;">Profilkép feltöltése:</label>
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                            style="display: none;" onchange="this.form.submit();">
                                    </div>
                                </form>
                                <form action="{{ route('profil.removePicture') }}" method="POST"
                                    style="margin-top: 10px; width:50%">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" style="text-wrap: nowrap">
                                        Profilkép eltávolítása
                                    </button>
                                </form>
                            @else
                                <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                    alt="Alapértelmezett profilkép"
                                    style="width: 100px; height: auto; border-radius: 50px; cursor: pointer;"
                                    onclick="document.getElementById('profile_picture').click();">
                                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div>
                                        <label for="profile_picture" style="display:none;">Profilkép feltöltése:</label>
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                            style="display: none;" onchange="this.form.submit();">
                                    </div>
                                </form>
                            @endif



                        </div>



                        <h5 class="pt-3">{{ Auth::user()->username }} </h5>
                        <p><a class="fs-2" href="mailto:{{ Auth::user()->Email }}">{{ Auth::user()->email }}</a></p>
                        <div class="buttons">
                            <p><a class="btn btn-info" href="/newpass" style="text-wrap: nowrap">Jelszó módosítás</a>
                            </p>


                            <p><a class="btn btn-danger" href="/logout">Kilépés</a></p>

                        </div>
                    </div>
                    <div class="col-md-6 profw">

                        <div class="badges-section mx-auto">
                            <h2 class="text-center text-white mb-4">Badge-ek</h2>
                            <div class="badges">
                                @foreach ($allBadges as $badge)
                                    <div class="badge">
                                        @if ($achievedBadges->contains($badge))
                                            <img src="{{ $badge->Badge_Image_Path }}" alt="{{ $badge->Badge_Name }}"
                                                title="{{ $badge->Badge_Name }}" />
                                        @else
                                            <img src="{{ $badge->Badge_Image_Path }}" style="filter: grayscale(100%);"
                                                alt="{{ $badge->Badge_Name }}" title="{{ $badge->Badge_Name }}" />
                                        @endif

                                        <div class="dropbox">
                                            <h5 class="fw-bold mb-2 fs-3">{{ $badge->Badge_Name }}</h5>
                                            <p class="small fs-6 text-wrap">{{ $badge->Badge_Description }}</p>
                                            @unless ($achievedBadges->contains($badge))
                                                <p class="text-muted small mt-2 fs-5 text-wrap">Még nem szerezted meg!</p>
                                            @endunless
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <h5 class="text-white py-3 text-center display-6" style="font-family:FairyDustB">Véleményeid</h5>
            @foreach ($posts as $post)
                <div class="row mx-auto newpost ">
                    <div class="col-md-12">
                        <div class="post">
                            <div class="row py-2">
                                <div class="col-md-12">
                                    <div class="rating-display d-flex" style="float: right; font-style:italic">
                                        <div class="star-rating" data-rating="{{ $post->Games_Review }}"></div>
                                        <span class="rating-text my-auto">({{ $post->Games_Review }} /5)</span>
                                    </div>
                                    <div class="personal d-flex ">
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
                                    <p class="my-3" style="font-style: italic">{{ $post->Game_Review_Name }}</p>
                                    <p>{{ $post->Games_Review_Text }}</p>


                                </div>
                            </div>
            @endforeach



            <script>
                document.querySelectorAll('.star-rating').forEach(element => {
                    const rating = parseInt(element.dataset.rating);
                    element.innerHTML = '★'.repeat(rating) + '☆'.repeat(5 - rating);
                });
            </script>

    </main>
@endsection
