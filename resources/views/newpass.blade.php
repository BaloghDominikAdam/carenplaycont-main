@extends('layout')
@section('content')
    <main class="main-block">
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Sikertelen',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
        <div class="home-page">
            <div class="content" id="content">
                <div class="regpage">
                    <div class="formcard hidden d-grid justify-content-center align-items-center  " id="animatedDiv">
                        <h2>Új jelszó igénylése</h2>
                        <div class="rightreg">
                            <div class="righregcontent">
                                <form action="/newpass" method="post">
                                    @csrf
                                    <div class="py-2 ">
                                        <label for="oldpassword" class="form-label text-center w-100">Régi jelszó: </label>
                                        <input type="password" name="oldpassword" id="oldpassword"
                                            class="form-control w-50 rounded-pill mx-auto ">
                                        @error('oldpassword')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <label for="newpassword" class="form-label text-center w-100">Új Jelszó: </label>
                                        <input type="password" name="newpassword" id="newpassword"
                                            class="form-control w-50 rounded-pill mx-auto ">
                                        @error('newpassword')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="py-2">
                                        <label for="newpassword_confirmation" class="form-label text-center w-100">Új Jelszó
                                            mégegyszer:
                                        </label>
                                        <input type="password" name="newpassword_confirmation" id="newpassword_confirmation"
                                            class="form-control w-50 rounded-pill mx-auto ">
                                        @error('newpassword_confirmation')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="py-2 mx-auto">
                                        <button class="btn w-100 text-center mx-auto " type="submit">Jelszó
                                            módosítása</button>
                                    </div>




                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </main>
@endsection
