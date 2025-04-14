@extends('layout')
@section('content')
    <style>
        .contai {
            position: relative;
            display: flex;
            flex-direction: row;
        }

        .board {
            display: flex;
            width: 40vw;
            height: 40vw;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: #bbada0;
        }

        .square {
            display: flex;
            width: 22%;
            height: 22%;
            margin: 1%;
            border-radius: 3px;
            background: rgba(238, 228, 218, 0.35);
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .elementContainer {
            margin-bottom: 70px;
        }

        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }

        h1 {
            font-size: 70px;
            color: #776e65;
        }

        #scoreElementContainer {
            display: flex;
            flex-direction: column;
            background: #bbada0;
            padding: 15px 25px;
            font-size: 25px;
            font-weight: bold;
            border-radius: 3px;
            color: white;
            text-align: center;
            margin-left: 10px;
        }

        #scoreLabel {
            color: #eee4da;
            font-size: 20px;
        }

        .buttoni {
            width: 180px;
            height: 50px;
            outline: none;
            font-size: large;
            font-weight: bold;
            background-color: #8f7a66;
            color: #f9f6f2;
            border: none;
            border-radius: 3px;
            margin-left: 10px;
            margin-top: 10px;
            cursor: pointer;
        }

        .tile {
            width: 22%;
            height: 22%;
            display: flex;
            z-index: 1;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            font-weight: bold;
            position: absolute;
            color: #f9f6f2;
            background-color: #edc22e;
            transition: top 0.25s, left 0.25s, width 1s, height 1s;
        }

        .row1 {
            top: 75%;
        }

        .row2 {
            top: 51%;
        }

        .row3 {
            top: 27%;
        }

        .row4 {
            top: 3%;
        }

        .column1 {
            left: 3%;
        }

        .column2 {
            left: 27%;
        }

        .column3 {
            left: 51%;
        }

        .column4 {
            left: 75%;
        }

        .value2 {
            color: rgb(119, 110, 101);
            background-color: #eee4da;
        }

        .value4 {
            color: rgb(119, 110, 101);
            background-color: #eee1c9;
        }

        .value8 {
            color: #f9f6f2;
            background-color: #f3b27a;
        }

        .value16 {
            color: #f9f6f2;
            background-color: #f69664;
        }

        .value32 {
            color: #f9f6f2;
            background-color: #f77c5f;
        }

        .value64 {
            color: #f9f6f2;
            background-color: #f75f3b;
        }

        .value128 {
            color: #f9f6f2;
            background-color: #edd073;
        }

        .value256 {
            color: #f9f6f2;
            background-color: #edcc62;
        }

        .value512 {
            color: #f9f6f2;
            background-color: #edc950;
        }

        .value1024 {
            color: #f9f6f2;
            background-color: #edc53f;
            font-size: 40px;
        }

        .value2048 {
            color: #f9f6f2;
            background-color: #edc22e;
            font-size: 40px;
        }

        @keyframes blink {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.7);
            }

            100% {
                transform: scale(1);
            }
        }

        .merged {
            animation: blink 0.25s;
        }

        #alert {
            color: rgb(119, 110, 101);
            background: rgba(238, 228, 218, 0.73);
            font-size: 60px;
            font-weight: bold;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: none;
            position: absolute;
            z-index: 3;
        }

        @media(max-width:600px) {
            .tile {
                font-size: 25px;
            }

            h1 {
                font-size: 40px;
            }

            .buttoni {
                width: 100px;
                height: 30px;
                font-size: small;
            }

            .scoreElementContainer {
                font-size: 16px;
            }

            #scoreLabel {
                font-size: 18px;
            }
        }

        @keyframes blink {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.7);
            }

            100% {
                transform: scale(1);
            }
        }

        .merged {
            animation: blink 0.25s;
        }

        @media (max-width: 600px) {
            .tile {
                font-size: 25px;
            }

            h1 {
                font-size: 40px;
            }

            .buttoni {
                width: 100px;
                height: 30px;
                font-size: small;
            }

            .scoreElementContainer {
                font-size: 16px;
            }

            #scoreLabel {
                font-size: 18px;
            }

            .board {
                padding-top: 5px;
                padding-bottom: 5px;
            }
        }

        #alert {
            color: rgb(119, 110, 101);
            background: rgba(238, 228, 218, 0.73);
            font-size: 60px;
            font-weight: bold;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            display: none;
            position: absolute;
            z-index: 3;
        }
    </style>
    <main class="main-block">
        <div class="section3 container">


            <div class="d-flex align-items-center justify-content-center">
                <div class="contai">
                    <div id="alert"></div>
                    <div class="board">
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                        <div class="square"></div>
                    </div>
                    <div class="tileContainer"></div>
                </div>
                <div class="elementContainer">
                    <div class="title">
                        <h1>2048</h1>
                    </div>
                    <div id="scoreElementContainer">
                        <div id="scoreLabel">Pontszámod</div>
                        <div id="scoreElement">0</div>
                    </div>
                    <div>
                        <button class="newGame buttoni" onclick="startNewGame()">Új játék</button>

                    </div>
                </div>
            </div>



            <script>
                let board = [];
                let score = 0;
                let wonGame = false;
                let tileContainer = document.querySelector(".tileContainer");
                let scoreElement = document.getElementById("scoreElement");
                const alert = document.getElementById("alert");

                createBoard();
                addRandomTile();
                addRandomTile();

                function createBoard() {
                    for (let i = 0; i < 4; i++) {
                        let row = [];
                        for (let j = 0; j < 4; j++) {
                            row.push(0);
                        }
                        board.push(row);
                    }
                }

                function addRandomTile() {
                    let emptyTiles = [];
                    for (let i = 0; i < board.length; i++) {
                        for (let j = 0; j < board[i].length; j++) {
                            if (board[i][j] === 0) {
                                emptyTiles.push([i, j]);
                            }
                        }
                    }
                    let [randomI, randomJ] = emptyTiles[Math.floor(Math.random() * emptyTiles.length)];
                    board[randomI][randomJ] = Math.random() < 0.9 ? 2 : 4;
                    addTileToPage(randomI, randomJ, board[randomI][randomJ]);
                }

                function addTileToPage(row, column, value) {
                    let tile = document.createElement("div");
                    tile.classList.add(
                        "tile",
                        "row" + (row + 1),
                        "column" + (column + 1),
                        "value" + value
                    );
                    tile.innerHTML = value;
                    tileContainer.appendChild(tile);
                    tile.classList.add("merged");
                    tile.addEventListener("animationend", function() {
                        tile.classList.remove("merged");
                    });
                }

                function startNewGame() {
                    alert.style.display = "none";
                    tileContainer.innerHTML = "";
                    scoreElement.innerHTML = 0;
                    board = [];
                    score = 0;
                    wonGame = false;
                    window.addEventListener("keydown", onDirectionKeyPress);
                    createBoard();
                    addRandomTile();
                    addRandomTile();
                }

                function continuePlaying() {
                    alert.style.display = "none";
                    window.addEventListener("keydown", onDirectionKeyPress);
                }

                window.addEventListener("keydown", onDirectionKeyPress);

                function onDirectionKeyPress(event) {
                    let movePossible;
                    switch (event.key) {
                        case "ArrowUp":
                            movePossible = moveTiles(1, 0);
                            break;
                        case "ArrowDown":
                            movePossible = moveTiles(-1, 0);
                            break;
                        case "ArrowLeft":
                            movePossible = moveTiles(0, -1);
                            break;
                        case "ArrowRight":
                            movePossible = moveTiles(0, 1);
                            break;
                    }
                    if (movePossible) {
                        addRandomTile();
                        let gameOver = isGameOver();
                        if (gameOver.gameOver) showAlert(gameOver.message);
                    }

                }

                function moveTiles(directionY, directionX) {
                    let movePossible = false;
                    let mergedRecently = false;

                    if (directionX != 0) {
                        let startX = directionX === 1 ? 3 : 0;
                        let stepX = directionX === 1 ? -1 : 1;

                        for (let i = 0; i < 4; i++) {
                            let j = startX;
                            while ((j <= 3 && stepX === 1) || (j >= 0 && stepX === -1)) {
                                if (board[i][j] === 0) {
                                    j += stepX;
                                    continue;
                                }
                                let destination = getDestinationSquare(i, j, 0, directionX);
                                let tileClass = ".row" + (i + 1) + ".column" + (j + 1);
                                let tile = document.querySelector(tileClass);
                                if (!destination.merge || (destination.merge && mergedRecently)) {
                                    mergedRecently = false;
                                    destination.destinationX += destination.merge ? stepX : 0;
                                    board[i][destination.destinationX] = board[i][j];
                                    if (destination.destinationX !== j) {
                                        movePossible = true;
                                        board[i][j] = 0;
                                    }
                                    moveTileOnPage(i, destination.destinationX, tile, false);
                                    j += stepX;
                                    continue;
                                }
                                mergedRecently = true;
                                board[i][destination.destinationX] = board[i][j] * 2;
                                score += board[i][destination.destinationX];
                                scoreElement.innerHTML = score;
                                movePossible = true;
                                board[i][j] = 0;
                                moveTileOnPage(i, destination.destinationX, tile, destination.merge);
                                j += stepX;
                            }
                        }
                    } else if (directionY != 0) {
                        let startY = directionY === 1 ? 3 : 0;
                        let stepY = directionY === 1 ? -1 : 1;

                        for (let j = 0; j < 4; j++) {
                            let i = startY;
                            while ((i <= 3 && stepY === 1) || (i >= 0 && stepY === -1)) {
                                if (board[i][j] === 0) {
                                    i += stepY;
                                    continue;
                                }
                                let destination = getDestinationSquare(i, j, directionY, 0);
                                let tileClass = ".row" + (i + 1) + ".column" + (j + 1);
                                let tile = document.querySelector(tileClass);
                                if (!destination.merge || (destination.merge && mergedRecently)) {
                                    mergedRecently = false;
                                    destination.destinationY += destination.merge ? stepY : 0;
                                    board[destination.destinationY][j] = board[i][j];
                                    if (destination.destinationY !== i) {
                                        movePossible = true;
                                        board[i][j] = 0;
                                    }
                                    moveTileOnPage(destination.destinationY, j, tile, false);
                                    i += stepY;
                                    continue;
                                }
                                mergedRecently = true;
                                board[destination.destinationY][j] = board[i][j] * 2;
                                score += board[destination.destinationY][j];
                                scoreElement.innerHTML = score;
                                movePossible = true;
                                board[i][j] = 0;
                                moveTileOnPage(destination.destinationY, j, tile, destination.merge);
                                i += stepY;
                            }
                        }
                    }
                    return movePossible;
                }

                function getDestinationSquare(i, j, directionY, directionX) {
                    let destinationY = i;
                    let destinationX = j;
                    let merge = false;

                    while (
                        (destinationY < 3 && directionY === 1) ||
                        (destinationY > 0 && directionY === -1) ||
                        (destinationX < 3 && directionX === 1) ||
                        (destinationX > 0 && directionX === -1)
                    ) {
                        let nextY = destinationY + directionY;
                        let nextX = destinationX + directionX;
                        let nextCell = board[nextY][nextX];
                        let currentCell = board[i][j];

                        if (nextCell === 0 || nextCell === currentCell) {
                            destinationY = nextY;
                            destinationX = nextX;
                            merge = nextCell === currentCell;
                        }
                        if (nextCell === 0 || nextCell === currentCell) {
                            destinationY = nextY;
                            destinationX = nextX;
                            merge = nextCell === currentCell;
                        }
                        if (nextCell !== 0 && nextCell !== currentCell)
                            break;

                        if (merge)
                            break;
                    }
                    return {
                        merge: merge,
                        destinationY: destinationY,
                        destinationX: destinationX
                    }
                }

                function moveTileOnPage(row, column, tile, merge) {
                    let classes = Array.from(tile.classList);
                    classes.forEach((className) => {
                        if (className.startsWith("row") || className.startsWith("column")) {
                            tile.classList.remove(className);
                        }
                    });
                    tile.classList.add("row" + (row + 1), "column" + (column + 1));
                    if (merge) {
                        let elements = tileContainer.querySelectorAll(".row" + (row + 1) + ".column" + (column + 1));
                        while (elements.length > 1) {
                            tileContainer.removeChild(elements[0]);
                            elements = tileContainer.querySelectorAll(".row" + (row + 1) + ".column" + (column + 1));
                        }
                        elements[0].className = "tile " + "row" + (row + 1) + " column" + (column + 1) + " " + "value" + board[row][
                            column
                        ];
                        elements[0].innerHTML = board[row][column];
                        elements[0].classList.add("merged");
                        elements[0].addEventListener("animationend", function() {
                            tile.classList.remove("merged");
                        });
                    }
                }

                function isGameOver() {
                    let emptySquare = false;
                    for (let i = 0; i < board.length; i++) {
                        for (let j = 0; j < board[i].length; j++) {
                            if (board[i][j] === 0) emptySquare = true;
                            if (board[i][j] === 2048 && !wonGame) return {
                                gameOver: true,
                                message: "Gratulálunk, győztél!"
                            };
                            if (j != 3 && board[i][j] === board[i][j + 1]) emptySquare = true;
                            if (i != 3 && board[i][j] === board[i + 1][j]) emptySquare = true;

                        }
                    }
                    if (emptySquare)
                        return {
                            gameOver: false,
                            message: ""
                        };
                    return {
                        gameOver: true,
                        message: "Itt a játék vége, sok szerencsét a következő játékban!"
                    };


                }


                function showAlert(message) {
                    if (message == "Itt a játék vége, sok szerencsét a következő játékban!") {
                        alert.innerHTML =
                            '<div class="text-center">Itt a játék vége, sok szerencsét a következő játékban! Pontszámod: ' + score +
                            '<form action="/husznegyvennyolc" method="post">' +
                            '@csrf' +
                            '<input type="hidden" name="score" value="' + score + '">' +
                            '<button type="submit" class="newGame buttoni">Pont mentése</button>' +
                            '</form>' +
                            '<button class="newGam buttoni" onclick="startNewGame()">Újrapróbálom</button></div>';
                    }
                    if (message == "Gratulálunk, győztél!") {
                        wonGame = true;
                        alert.innerHTML =
                            '<div>Gratulálunk, győztél!</div> <button class="newGame buttoni" onclick="startNewGame()">New game</button><button class="newGame buttoni" onclick="continuePlaying()">Folytatás</button>';
                        window.removeEventListener("keydown", onDirectionKeyPress);
                    }
                    alert.style.display = "flex";
                    alert.style.flexDirection = "column";
                }

                function addTileAt(x, y, value) {
                    board[x][y] = value;
                    addTileToPage(x, y, board[x][y]);
                }
            </script>

        </div>
        </div>

    </main>
@endsection
