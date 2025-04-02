@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">

            <div id="modal" class="modal">
                <div class="modal-content gamemodal">
                    <h2>Gratulálok!</h2>
                    <p>Minden párt megtaláltál!</p>
                    <p id="modal-points">Pontjaid: 0</p>
                    <form action="/memorygame" method="post">
                        @csrf
                        <input type="hidden" name="points" id="hidden-points" value="0">
                        <input type="hidden" name="game_name" value="Memória Játék">
                        <button type="submit" class="btn" id="save-btn">Mentés</button>
                    </form>

                    <button class="btn" id="restart-btn">Újra játszani</button>
                </div>
            </div>

            <div class="cont">



                <div class="wrapper">
                    <div class="confetti">
                        <img src="{{ asset('assets/img/memorygame/confetti.gif') }}" alt="Confetti">
                    </div>
                    <h1 id="points" class="text-center fs-1">Pontszamod: </h1>

                    <ul class="cards">
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-1.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-6.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-3.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-2.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-1.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-5.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-2.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-6.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-3.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon" class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-5.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                        <li class="card">
                            <div class="view front-view">
                                <img src="{{ asset('assets/img/memorygame/quest.png') }}" alt="icon"
                                    class="w-100 p-4">
                            </div>
                            <div class="view back-view">
                                <img src="{{ asset('assets/img/memorygame/img-4.png') }}" alt="card-img">
                            </div>
                        </li>
                    </ul>


                </div>
            </div>



        </div>
        </div>
        <script>
            const cards = document.querySelectorAll(".card");
            let matched = 0;
            let cardOne, cardTwo;
            let disableDeck = false;
            let points = 0;

            function flipCard({
                target: clickedCard
            }) {
                if (cardOne !== clickedCard && !disableDeck) {
                    clickedCard.classList.add("flip");
                    if (!cardOne) {
                        return cardOne = clickedCard;
                    }
                    cardTwo = clickedCard;
                    disableDeck = true;
                    let cardOneImg = cardOne.querySelector(".back-view img").src,
                        cardTwoImg = cardTwo.querySelector(".back-view img").src;
                    matchCards(cardOneImg, cardTwoImg);
                }
            }

            function matchCards(img1, img2) {
                if (img1 === img2) {
                    matched++;
                    const targetPoints = points + 25;

                    animatePoints(points, targetPoints);
                    points = targetPoints;

                    if (matched == 8) {
                        setTimeout(() => {
                            showModal();
                            const finalPoints = points;
                            animatePoints(0, finalPoints, 'modal-points');
                            // Extra confetti a játék végén
                            setTimeout(showConfetti, 500);
                            sendPointsToServer(finalPoints);
                            points = 0;
                        }, 1000);
                    }
                    cardOne.removeEventListener("click", flipCard);
                    cardTwo.removeEventListener("click", flipCard);
                    cardOne = cardTwo = "";
                    return disableDeck = false;
                }
                setTimeout(() => {
                    cardOne.classList.add("shake");
                    cardTwo.classList.add("shake");
                }, 400);
                setTimeout(() => {
                    cardOne.classList.remove("shake", "flip");
                    cardTwo.classList.remove("shake", "flip");
                    cardOne = cardTwo = "";
                    disableDeck = false;
                }, 1200);
            }

            function animatePoints(start, end, elementId = 'points') {
                const element = document.getElementById(elementId);
                element.classList.add('animating');


                let current = start;
                const increment = end > start ? 1 : -1;
                const duration = 500;
                const stepTime = Math.abs(Math.floor(duration / (end - start)));

                const timer = setInterval(() => {
                    current += increment;
                    element.innerText = `Pontjaid: ${current}`;

                    if ((increment === 1 && current >= end) || (increment === -1 && current <= end)) {
                        clearInterval(timer);
                        element.innerText = `Pontjaid: ${end}`;
                        setTimeout(() => {
                            element.classList.remove('animating');
                        }, 200);
                    }
                }, stepTime);
            }

            function showConfetti() {
                const confetti = document.querySelector('.confetti');
                confetti.classList.add('active');

                setTimeout(() => {
                    confetti.classList.remove('active');
                }, 2000);
            }

            function showModal() {
                document.getElementById('modal').style.display = 'block';
            }

            // function sendPointsToServer(points) {
            //     fetch('/memorygame', {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // CSRF token
            //             },
            //             body: JSON.stringify({
            //                 points: points,
            //                 game_name: 'Memória Játék'
            //             })
            //         });
            // }

            function sendFormDataToLaravel() {
    const formData = new FormData();
    formData.append('score', 100);
    formData.append('game', 'Memory Game');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    fetch('/memorygame', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    });
}

            function shuffleCard() {
                matched = 0;
                disableDeck = false;
                cardOne = cardTwo = "";
                let arr = [1, 2, 3, 4, 5, 6, 7, 8, 1, 2, 3, 4, 5, 6, 7, 8];
                arr.sort(() => Math.random() > 0.5 ? 1 : -1);
                cards.forEach((card, i) => {
                    card.classList.remove("flip");
                    let imgTag = card.querySelector(".back-view img");
                    imgTag.src = `/assets/img/memorygame/img-${arr[i]}.png`;
                    card.addEventListener("click", flipCard);
                });
            }

            shuffleCard();

            cards.forEach(card => {
                card.addEventListener("click", flipCard);
            });
        </script>
    </main>
@endsection
