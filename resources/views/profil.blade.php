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
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="d-grid">
                            @if (auth()->user()->user_profile_picture &&
                                    auth()->user()->user_profile_picture != 'profile_pictures/default-avatar.jpg')
                                <img src="{{ Storage::url(auth()->user()->user_profile_picture) }}" alt="Profilkép"
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
                                <img src="{{ Storage::url('profile_pictures/default-avatar.jpg') }}"
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
                    <div class="col-md-6">
                    </div>
                </div>
            </div>

        </div>
        </div>




    </main>
@endsection
