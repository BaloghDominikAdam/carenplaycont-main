@extends('layout')
@section('content')
<div class="main-block">
    <div class="section3 container">
        <div class="profbag">
            <div class="row">
                <div class="col-md-6 ">
                    <img src="{{ Storage::url($user->user_profile_picture) }}" alt="Profilkép"
                        style="width: 100px; height: 100px; border-radius: 50px; object-fit:cover;">
                    <h5 class="pt-3">{{ $user->username }} </h5>
                    <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                </div>
                <div class="col-md-6">
                    <!-- További információ vagy gombok itt -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
