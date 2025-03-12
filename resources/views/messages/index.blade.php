@extends('layout')
@section('content')

    <main class="main-block">


        <div class="section3 container">
            <div class="row">
                {{-- <div class="col-md-4">
                    <h3>Felhasználók</h3>
                    <input type="text" id="search" placeholder="Keresés..." class="form-control mb-3">
                    <ul id="user-list" class="list-group">
                        @foreach ($users as $u)
                            <li class="list-group-item {{ $u->User_id == ($user->User_id ?? null) ? 'active' : '' }} ">
                                <a href="{{ route('messages.show', $u->User_id) }}"
                                    class="text-black">{{ $u->username }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div> --}}

                <div class="col-md-4">
                    <h3>Felhasználók</h3>
                    <div class="form-group">
                        <input type="text" id="search" placeholder="Keresés..." class="form-control" autocomplete="off">
                        <div id="user-list" class="list-group mt-2" style="display: none;">
                            <ul id="user-list" class="list-group">

                            </ul>
                        </div>
                        <div id="no-results" class="text-muted mt-2 text-danger text-center" style="display: none;">Nincs
                            ilyen felhasználó</div>
                    </div>
                </div>

                <div class="col-md-8">
                    @if (isset($user))
                        <h3 class="text-center text-white">{{ $user->username }}</h3>
                        <div id="chat-box"
                            style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
                            @foreach ($messages as $message)
                                <div class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                    <strong>{{ $message->sender_id == auth()->id() ? 'You' : $user->username }}:</strong>
                                    <p>{{ $message->message_text }}</p>
                                    <small>{{ $message->created_at->format('H:i') }}</small>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('messages.send') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->User_id }}">
                            <textarea name="message_text" class="form-control" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Küldés</button>
                        </form>
                    @else
                        <h3><b>Válassz egy felhasználót a beszélgetéshez</b></h3>
                    @endif
                </div>
            </div>
        </div>

        <script>
            document.getElementById('search').addEventListener('input', function() {
                const searchValue = this.value.toLowerCase();
                const userList = document.getElementById('user-list');
                const noResults = document.getElementById('no-results');
                const users = {!! json_encode($users) !!};
                const loggedInUserId = {!! auth()->id() !!}; // Bejelentkezett felhasználó ID-ja

                userList.innerHTML = '';

                let hasResults = false;
                users.forEach(user => {
                    // Kiszűrjük a bejelentkezett felhasználót
                    if (user.User_id !== loggedInUserId && user.username.toLowerCase().includes(searchValue)) {
                        hasResults = true;
                        userList.innerHTML += `
                    <a href="{{ route('messages.show', '') }}/${user.User_id}" class="list-group-item list-group-item-action">
                        <img src="{{ Storage::url('') }}/${user.user_profile_picture}" alt="Profilkép" style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                        ${user.username}
                    </a>
                `;
                    }
                });

                if (hasResults) {
                    userList.style.display = 'block';
                    noResults.style.display = 'none';
                } else {
                    userList.style.display = 'none';
                    noResults.style.display = 'block';
                }
            });

            document.getElementById('search').addEventListener('focus', function() {
                document.getElementById('user-list').style.display = 'block';
            });

            document.getElementById('search').addEventListener('blur', function() {
                setTimeout(() => {
                    if (!document.getElementById('user-list').contains(document.activeElement)) {
                        document.getElementById('user-list').style.display = 'none';
                    }
                }, 200);
            });

            document.getElementById('user-list').addEventListener('mousedown', function(event) {
                event.preventDefault();
            });

            // Keresőmező fókuszálásakor megjelenítjük a felhasználók listáját
            document.getElementById('search').addEventListener('focus', function() {
                document.getElementById('user-list').style.display = 'block';
            });

            // Keresőmezőből való kilépéskor elrejtjük a felhasználók listáját, ha nem kattintottunk a listára
            document.getElementById('search').addEventListener('blur', function() {
                setTimeout(() => {
                    if (!document.getElementById('user-list').contains(document.activeElement)) {
                        document.getElementById('user-list').style.display = 'none';
                    }
                }, 200);
            });

            // Ha a felhasználó a listára kattint, ne rejtse el a listát
            document.getElementById('user-list').addEventListener('mousedown', function(event) {
                event.preventDefault(); // Megakadályozzuk, hogy a blur esemény aktiválódjon
            });
        </script>
        <style>
            #user-list {
                max-height: 300px;
                overflow-y: auto;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            #user-list .list-group-item {
                border: none;
                border-bottom: 1px solid #ddd;
            }

            #user-list .list-group-item:last-child {
                border-bottom: none;
            }

            #no-results {
                font-style: italic;
            }
        </style>

    </main>

@endsection
