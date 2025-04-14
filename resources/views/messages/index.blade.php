@extends('layout')
@section('content')


    <main class="main-block">
        <div class="section3 container">
            <div class="row rowchat">
                <div class="col-md-4 leftpanel py-5 px-4">
                    <div class="form-group">
                        <div id="user-list-container">
                            <input type="text" id="search" placeholder="Keresés a felhasználók között..."
                                class="form-control w-100 rounded-pill" autocomplete="off">
                            <div id="user-list" class="list-group mt-2" style="display: none;">
                                <ul id="user-list" class="list-group">

                                </ul>
                            </div>
                            <div id="no-results" class="text-muted mt-2 text-danger text-center" style="display: none;">
                                Nincs
                                ilyen felhasználó</div>
                        </div>
                    </div>
                    <div class="previouschatscont py-5">
                        @foreach ($chatUsers as $chatUser)
                            <div class="py-2">
                                <div class="previouschats d-flex p-3 @if (isset($user) && $user->User_id == $chatUser->User_id) active-user @endif">
                                    @if ($chatUser->unread > 0)
                                        <span class="h-25 iconka rounded-pill bg-danger">
                                            {{ $chatUser->unread }}
                                        </span>
                                    @endif


                                    {{-- Profilkép --}}
                                    @if ($chatUser->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                        <a href="/profile/{{ $chatUser->User_id }}">
                                            <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                        </a>
                                    @else
                                        <a href="/profile/{{ $chatUser->User_id }}">
                                            <img src="{{ asset('assets/img/profile_picture/' . $chatUser->user_profile_picture) }}"
                                                style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                        </a>
                                    @endif


                                    {{-- Üzenet adatok --}}
                                    <a href="{{ route('messages.show', $chatUser->User_id) }}"
                                        class="list-group-item list-group-item-action border-0 w-100 px-3 my-auto">
                                        <div class="d-grid justify-content-between align-items-center">
                                            <strong class="fs-3">{{ $chatUser->username }}</strong>


                                        </div>

                                        @if ($chatUser->lastMessage)
                                            <p class="mb-0 text-muted fs-5">
                                                @if ($chatUser->lastMessage->Sender_Id == auth()->id())
                                                    <strong>Te:</strong>
                                                @else
                                                    <strong class="fs-5">{{ $chatUser->username }}:</strong>
                                                @endif
                                                {{ Str::limit($chatUser->lastMessage->Message_Text, 20) }}
                                                <small class="text-white fs-6 mr-auto" style="float: right">
                                                    {{ $chatUser->lastMessage->created_at }}
                                                </small>
                                            </p>
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
                            <div class="topconti p-3">
                                <h2 class="text-center text-white px-auto"> {{ $user->username }}</h2>
                            </div>


                            {{-- @foreach ($messages as $message)
                                @if ($message->Sender_Id == auth()->id())
                                    <div class="p-3">
                                        <div class="uzenet1 ms-auto">
                                            <small
                                                style="float: right"><i>{{ date_format(date_create($message->created_at), 'Y-m-d H:i:s') }}</i></small>
                                            @if ($message->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                                <a href="/profil"><img
                                                        src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @else
                                                <a href="/profil"><img
                                                        src="{{ asset('assets/img/profile_picture/' . $message->user_profile_picture) }}"
                                                        style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                            @endif
                                            <div
                                                class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">


                                                <p>Te: </p>

                                                <p>{{ $message->Message_Text }} </p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="p-3">
                                            <div class="uzenet1 me-start">
                                                <small
                                                    style="float: right"><i>{{ date_format(date_create($message->created_at), 'Y-m-d H:i:s') }}</i></small>
                                                @if ($message->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                                    <a href="/profile/{{ $message->User_Id }}"><img
                                                            src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                            style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                                @else
                                                    <a href="/profile/{{ $message->User_Id }}"><img
                                                            src="{{ asset('assets/img/profile_picture/' . $message->receiver_user_profile_picture) }}"
                                                            style="width: 100px; height: 100px; border-radius: 50px; cursor: pointer; object-fit: cover;"></a>
                                                @endif
                                                <div
                                                    class="{{ $message->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">

                                                    <p>{{ $message->username }} </p>
                                                    @if ($message->sender_id != auth()->id() && $message->new_message)
                                                        <span class="unread-dot"></span>
                                                    @endif

                                                    <p>{{ $message->Message_Text }} </p>
                                                </div>
                                            </div>
                                @endif


                        </div>
                    @endforeach --}}

                            @foreach ($messages as $message)
                                @if ($message->Sender_Id == auth()->id())
                                    {{-- Saját üzenet --}}
                                    <div class="p-3">
                                        <div class="uzenet1 ms-auto">
                                            <small
                                                style="float: right"><i>{{ date_format(date_create($message->created_at), 'Y-m-d H:i:s') }}</i></small>

                                            @if ($message->sender->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                                <a href="/profil">
                                                    <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                        style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="/profil">
                                                    <img src="{{ asset('assets/img/profile_picture/' . $message->sender->user_profile_picture) }}"
                                                        style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                                </a>
                                            @endif

                                            <div class="text-left">
                                                <p>Te: </p>
                                                <p>{{ $message->Message_Text }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Másik felhasználó üzenete --}}
                                    <div class="p-3">
                                        <div class="uzenet1 me-start">
                                            <small style="float: right"><i>{{ $message->created_at }}</i></small>

                                            @if ($message->sender->user_profile_picture == 'assets/img/profile_picture/default-avatar.jpg')
                                                <a href="/profile/{{ $message->sender->User_Id }}">
                                                    <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}"
                                                        style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="/profile/{{ $message->sender->User_Id }}">
                                                    <img src="{{ asset('assets/img/profile_picture/' . $message->sender->user_profile_picture) }}"
                                                        style="width: 75px; height: 75px; border-radius: 50px; cursor: pointer; object-fit: cover;">
                                                </a>
                                            @endif

                                            <div class="text-left">
                                                <p>{{ $message->sender->username }} </p>
                                                @if ($message->New_Message)
                                                    <span class="unread-dot"></span>
                                                @endif
                                                <p>{{ $message->Message_Text }} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach



                            <div class="conti px-5">
                                <form action="{{ route('messages.send') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-center align-items-center p-3 ps-5 ms-5 ">

                                        <input type="hidden" name="receiver_id" value="{{ $user->User_id }}">
                                        {{-- <a class="btn mx-1" href=""><i class="fa-solid fa-image"></i></a> --}}
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
                //  && user.user_profile_picture == "assets/img/profile_picture/default-avatar.jpg" //

                let hasResults = false;
                users.forEach(user => {
                    if (user.User_id !== loggedInUserId && user.username.toLowerCase().includes(searchValue)) {

                        if (user.user_profile_picture == "assets/img/profile_picture/default-avatar.jpg") {
                            hasResults = true;
                            userList.innerHTML += `
                    <a href="{{ route('messages.show', '') }}/${user.User_id}" class="list-group-item list-group-item-action">
                        <img src="{{ asset('assets/img/profile_picture/default-avatar.jpg') }}" alt="Profilkép" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                        ${user.username}
                    </a>
                `
                        } else {
                            hasResults = true;
                            userList.innerHTML += `
                    <a href="{{ route('messages.show', '') }}/${user.User_id}" class="list-group-item list-group-item-action">
                        <img src="{{ asset('assets/img/profile_picture/${user.user_profile_picture}') }}" alt="Profilkép" style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                        ${user.username}
                    </a>
                `
                        }



                        ;
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
            #user-list-container {
                position: relative;
                /* This establishes a positioning context */
            }

            #user-list {
                position: absolute;
                /* Takes the element out of normal document flow */
                width: 100%;
                /* Matches the width of its container */
                max-height: 300px;
                overflow-y: auto;
                border: 1px solid #ddd;
                border-radius: 4px;
                background: white;
                /* Important for overlapping content */
                z-index: 1000;
                /* Ensures it appears above other content */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                /* Optional: adds visual depth */
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
