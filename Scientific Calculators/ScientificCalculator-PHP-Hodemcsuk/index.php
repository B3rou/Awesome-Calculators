<?php
/**
 * Scientific Calculator - Main Entry Point
 * Handles user input and displays results
 */

require_once 'Calculator.php';

// Get user inputs
$angleMode = isset($_POST['angle_mode']) ? $_POST['angle_mode'] : 'deg';
$expression = isset($_POST['expression']) ? $_POST['expression'] : '';

// Initialize calculator and process request
$calc = new ScientificCalculator($angleMode);
$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($expression)) {
    if ($calc->calculate($expression)) {
        $result = $calc->formatResult($calc->getResult());
    } else {
        $error = $calc->getError();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scientific Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calculator-container">
        <div class="calculator">
            <form method="POST" action="" id="calc-form">
                <div class="display">
                    <div class="expression-input">
                        <input type="text"
                               name="expression"
                               id="expression"
                               value="<?php echo htmlspecialchars($expression); ?>"
                               placeholder="sin(45) + log(10)"
                               autocomplete="off"
                               spellcheck="false">
                    </div>
                    <div class="result">
                        <?php if ($error): ?>
                            <span class="error"><?php echo htmlspecialchars($error); ?></span>
                        <?php elseif ($result !== null): ?>
                            <?php echo htmlspecialchars($result); ?>
                        <?php else: ?>
                            0
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mode-toggle">
                    <label class="<?php echo $angleMode === 'deg' ? 'active' : ''; ?>">
                        <input type="radio" name="angle_mode" value="deg"
                               <?php echo $angleMode === 'deg' ? 'checked' : ''; ?>>
                        DEG
                    </label>
                    <label class="<?php echo $angleMode === 'rad' ? 'active' : ''; ?>">
                        <input type="radio" name="angle_mode" value="rad"
                               <?php echo $angleMode === 'rad' ? 'checked' : ''; ?>>
                        RAD
                    </label>
                </div>

                <div class="buttons">
                    <button type="button" class="btn function" onclick="appendToExpr('sin(')">sin</button>
                    <button type="button" class="btn function" onclick="appendToExpr('cos(')">cos</button>
                    <button type="button" class="btn function" onclick="appendToExpr('tan(')">tan</button>
                    <button type="button" class="btn function" onclick="appendToExpr('cot(')">cot</button>

                    <button type="button" class="btn function" onclick="appendToExpr('log(')">log</button>
                    <button type="button" class="btn function" onclick="appendToExpr('ln(')">ln</button>
                    <button type="button" class="btn function" onclick="appendToExpr('exp(')">exp</button>
                    <button type="button" class="btn function" onclick="appendToExpr('sqrt(')">√</button>

                    <button type="button" class="btn function" onclick="appendToExpr('^')">x^y</button>
                    <button type="button" class="btn function" onclick="appendToExpr('!')">n!</button>
                    <button type="button" class="btn function" onclick="appendToExpr('pi')">π</button>
                    <button type="button" class="btn function" onclick="appendToExpr('e')">e</button>

                    <button type="button" class="btn function" onclick="appendToExpr('(')">(</button>
                    <button type="button" class="btn function" onclick="appendToExpr(')')">)</button>
                    <button type="button" class="btn clear" onclick="clearExpr()">C</button>
                    <button type="button" class="btn backspace" onclick="backspace()">⌫</button>

                    <button type="button" class="btn number" onclick="appendToExpr('7')">7</button>
                    <button type="button" class="btn number" onclick="appendToExpr('8')">8</button>
                    <button type="button" class="btn number" onclick="appendToExpr('9')">9</button>
                    <button type="button" class="btn operator" onclick="appendToExpr('/')">÷</button>

                    <button type="button" class="btn number" onclick="appendToExpr('4')">4</button>
                    <button type="button" class="btn number" onclick="appendToExpr('5')">5</button>
                    <button type="button" class="btn number" onclick="appendToExpr('6')">6</button>
                    <button type="button" class="btn operator" onclick="appendToExpr('*')">×</button>

                    <button type="button" class="btn number" onclick="appendToExpr('1')">1</button>
                    <button type="button" class="btn number" onclick="appendToExpr('2')">2</button>
                    <button type="button" class="btn number" onclick="appendToExpr('3')">3</button>
                    <button type="button" class="btn operator" onclick="appendToExpr('-')">−</button>

                    <button type="button" class="btn number" onclick="appendToExpr('0')">0</button>
                    <button type="button" class="btn number" onclick="appendToExpr('.')">.</button>
                    <button type="submit" class="btn equals">=</button>
                    <button type="button" class="btn operator" onclick="appendToExpr('+')">+</button>
                </div>
            </form>
        </div>

        <div class="examples">
            <h3>Examples</h3>
            <code>sin(90) + cos(0)</code>
            <code>log(100) * 5</code>
            <code>sqrt(16) + 2^3</code>
            <code>5! / 10</code>
            <code>ln(e) + pi</code>
        </div>
    </div>

    <script>
        const exprInput = document.getElementById('expression');

        function appendToExpr(val) {
            exprInput.value += val;
            exprInput.focus();
        }

        function clearExpr() {
            exprInput.value = '';
            exprInput.focus();
        }

        function backspace() {
            exprInput.value = exprInput.value.slice(0, -1);
            exprInput.focus();
        }

        // Keyboard support
        exprInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('calc-form').submit();
            }
        });
    </script>
</body>
</html>
