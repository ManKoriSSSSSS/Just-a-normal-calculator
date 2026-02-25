<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .title {
            font-family: 'Comic Neue', cursive;
            font-size: 8rem;
            color: #ffeb3b;
            transform: rotate(-10deg);
            margin-bottom: 50px;
            text-shadow: 2px 2px 0px #fbc02d;
        }
        .use-button {
            font-family: 'Comic Neue', cursive;
            background-color: #ffe082;
            border: 3px solid black;
            border-radius: 25px;
            padding: 20px 80px;
            font-size: 4rem;
            cursor: pointer;
            transition: transform 0.1s;
        }
        .use-button:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body>

    <div class="title">Calculator</div>
    
    <button class="use-button" onclick="window.location.href='calc/calc.php'">
        USE
    </button>

</body>
</html>
