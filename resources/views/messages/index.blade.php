@extends('layout')
@section('content')


    <main class="main-block">
        <div class="section3 container">
            <div class="row rowchat">
                <div class="col-md-4 leftpanel py-5 px-4">
                    <div class="form-group">
                        <input type="text" id="search" placeholder="Keresés a felhasználók között..."
                            class="form-control w-100 rounded-pill" autocomplete="off">
                        <div id="user-list" class="list-group mt-2" style="display: none;">
                            <ul id="user-list" class="list-group">

                            </ul>
                        </div>
                        <div id="no-results" class="text-muted mt-2 text-danger text-center" style="display: none;">Nincs
                            ilyen felhasználó</div>
                    </div>
                    <div class="previouschatscont py-5">
                        @foreach ($chatUsers as $chatUser)
                            <div class="py-2">
                                <div class="previouschats d-flex p-3 @if (isset($user) && $user->User_id == $chatUser->User_id) active-user @endif">

                                    @if ($chatUser->unread > 0)
                                        <span
                                            class="position-absolute top-0 start-0 translate-middle iconka rounded-pill bg-danger">
                                            {{ $chatUser->unread }}
                                        </span>
                                    @endif



                                    <img src="{{ Storage::url($chatUser->user_profile_picture) }}" alt="Profilkép"
                                        style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit:cover;">

                                    <a href="{{ route('messages.show', $chatUser->User_id) }}"
                                        class="list-group-item list-group-item-action border-0 w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if ($chatUser->unread > 0)
                                                <span class="badge bg-danger">{{ $unread->unread }}</span>
                                            @endif
                                            <strong>{{ $chatUser->username }}</strong>
                                            @if ($chatUser->lastMessage)
                                                <small class="text-white fs-5 mr-auto">
                                                    {{ $chatUser->lastMessage->created_at }}
                                                </small>
                                            @endif
                                        </div>
                                        @if ($chatUser->lastMessage)
                                            <p class="mb-0 text-muted">
                                                @if ($chatUser->lastMessage->sender_id == auth()->id())
                                                    <strong>Te:</strong>
                                                @endif
                                                {{ Str::limit($chatUser->lastMessage->Message_Text, 10) }}
                                            </p>
                                        @else
                                            <p class="mb-0 text-muted">Nincs üzenet</p>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

                <div class="col-md-8 position-relative rightpanel">
                    @if (isset($user))
                        <div class="w-100" id="chat-box"
                            style="height: 750px; overflow-y: scroll;background-color: #eaeaea3f;
                            box-shadow: 1px 1px 15px 1px #bdbdbd8d;
                            border-radius: 45px;">
                            <div
                                style="height:15px; background-color:rgba(152, 152, 152, 0.711); text-align:center; padding:0">
                                <h3 class="text-center text-white px-auto"> {{ $user->username }}</h3>
                            </div>


                            @foreach ($messages as $message)
                                @if ($message->Sender_Id == auth()->id())
                                    <div class="p-3">
                                        <div class="uzenet1 ms-auto">
                                            <div
                                                class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                                <small
                                                    style="float: right"><i>{{ date_format(date_create($message->created_at), 'Y-m-d H:i:s') }}</i></small>

                                                <p>Te: </p>

                                                <p>{{ $message->Message_Text }} </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="p-3">
                                            <div class="uzenet1 me-start">
                                                <div
                                                    class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                                    <small
                                                        style="float: right"><i>{{ date_format(date_create($message->created_at), 'Y-m-d H:i:s') }}</i></small>
                                                    <p>{{ $message->username }} </p>
                                                    @if ($message->sender_id != auth()->id() && $message->new_message)
                                                        <span class="unread-dot"></span>
                                                    @endif

                                                    <p>{{ $message->Message_Text }} </p>
                                                </div>
                                            </div>
                                @endif


                        </div>
                    @endforeach
                    <div class="conti px-5">
                        <form action="{{ route('messages.send') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-center p-3">

                                <input type="hidden" name="receiver_id" value="{{ $user->User_id }}">
                                <a class="btn mx-1" href=""><i class="fa-solid fa-image"></i></a>
                                <textarea name="message_text" class="form-control rounded-pill w-75 mx-1" rows="1" required></textarea>
                                <button type="submit" class="btn mx-1">Küldés</button>


                            </div>

                        </form>
                    </div>
                </div>
            @else
                <h3 class="text-center "><b>Válassz egy felhasználót a beszélgetéshez</b></h3>
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
                const loggedInUserId = {!! auth()->id() !!};

                userList.innerHTML = '';

                let hasResults = false;
                users.forEach(user => {
                    if (user.User_id !== loggedInUserId && user.username.toLowerCase().includes(searchValue)) {
                        hasResults = true;
                        userList.innerHTML += `
                    <a href="{{ route('messages.show', '') }}/${user.User_id}" class="list-group-item list-group-item-action">
                        <img src="{{ Storage::url('') }}/${user.user_profile_picture}" alt="Profilkép" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
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
