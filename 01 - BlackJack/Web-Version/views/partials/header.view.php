<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BlackJack</title>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        html {
            background-color: #f1faee;
        }

        body {
            font-family: Comfortaa;
            font-size: 20px;
        }

        button {
            background-color: #457B9D;
            color: #f1faee;
            height: 50px;
            width: 150px;
            border: none;
            border-radius: 30px;
            padding: 5px 10px;
            margin: 10px 10px;
            font-family: Comfortaa;
            font-size: 20px;
            text-align: center;
            transition: transform 300ms ease;
        }

        .disabled button {
            background-color: #f1faee;
            color: #457B9D;
            border: 1px #457B9D solid;
        }

        .disabled button:hover {
            cursor: not-allowed;
            transform: none;
        }

        button:hover {
            cursor: pointer;
            transform: scale(1.15);
        }

        img {
            width: 175px;
        }

        h3 {
            margin: 10px auto;
        }

        .game-container {
            height: 1000px;
            display: grid;
            grid-template: repeat(3, 1fr) repeat(2, 2fr) repeat(2, 1fr) / repeat(6, 1fr);
            text-align: center;
        }

        .title {
            margin-top: 15px;
            width: 100%;
            grid-area: 1 / 2 / span 1 / span 4;
        }

        .money {
            margin-top: 10px;
            grid-area: 2 / 2 / span 1 / span 4;
        }

        .bet-button-a {
            grid-area: 3 / 2 / span 1 / span 1;
        }

        .bet-button-b {
            grid-area: 3 / 3 / span 1 / span 1;
        }

        .bet-button-c {
            grid-area: 3 / 4 / span 1 / span 1;
        }

        .bet-button-d {
            grid-area: 3 / 5 / span 1 / span 1;
        }

        .bet-message {
            grid-area: 3 / 2 / span 1 / span 4;
        }

        .dealer {
            grid-area: 4 / 2 / span 1 / span 4;
        }

        .player {
            grid-area: 5 / 2 / span 1 / span 4;
        }

        .hit-button {
            grid-area: 6 / 3 / span 1 / span 1;
        }

        .stand-button {
            grid-area: 6 / 4 / span 1 / span 1;
        }

        .game-end-controls {
            grid-area: 6 / 3 / span 1 / span 2;
        }

    </style>
</head>

<body>
