<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Complex Javascript</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">KALKULATOR</h2>
        <a class="text-sm text-blue-500 hover:text-blue-700 mb-4 block text-center" href="https://github.com/b46usf/kalkulator_php">GITHUB/b46usf</a>
        
        <!-- Tampilan Hasil Kalkulasi -->
        <div class="text-right">
            <input type="text" id="display" class="w-full p-4 text-right text-2xl font-bold bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
                   placeholder="0" readonly>
        </div>
        
        <!-- Tombol Kalkulasi -->
        <div class="grid grid-cols-4 gap-4 mt-4">
            <button class="btn" onclick="appendToDisplay('7')">7</button>
            <button class="btn" onclick="appendToDisplay('8')">8</button>
            <button class="btn" onclick="appendToDisplay('9')">9</button>
            <button class="btn" onclick="appendToDisplay('/')">/</button>

            <button class="btn" onclick="appendToDisplay('4')">4</button>
            <button class="btn" onclick="appendToDisplay('5')">5</button>
            <button class="btn" onclick="appendToDisplay('6')">6</button>
            <button class="btn" onclick="appendToDisplay('*')">*</button>

            <button class="btn" onclick="appendToDisplay('1')">1</button>
            <button class="btn" onclick="appendToDisplay('2')">2</button>
            <button class="btn" onclick="appendToDisplay('3')">3</button>
            <button class="btn" onclick="appendToDisplay('-')">-</button>

            <button class="btn" onclick="appendToDisplay('0')">0</button>
            <button class="btn" onclick="appendToDisplay('.')">.</button>
            <button class="btn" onclick="calculateResult()">=</button>
            <button class="btn" onclick="appendToDisplay('+')">+</button>

            <button class="btn col-span-2" onclick="clearDisplay()">C</button>
            <button class="btn" onclick="appendToDisplay('sqrt')">√</button>
            <button class="btn" onclick="appendToDisplay('^')">^</button>
        </div>
    </div>

    <script>
        // Menangani semua interaksi dengan display kalkulator
        let display = document.getElementById("display");

        // Menambahkan angka atau operator ke layar
        function appendToDisplay(value) {
            if (display.value === "0") {
                display.value = value;
            } else {
                display.value += value;
            }
        }

        // Menghitung hasil kalkulasi
        function calculateResult() {
            let expression = display.value;

            // Menangani pangkat (^) dan akar kuadrat (sqrt)
            expression = expression.replace(/sqrt/g, 'Math.sqrt'); // Mengganti "sqrt" menjadi fungsi Math.sqrt
            expression = expression.replace(/\^/g, '**'); // Mengganti tanda pangkat (^) menjadi operator pangkat JavaScript

            try {
                let result = eval(expression); // Menghitung ekspresi matematika
                display.value = result;
            } catch (e) {
                display.value = "Error"; // Menampilkan error jika ekspresi tidak valid
            }
        }

        // Menghapus input
        function clearDisplay() {
            display.value = "0";
        }

        // Menangani input keyboard
        document.addEventListener('keydown', function(event) {
            // Tombol angka dan operator dasar
            const validKeys = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.', '/', '*', '-', '+', 'Enter', 'Backspace'];

            if (validKeys.includes(event.key)) {
                if (event.key === 'Enter') {
                    calculateResult();
                } else if (event.key === 'Backspace') {
                    display.value = display.value.slice(0, -1);
                } else {
                    appendToDisplay(event.key);
                }
            }

            // Menangani akar kuadrat dan pangkat
            if (event.key === 's') {
                appendToDisplay('sqrt');
            } else if (event.key === '^') {
                appendToDisplay('^');
            }
        });
    </script>
</body>
</html>