<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: sans-serif;
        }
        .calc-container {
            width: 320px;
            background-color: #000;
            padding: 20px;
            border-radius: 20px;
        }
        .display {
            width: 100%;
            height: 80px;
            background-color: #222;
            color: white;
            text-align: right;
            font-size: 3rem;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            overflow: hidden;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }
        button {
            aspect-ratio: 1/1;
            border-radius: 50%;
            border: none;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: opacity 0.1s;
        }
        button:active { opacity: 0.7; }
        .num { background-color: #333; color: white; }
        .op { background-color: #f60; color: white; }
        .spec { background-color: #a5a5a5; color: black; }
        .zero-btn {
            grid-column: span 2;
            aspect-ratio: unset;
            height: 65px;
            border-radius: 35px;
        }
        
        #jumpscare-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: url('Sick.jpg') center/cover no-repeat;
            z-index: 9999;
        }
    </style>
</head>
<body>

<div id="jumpscare-overlay"></div>
<audio id="screamer-audio" src="scary-maze-screamer-sound.mp3"></audio>

<div class="calc-container">
    <div class="display" id="screen">0</div>
    <div class="grid">
        <button class="spec" onclick="clearScreen()">AC</button>
        <button class="spec" onclick="append('00')">00</button>
        <button class="spec" onclick="append('%')">%</button>
        <button class="op" onclick="append('/')">÷</button>
        
        <button class="num" onclick="append('7')">7</button>
        <button class="num" onclick="append('8')">8</button>
        <button class="num" onclick="append('9')">9</button>
        <button class="op" onclick="append('*')">×</button>
        
        <button class="num" onclick="append('4')">4</button>
        <button class="num" onclick="append('5')">5</button>
        <button class="num" onclick="append('6')">6</button>
        <button class="op" onclick="append('-')">-</button>
        
        <button class="num" onclick="append('1')">1</button>
        <button class="num" onclick="append('2')">2</button>
        <button class="num" onclick="append('3')">3</button>
        <button class="op" onclick="append('+')">+</button>
        
        <button class="num zero-btn" onclick="append('0')">0</button>
        <button class="num" onclick="append('.')">.</button>
        <button class="op" onclick="calculate()">=</button>
    </div>
</div>

<script>
    let currentInput = "0";

    function updateDisplay() {
        document.getElementById('screen').innerText = currentInput;
    }

    function append(val) {
        if (currentInput === "0" && val !== ".") {
            currentInput = val;
        } else {
            currentInput += val;
        }
        updateDisplay();
    }

    function clearScreen() {
        currentInput = "0";
        updateDisplay();
    }

    function calculate() {
        try {
            // Check for division by zero manually
            if (currentInput.includes('/0')) {
                triggerJumpscare();
                return;
            }
            
            let result = eval(currentInput);
            currentInput = String(result);
            updateDisplay();
        } catch (e) {
            currentInput = "Error";
            updateDisplay();
        }
    }

    function triggerJumpscare() {
        const overlay = document.getElementById('jumpscare-overlay');
        const audio = document.getElementById('screamer-audio');
        
        overlay.style.display = 'block';
        audio.play().catch(e => console.log("browser saved you man"));
        
        setTimeout(() => {
            window.location.href = 'comments.php';
        }, 2000);
    }
</script>

</body>
</html>
