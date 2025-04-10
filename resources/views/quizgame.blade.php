@extends('layout')
@section('content')
    <main class="main-block">
        <div class="section3 container">

            <div id="modal2" class="modal2">
                <div class="modal2-content gamemodal ">
                    <h2>Quiz játék teljesítve!</h2>
                    <h5 id="modal-points">Eltalált kérdések: 0/0</h5>
                    <div class="d-flex justify-content-between align-items-center">
                        <form action="/quizgame" method="post">
                            @csrf
                            <input type="hidden" name="points" id="hidden-points" value="0">
                            <input type="hidden" name="game_name" value="Quiz Játék">
                            <button type="submit" class="btn btn-info" id="save-btn">Eredmény mentése</button>
                        </form>
                        <button class="btn btn-info" id="restart-btn">Új játék</button>
                    </div>

                </div>
            </div>


            <div class="config-container">
                <h2 class="config-title">Quiz Játék</h2>


                <div class="config-option">
                    <h4 class="config-title">Válassz kategóriát!</h4>
                    <div class="category-options">
                        <button class="category-option active">Programozás</button>
                        <button class="category-option">Földrajz</button>
                        <button class="category-option">Matematika</button>
                    </div>
                </div>
                <div class="config-option">
                    <h4 class="config-title">Kérdések száma legyen:</h4>
                    <div class="question-options">
                        <button class="question-option">5</button>
                        <button class="question-option active">10</button>
                        <button class="question-option">15</button>
                        <button class="question-option">20</button>
                        <button class="question-option">25</button>
                    </div>



                    <button class="start-quiz-btn">Kezdjük!</button>
                </div>
            </div>

            <div class="quiz-container">
                <header class="quiz-header">
                    <h2 class="quiz-title">Quiz Játék</h2>
                    <h5 id="points" class="text-center fs-3">Pontszám: <span class="points-number">0</span></h5>
                    <div class="quiz-timer d-flex">

                        <span class="material-symbols-outlined my-auto">
                            timer
                        </span>
                        <p class="time-duration fs-5 my-auto">15mp</p>
                    </div>
                </header>


                <div class="quiz-content">
                    <h1 class="question-text text-black" id="question-text"></h1>
                    <ul class="answer-options">

                    </ul>
                </div>
                <div class="quiz-footer">
                    <p class="question-status text-black"></p>
                    <button class="next-question my-auto">Következő ->
                    </button>
                </div>
            </div>

            <div class="result-container">
                <img src="auto.jpg" alt="quiz-over.png" class="result-img">
                <h2 class="result-title">Quiz teljesítve!</h2>
                <p class="result-message"></p>
                <button class="save-again-btn">Mentés</button>
                <button class="try-again-btn">Újra játszom</button>
            </div>



        </div>
        </div>

        <script>
            const configContainer = document.querySelector(".config-container");
            const quizContainer = document.querySelector(".quiz-container");
            const answerOptions = document.querySelector(".answer-options");
            const nextQuestionBth = document.querySelector(".next-question");
            const questionStatus = document.querySelector(".question-status");
            const timerDisplay = document.querySelector(".time-duration");
            const resultContainer = document.querySelector(".result-container");

            const QUIZ_TIME_LIMIT = 15;
            let timer = null;
            let currentTime = QUIZ_TIME_LIMIT;
            let quizCategory = "programozás";
            let numberOfQuestions = 10;
            let currentQuestion = null;
            const questionIndexHistory = [];
            let correctAnswerCount = 0;
            let points = 0;



            // const showQuizResult = () => {
            //     quizContainer.style.display = "none";
            //     resultContainer.style.display = "block"

            //     const resultText = `Eltalált pontjaid: ${correctAnswerCount} a ${numberOfQuestions}-ből`;
            //     document.querySelector(".result-message").innerHTML = resultText;
            // }

            // const showQuizResult = () => {
            //     quizContainer.style.display = "none";
            //     const modal = document.getElementById('modal');
            //     const modalPoints = document.getElementById('modal-points');

            //     modal.style.display = "block";
            //     modalPoints.textContent = `Eltalált kérdések: ${correctAnswerCount}/${numberOfQuestions}`;
            //     document.getElementById('hidden-points').value = correctAnswerCount;
            //     let finalpoints = points;

            // }

            const showQuizResult = () => {
                quizContainer.style.display = "none";
                const modal = document.getElementById('modal');
                const modalPoints = document.getElementById('modal-points');

                modal.style.display = "block";
                modalPoints.textContent = `Pontszám: ${points} (${correctAnswerCount}/${numberOfQuestions} kérdés)`;
                document.getElementById('hidden-points').value = points; // Send points to server
            };




            const resetTimer = () => {
                clearInterval(timer);
                currentTime = QUIZ_TIME_LIMIT;
                timerDisplay.textContent = `${currentTime}mp`
            }

            const startTimer = () => {
                timer = setInterval(() => {
                    currentTime--;
                    timerDisplay.textContent = `${currentTime}mp`

                    if (currentTime <= 0) {
                        clearInterval(timer);
                        highlightCorrectAnswer();
                        answerOptions.querySelectorAll(".answer-option").forEach(option => option.style
                            .pointerEvents = "none");

                        nextQuestionBth.style.visibility = "visible"
                        quizContainer.querySelector(".quiz-timer").style.background = "#ff0000"
                    }
                }, 1000);
            }

            const questions = [{
                    category: "programozás",
                    questions: [{
                            question: "Mi a programozás alapvető célja?",
                            options: ["Számítógépes játékok fejlesztése",
                                "Problémák megoldása algoritmusok segítségével", "Adatbázisok tervezése",
                                "Hardverkomponensek összeszerelése"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nem programozási paradigma?",
                            options: ["Objektum-orientált", "Funkcionális", "Procedurális", "Bináris"],
                            correctAnswer: 3,
                        },
                        {
                            question: "Mit nevezünk változónak a programozásban?",
                            options: ["Egy matematikai egyenletet", "Egy névvel ellátott memóriaterületet",
                                "Egy programfájlt", "Egy programozási nyelvet"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nem adattípus általában?",
                            options: ["Egész szám (integer)", "Lebegőpontos szám (float)", "Karakter (char)",
                                "Algoritmus"
                            ],
                            correctAnswer: 3,
                        },
                        {
                            question: "Mit jelent az OOP rövidítés?",
                            options: ["Object Optimization Process", "Object-Oriented Programming",
                                "Operational Output Protocol", "Organized Operational Programming"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mi az algoritmus?",
                            options: ["Egy programozási nyelv", "Egy lépésről lépésre történő problémamegoldó eljárás",
                                "Egy típusú adatszerkezet", "Egy programfejlesztő eszköz"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mi a függvény elsődleges célja?",
                            options: ["Adatok tárolása", "Egy adott feladat elvégzése és érték visszaadása",
                                "Program sebességének növelése", "Felhasználói felület létrehozása"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mit jelent a syntax error?",
                            options: ["Logikai hiba a programban", "Futási idejű hiba", "Nyelvi szabályok megszegése",
                                "Adattípus-eltérés"
                            ],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mit jelent a debugging?",
                            options: ["Program gyorsítása", "Kód dokumentálása", "Hibák keresése és javítása",
                                "Adatok titkosítása"
                            ],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mit jelent a full stack fejlesztő?",
                            options: ["Aki csak backend-en dolgozik", "Aki csak frontend-en dolgozik",
                                "Aki mind a frontend, mind a backend fejlesztéssel foglalkozik",
                                "Aki csak adatbázisokat tervez"
                            ],
                            correctAnswer: 2,
                        }, {
                            question: "Melyik ciklus futtatja a kódblokkot legalább egyszer?",
                            options: ["for", "while", "do-while", "foreach"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mit csinál a '++' operátor?",
                            options: ["Összeadást", "Megszorozza az értéket", "Növeli az értéket 1-gyel",
                                "Összehasonlít két értéket"
                            ],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik NEM egy adatszerkezet?",
                            options: ["Array", "Stack", "Loop", "Graph"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mit nevezünk 'if statement'-nek?",
                            options: ["Ciklust", "Feltételes utasítást", "Függvényt", "Adattípust"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nyelv fordított kódot generál?",
                            options: ["Python", "Java", "JavaScript", "PHP"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mi a Git fő funkciója?",
                            options: ["Kód fordítása", "Verziókövetés", "Adatbázis kezelés", "Hálózati kommunikáció"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mit jelent a 'DRY' elv?",
                            options: ["Don't Repeat Yourself", "Do Read Your code", "Data Recovery Yield",
                                "Dynamic Runtime Yield"
                            ],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik NEM egy programozási nyelv?",
                            options: ["HTML", "C++", "Ruby", "Swift"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Mi a 'recursion'?",
                            options: ["Adattípus", "Függvény önmagának meghívása", "Hálózati protokoll",
                                "Szoftvertesztelés módszere"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mit kezel az 'IDE'?",
                            options: ["Internetkapcsolatot", "Integrált fejlesztői környezetet", "Input devices",
                                "Image processing"
                            ],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik NEM egy adatbázis kezelő rendszer?",
                            options: ["MySQL", "MongoDB", "React", "PostgreSQL"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mit jelent az 'API'?",
                            options: ["Application Programming Interface", "Automated Program Integration",
                                "Advanced Programming Instruction", "Algorithmic Process Interface"
                            ],
                            correctAnswer: 0,
                        },
                        {
                            question: "Mi a JavaScript alapvető futási környezete?",
                            options: ["Böngésző", "Szövegszerkesztő", "Terminál", "Képszerkesztő"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik NEM egy framework?",
                            options: ["Django", "Laravel", "Angular", "Compiler"],
                            correctAnswer: 3,
                        },
                        {
                            question: "Mi a 'callback function'?",
                            options: ["Visszahívható függvény", "Matematikai művelet", "Grafikus elem",
                                "Adatbázis lekérdezés"
                            ],
                            correctAnswer: 0,
                        }
                    ]
                },
                {
                    category: "földrajz",
                    questions: [{
                            question: "Melyik a legmagasabb hegy a világon?",
                            options: ["K2", "Mount Everest", "Kilimandzsáró", "Mont Blanc"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik folyó a leghosszabb?",
                            options: ["Nílus", "Amazonas", "Jangce", "Mississippi"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik ország nem Európában található?",
                            options: ["Andorra", "Luxemburg", "Kazahsztán", "Szlovénia"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik tenger sósabb az átlagosnál?",
                            options: ["Balti-tenger", "Holt-tenger", "Fekete-tenger", "Északi-tenger"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik várost hívják a 'Arany Kapu városának'?",
                            options: ["New York", "San Francisco", "Dubaj", "Sanghaj"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik kontinensen található a Száhara?",
                            options: ["Afrika", "Dél-Amerika", "Ázsia", "Ausztrália"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik ország nem szigetállam?",
                            options: ["Japán", "Izland", "Brazília", "Fülöp-szigetek"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik a legnagyobb óceán?",
                            options: ["Atlanti-óceán", "Csendes-óceán", "Indiai-óceán", "Jeges-tenger"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik városban található a Szuezi-csatorna?",
                            options: ["Róma", "Isztambul", "Szuez", "Johannesburg"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik nem északi-sarkköri ország?",
                            options: ["Finnország", "Norvégia", "Argentína", "Svédország"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik ország fővárosa Canberra?",
                            options: ["Ausztrália", "Kanada", "Új-Zéland", "Dél-Afrika"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik kontinensen található a Gobi sivatag?",
                            options: ["Afrika", "Dél-Amerika", "Ázsia", "Antarktisz"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik város nevezik 'A Világ Fővárosának'?",
                            options: ["Párizs", "New York", "London", "Tokió"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik országban található a Grand Canyon?",
                            options: ["USA", "Kanada", "Mexikó", "Brazília"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik tó a legnagyobb a Földön?",
                            options: ["Balaton", "Kaszpi-tenger", "Victoria-tó", "Baykal-tó"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nem Észak-Európai ország?",
                            options: ["Finnország", "Svédország", "Olaszország", "Norvégia"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik folyó keresztezi Párizst?",
                            options: ["Szajna", "Rajna", "Duna", "Tajo"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik ország zászlajában látható juharlevél?",
                            options: ["USA", "Kanada", "Japán", "Ausztrália"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nem Skandináv ország?",
                            options: ["Dánia", "Svédország", "Finnország", "Spanyolország"],
                            correctAnswer: 3,
                        },
                        {
                            question: "Melyik kontinens a legnépesebb?",
                            options: ["Európa", "Afrika", "Ázsia", "Dél-Amerika"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik városban található a Szabadság-szobor?",
                            options: ["London", "Párizs", "New York", "Róma"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik országban található az Ayers Rock?",
                            options: ["USA", "Brazília", "Ausztrália", "Dél-Afrika"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik a legkisebb ország a világon?",
                            options: ["Monaco", "Málta", "Vatikán", "San Marino"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik óceánban található a Maldív-szigetek?",
                            options: ["Atlanti", "Indiai", "Csendes", "Északi-sarki"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik várost nevezik 'Az Örök Város'-nak?",
                            options: ["Athén", "Róma", "Bécs", "Isztambul"],
                            correctAnswer: 1,
                        }

                    ]
                },
                {
                    category: "matematika",
                    questions: [{
                            question: "Mennyi 7 x 8 + 4?",
                            options: ["56", "60 ", "52", "64"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik a legkisebb prímszám?",
                            options: ["5", "3", "2", "7"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mennyi 3/4 + 1/2",
                            options: ["4/6", "2/3", "5/4", "3/8"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mennyi a kör kerülete, ha az átmérője 10cm (π = 3,14)",
                            options: ["15,7 cm", "31,4 cm", "62,8 cm", "7,85 cm"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik nem páros szám?",
                            options: ["24", "0", "-6", "17"],
                            correctAnswer: 3,
                        },
                        {
                            question: "Mennyi 5 a négyzeten?",
                            options: ["15", "125", "25", "50"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mennyi gyök alatt a 81",
                            options: ["9", "8", "40,5", "18"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Ha 2x + 5 = 17, mennyi az 'x'?",
                            options: ["5", "6", "7", "8"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mennyi 0,75 x 100?",
                            options: ["7,5", "75", "750", "0,075"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Hány fok a derékszög?",
                            options: ["45", "180", "360", "90"],
                            correctAnswer: 3,
                        },
                        {
                            question: "Mennyi egy derékszögű háromszög átfogója, ha befogói 3 és 4?",
                            options: ["5", "6", "7", "12"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Mennyi 2⁴?",
                            options: ["8", "16", "32", "4"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik a helyes sorrend a műveleti hierarchiában?",
                            options: ["Zárójel, összeadás, szorzás", "Szorzás, zárójel, összeadás",
                                "Zárójel, szorzás, összeadás", "Összeadás, szorzás, zárójel"
                            ],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mennyi 15% 200-nak?",
                            options: ["15", "30", "20", "25"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik a helyes kifejezés (x+3)²-re?",
                            options: ["x²+6x+9", "x²+9", "x²+3x+9", "x²+6x+6"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Hány oldala van egy dekagonnak?",
                            options: ["8", "10", "12", "6"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mennyi 1/3 óra percben kifejezve?",
                            options: ["20", "30", "40", "45"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Melyik szám osztható 3-mal?",
                            options: ["124", "135", "110", "202"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mennyi 0.2 × 0.5?",
                            options: ["0.1", "0.01", "1.0", "0.2"],
                            correctAnswer: 0,
                        },
                        {
                            question: "Mekkora a kocka térfogata 2 cm élhosszal?",
                            options: ["4 cm³", "6 cm³", "8 cm³", "12 cm³"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Melyik prímszám?",
                            options: ["9", "15", "17", "21"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Mennyi 4! (4 faktoriális)?",
                            options: ["16", "24", "12", "8"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Melyik koordináta-rendszerben használjuk a (r, θ) párokat?",
                            options: ["Derékszögű", "Polár", "Henger", "Térbeli"],
                            correctAnswer: 1,
                        },
                        {
                            question: "Mennyi 1 mérföld kilométerben (~1.609 km)?",
                            options: ["1 km", "1.5 km", "1.609 km", "2 km"],
                            correctAnswer: 2,
                        },
                        {
                            question: "Hogyan nevezzük a 90 foknál kisebb szöget?",
                            options: ["Tompaszög", "Hegyesszög", "Meredekszög", "Veszélyesszög"],
                            correctAnswer: 1,
                        }
                    ]
                }


            ]

            const getRandomQuestion = () => {
                const categoryQuestion = questions.find(cat => cat.category.toLowerCase() === quizCategory.toLowerCase())
                    .questions || [];

                if (questionIndexHistory.length >= Math.min(categoryQuestion.length, numberOfQuestions)) {
                    return showQuizResult();
                }



                const availableQuestion = categoryQuestion.filter((_, index) => !questionIndexHistory.includes(index))

                // console.log(categoryQuestion)

                const randomQuestion = categoryQuestion[Math.floor(Math.random() * categoryQuestion.length)];

                questionIndexHistory.push(categoryQuestion.indexOf(randomQuestion))
                return randomQuestion;
            }

            const highlightCorrectAnswer = () => {
                const correctOption = answerOptions.querySelectorAll(".answer-option")[currentQuestion.correctAnswer];
                correctOption.classList.add("correct");
                const iconHTML = `<span class="material-symbols-outlined">
                        check
                        </span>`;
                correctOption.insertAdjacentHTML("beforeend", iconHTML);
            }


            // const handleAnswer = (option, answerIndex) => {
            //     clearInterval(timer);
            //     const isCorrect = currentQuestion.correctAnswer === answerIndex;
            //     option.classList.add(isCorrect ? 'correct' : 'incorrect');




            //     !isCorrect ? highlightCorrectAnswer() : correctAnswerCount++;

            //     const iconHTML = `<span class="material-symbols-outlined">${isCorrect ? 'check_circle' : 'cancel'}</span>`;
            //     option.insertAdjacentHTML("beforeend", iconHTML);

            //     answerOptions.querySelectorAll(".answer-option").forEach(option => option.style.pointerEvents = "none");

            //     nextQuestionBth.style.visibility = "visible";

            //     ///

            //     nextQuestionBth.style.visibility = "visible";
            //     resetTimerStyle();
            // }

            const handleAnswer = (option, answerIndex) => {
                clearInterval(timer);
                const isCorrect = currentQuestion.correctAnswer === answerIndex;
                option.classList.add(isCorrect ? 'correct' : 'incorrect');

                if (isCorrect) {
                    correctAnswerCount++;
                    points += 50; // Add 50 points for correct answer
                    document.querySelector('.points-number').textContent = points; // Update points display
                }

                !isCorrect ? highlightCorrectAnswer() : null;

                const iconHTML = `<span class="material-symbols-outlined">${isCorrect ? 'check_circle' : 'cancel'}</span>`;
                option.insertAdjacentHTML("beforeend", iconHTML);

                answerOptions.querySelectorAll(".answer-option").forEach(option => option.style.pointerEvents = "none");
                nextQuestionBth.style.visibility = "visible";
                resetTimerStyle();
            };

            const renderQuestion = () => {
                currentQuestion = getRandomQuestion();
                if (!currentQuestion) return;

                resetTimer();
                startTimer();

                answerOptions.innerHTML = "";
                nextQuestionBth.style.visibility = "hidden"
                quizContainer.querySelector(".quiz-timer").style.background = "#000000"
                document.querySelector(".question-text").textContent = currentQuestion.question;
                questionStatus.innerHTML =
                    `<b class="text-black my-auto">${questionIndexHistory.length}</b> / <b class="text-black my-auto">${numberOfQuestions}</b> Kérdés`

                currentQuestion.options.forEach((option, index) => {
                    const li = document.createElement("li");
                    li.classList.add('answer-option', 'text-black')
                    li.textContent = option;
                    answerOptions.appendChild(li);
                    li.addEventListener("click", () => handleAnswer(li, index));
                });
            }


            const startQuiz = () => {
                configContainer.style.display = "none";
                quizContainer.style.display = "block";

                quizCategory = configContainer.querySelector(".category-option.active").textContent;
                numberOfQuestions = parseInt(configContainer.querySelector(".question-option.active").textContent);

                renderQuestion();
            }


            document.querySelectorAll(".category-option, .question-option").forEach(option => {
                option.addEventListener("click", () => {
                    option.parentNode.querySelector(".active").classList.remove("active");
                    option.classList.add("active");
                });
            });

            // const resetQuiz = () => {
            //     resetTimer();
            //     correctAnswerCount = 0;
            //     questionIndexHistory.length = 0;
            //     configContainer.style.display = "block";
            //     resultContainer.style.display = "none"; //////////////////////////
            // }

            // const resetQuiz = () => {
            //     resetTimer();
            //     correctAnswerCount = 0;
            //     questionIndexHistory.length = 0;
            //     configContainer.style.display = "block";
            //     resetTimerStyle();
            // }

            const resetQuiz = () => {
                resetTimer();
                correctAnswerCount = 0;
                points = 0; // Reset points
                questionIndexHistory.length = 0;
                configContainer.style.display = "block";
                resetTimerStyle();
                document.querySelector('.points-number').textContent = '0'; // Reset points display
            };



            nextQuestionBth.addEventListener('click', renderQuestion);
            document.querySelector(".try-again-btn").addEventListener("click", resetQuiz);
            document.querySelector(".start-quiz-btn").addEventListener("click", startQuiz);


            document.getElementById('restart-btn').addEventListener('click', () => {
                document.getElementById('modal').style.display = "none";
                resetQuiz();
            });


            const resetTimerStyle = () => {
                quizContainer.querySelector(".quiz-timer").style.background = "#000000";
            }
        </script>
    </main>
@endsection
