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
            <div class="profbag">
                <div class="row w-100 badgesek">
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
                        <p><a href="mailto:{{ Auth::user()->Email }}">{{ Auth::user()->email }}</a></p>
                        <div class="buttons">
                            <p><a class="btn btn-info" href="/newpass" style="text-wrap: nowrap">Jelszó módosítás</a>
                            </p>


                            <p><a class="btn btn-danger" href="/logout">Kilépés</a></p>

                        </div>
                    </div>
                    <div class="col-md-6 profw">

                        <div class="badges-section mx-auto">
                            <h2 class="text-center text-white">Badge-ek</h2>
                            <div class="badges">
                                @foreach ($allBadges as $badge)
                                    <div class="badge">

                                        @if ($achievedBadges->contains($badge))
                                            <img src="{{ $badge->Badge_Image_Path }}" alt="{{ $badge->Badge_Name }}" />
                                        @else
                                            <img src="{{ $badge->Badge_Image_Path }}" style="filter: grayscale(100%);"
                                                alt="{{ $badge->Badge_Name }}" />
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




    </main>
@endsection
