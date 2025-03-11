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
        <div class="container">
            <h2>Üzenet küldése</h2>
            <form id="messageForm">
                <label for="receiverId">Címzett ID:</label>
                <input type="number" id="receiverId" required>

                <label for="messageText">Üzenet:</label>
                <textarea id="messageText" required></textarea>

                <button type="submit">Küldés</button>
            </form>

            <h2>Üzenetek</h2>
            <div id="messagesContainer"></div>

            <script>
                document.getElementById('messageForm').addEventListener('submit', function(event) {
                    event.preventDefault();

                    const receiverId = document.getElementById('receiverId').value;
                    const messageText = document.getElementById('messageText').value;

                    fetch('/api/send-message', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel CSRF token
                                'Authorization': 'Bearer ' + localStorage.getItem('token') // Auth token
                            },
                            body: JSON.stringify({
                                receiver_id: receiverId,
                                message_text: messageText
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Üzenet sikeresen küldve
                            loadMessages(receiverId);
                        })
                        .catch(error => {
                            console.error('Hiba:', error);
                        });
                });

                function loadMessages(userId) {
                    fetch(`/api/get-messages/${userId}`, {
                            method: 'GET',
                            headers: {
                                'Authorization': 'Bearer ' + localStorage.getItem('token') // Auth token
                            }
                        })
                        .then(response => response.json())
                        .then(messages => {
                            const messagesContainer = document.getElementById('messagesContainer');
                            messagesContainer.innerHTML = '';

                            messages.forEach(message => {
                                const messageElement = document.createElement('div');
                                messageElement.textContent = `${message.sender_id}: ${message.message_text}`;
                                messagesContainer.appendChild(messageElement);
                            });
                        });
                }
            </script>
        </div>

    </main>
@endsection
