# Scientific Calculator - PHP

A comprehensive server-side scientific calculator with Material Design UI, supporting trigonometric, logarithmic, exponential functions, and complex nested expressions.

## Features

- **Trigonometric Functions**: sin, cos, tan, cot (with DEG/RAD mode)
- **Logarithmic Functions**: log (base 10), ln (natural log)
- **Exponential & Root Functions**: exp, sqrt, power (^)
- **Factorial**: n! notation
- **Mathematical Constants**: π (pi), e (Euler's number)
- **Combined Expressions**: Parse and evaluate complex mathematical expressions
- **Input Validation**: Comprehensive error handling and syntax validation
- **Deep Nesting Support**: Up to 20+ levels of nested functions

## Requirements

- PHP 7.0 or higher
- Web server (Apache, Nginx, or PHP built-in server)
- No external dependencies

## Installation

### 1. Using PHP Built-in Server (Development)

```bash
cd ScientificCalculator-PHP-Hodemcsuk
php -S localhost:8000
```

Then open `http://localhost:8000` in your browser.

### 2. Using Apache/Nginx

Copy the folder to your web root (e.g., `/var/www/html/`) and access via browser.

### 3. Using DDEV (Docker-based)

```bash
ddev config --project-type=php
ddev start
ddev launch
```

## File Structure

```
ScientificCalculator-PHP-Hodemcsuk/
├── Calculator.php      # Core calculation logic
├── index.php          # UI and form handling
├── styles.css         # Material Design styling
├── README.md          # This file
├── issue.md           # Original issue requirements
└── tests/
    ├── CalculatorTest.php  # Comprehensive test suite (140+ tests)
    ├── run_tests.php       # Test runner
    └── README.md           # Test documentation
```

## Usage

### Web Interface

1. Open the calculator in your browser
2. Enter mathematical expressions in the input field
3. Use the button pad or type directly
4. Select DEG or RAD mode for trigonometric functions
5. Press "=" or Enter to calculate

### API / Programmatic Usage

```php
<?php
require_once 'Calculator.php';

// Create calculator instance
$calc = new ScientificCalculator('deg'); // 'deg' or 'rad'

// Basic calculation
if ($calc->calculate('sin(45) + cos(45)')) {
    echo $calc->getResult(); // 1.4142135623731
} else {
    echo "Error: " . $calc->getError();
}

// Complex expression
$calc->calculate('sqrt(sin(90)^2 + cos(0)^2) * log(100)');
echo $calc->formatResult($calc->getResult()); // 2.8284271247462

// Factorial
$calc->calculate('10! / (3! * 7!)'); // Combinations C(10,3)
echo $calc->getResult(); // 120

// Constants
$calc->calculate('e^pi');
echo $calc->getResult(); // 23.140692632779

// Nested functions (up to 20+ levels)
$calc->calculate('sqrt(sqrt(sqrt(sqrt(65536))))');
echo $calc->getResult(); // 2
```

### REST API Integration

```php
<?php
// api.php - Simple REST endpoint
require_once 'Calculator.php';

header('Content-Type: application/json');

$expression = $_GET['expr'] ?? $_POST['expr'] ?? '';
$mode = $_GET['mode'] ?? 'deg';

$calc = new ScientificCalculator($mode);

if ($calc->calculate($expression)) {
    echo json_encode([
        'success' => true,
        'result' => $calc->getResult(),
        'formatted' => $calc->formatResult($calc->getResult())
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => $calc->getError()
    ]);
}
```

Usage:
```bash
curl "http://localhost:8000/api.php?expr=sin(45)%2Bcos(45)&mode=deg"
```

## Supported Functions

| Function | Syntax | Description | Example |
|----------|--------|-------------|---------|
| sin | `sin(x)` | Sine (DEG/RAD) | `sin(90)` → 1 |
| cos | `cos(x)` | Cosine (DEG/RAD) | `cos(0)` → 1 |
| tan | `tan(x)` | Tangent (DEG/RAD) | `tan(45)` → 1 |
| cot | `cot(x)` | Cotangent (DEG/RAD) | `cot(45)` → 1 |
| log | `log(x)` | Logarithm base 10 | `log(100)` → 2 |
| ln | `ln(x)` | Natural logarithm | `ln(e)` → 1 |
| exp | `exp(x)` | Exponential (e^x) | `exp(1)` → 2.718... |
| sqrt | `sqrt(x)` | Square root | `sqrt(16)` → 4 |
| ^ | `x^y` | Power | `2^10` → 1024 |
| ! | `n!` | Factorial | `5!` → 120 |
| pi | `pi` or `π` | Pi constant | `pi` → 3.14159... |
| e | `e` | Euler's number | `e` → 2.71828... |

## Operators

- `+` Addition
- `-` Subtraction
- `*` Multiplication
- `/` Division
- `^` Power
- `()` Grouping

## Expression Examples

### Basic Operations
```
sin(90)                    → 1
cos(0)                     → 1
tan(45)                    → 1
log(1000)                  → 3
ln(e^2)                    → 2
sqrt(16)                   → 4
5!                         → 120
2^10                       → 1024
```

### Combined Expressions
```
sin(30) + cos(60)          → 1
(sin(45))^2 + (cos(45))^2  → 1
log(2) + log(5)            → 1
sqrt(3^2 + 4^2)            → 5
10! / (3! * 7!)            → 120
```

### With Constants
```
pi * 2                     → 6.283...
e^2                        → 7.389...
sin(pi/6)                  → 0.5 (in RAD mode)
ln(e) + log(10)            → 2
```

### Nested Functions
```
sin(cos(tan(45)))          → 0.01745...
sqrt(sqrt(256))            → 4
exp(ln(5))                 → 5
log(exp(10)/exp(9))        → 0.4342...
```

### Complex Real-World Calculations
```
# Decibel calculation
10 * log(100)              → 20

# Compound interest: A = P(1+r)^n
1000 * (1.05)^10           → 1628.89

# Pythagorean theorem
sqrt(3^2 + 4^2)            → 5

# Combinations C(10,3)
10! / (3! * 7!)            → 120

# Golden ratio
(1 + sqrt(5)) / 2          → 1.618...
```

## Limitations

### Input Restrictions

1. **Scientific Notation Input**: Direct `1e5` notation is NOT supported in user input
   - ❌ `1e18` → Error
   - ✅ `10^18` → Works
   - Note: Scientific notation in output (e.g., `1.23E-10`) IS supported

2. **Maximum Factorial**: 170! is the maximum
   - ❌ `171!` → Error (overflow)
   - ✅ `170!` → Works

3. **Exponential Overflow**: `exp(x)` where x > 709
   - ❌ `exp(710)` → Error
   - ✅ `exp(709)` → Works

4. **Implicit Multiplication**: Not supported
   - ❌ `2pi` or `10e` → Error
   - ✅ `2*pi` or `10*e` → Works

5. **Euler's Number After Digits**: `e` after a number is not recognized as Euler's number
   - ❌ `10e` → Error (looks like incomplete scientific notation)
   - ✅ `10*e` or `e*10` → Works

### Precision

- Results are rounded to 10 decimal places
- Very small numbers (< 1e-10) displayed in scientific notation
- Very large numbers (> 1e10) displayed in scientific notation
- Floating-point precision issues may occur for very complex calculations

### Nesting Depth

- Maximum ~500 function calls per expression
- Tested up to 20 levels of nesting successfully
- Deep nesting may cause performance slowdown

### Angle Modes

- **DEG mode**: Angles interpreted as degrees (0-360)
- **RAD mode**: Angles interpreted as radians (0-2π)
- Mode affects: sin, cos, tan, cot only
- Results are always in the same unit system

### Error Handling

The calculator validates:
- Balanced parentheses
- Valid operator sequences (no `++`, `**` outside of power, etc.)
- Domain restrictions (no sqrt(-1), log(-1), etc.)
- Empty expressions
- Division by zero in tan/cot at specific angles

## Security Considerations

- Uses PHP's `eval()` for final expression evaluation
- All input is validated and sanitized before eval()
- Only numeric characters, operators, and parentheses are allowed
- No arbitrary code execution possible
- XSS protection via `htmlspecialchars()` in output

## Running Tests

```bash
cd ScientificCalculator-PHP-Hodemcsuk
php tests/run_tests.php
```

The test suite includes 140+ tests covering:
- All trigonometric functions (DEG & RAD)
- Logarithmic functions
- Exponential and root functions
- Factorial calculations
- Combined expressions
- Mathematical constants
- Input validation and error handling
- Edge cases
- Complex real-world calculations
- Mathematical identities
- Ultra-complex multi-function expressions (8-10+ components)
- Deeply nested expressions (12-20 levels)

## Performance

- Simple expressions: < 1ms
- Complex expressions (10+ functions): < 10ms
- Deeply nested (20 levels): < 50ms
- No database queries
- No external API calls
- Stateless calculation (no session required)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Add tests for new functionality
4. Ensure all tests pass
5. Submit a pull request

## Author

Created by Hodemcsuk for the Awesome-Calculators project.

## License

Open source - feel free to use and modify.

## Changelog

### v1.0.0
- Initial release
- Core scientific functions (sin, cos, tan, log, ln, exp, sqrt)
- Factorial support
- Combined expression parsing
- DEG/RAD mode toggle
- Material Design UI
- Comprehensive test suite (125 tests)

### v1.1.0
- Added cotangent (cot) function
- Improved input validation
- Scientific notation support in output
- Increased nesting depth (500 iterations)
- Added deeply nested expression tests
- Total: 140 tests passing
