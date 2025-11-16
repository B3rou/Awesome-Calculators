# Scientific Calculator Tests

## Running Tests

```bash
cd ScientificCalculator-PHP-Hodemcsuk
php tests/run_tests.php
```

Or directly:

```bash
php tests/CalculatorTest.php
```

## Test Coverage

The test suite covers:

### Trigonometric Functions
- `sin()`, `cos()`, `tan()` in both DEG and RAD modes
- Standard angles (0°, 30°, 45°, 60°, 90°, 180°)
- Edge cases and precision

### Logarithmic Functions
- `log()` - base 10 logarithm
- `ln()` - natural logarithm
- Mathematical identities (log(10)=1, ln(e)=1)

### Exponential & Root Functions
- `exp()` - exponential function
- `sqrt()` - square root
- `^` - power operator
- Various input values

### Factorial
- `n!` notation
- Edge cases (0!, 1!)
- Large factorials

### Combined Expressions
- Multiple functions: `sin(90) + cos(0)`
- Mixed operations: `sqrt(16) + 2^3`
- Nested functions: `sqrt(sqrt(16))`
- Complex expressions: `(sin(30) + cos(60)) * 10`

### Input Validation
- Negative inputs for ln() and log()
- Negative inputs for sqrt()
- Division by zero in tan()
- Unbalanced parentheses
- Empty expressions

### Edge Cases
- Very small/large numbers
- Order of operations
- Scientific notation results

## Adding New Tests

1. Open `tests/CalculatorTest.php`
2. Add new test method:

```php
public function testNewFeature() {
    echo "\n=== New Feature Tests ===\n";
    $calc = new ScientificCalculator('deg');

    $calc->calculate('your_expression');
    $this->assertApprox($expected, $calc->getResult(), 'Test description');
}
```

3. Call the method in `runAll()`:

```php
public function runAll() {
    // ... existing tests ...
    $this->testNewFeature();
    $this->printResults();
}
```

## Expected Output

```
╔════════════════════════════════════════════╗
║   Scientific Calculator - Test Suite      ║
╚════════════════════════════════════════════╝

=== Trigonometric Functions (Degrees) ===
=== Trigonometric Functions (Radians) ===
=== Logarithmic Functions ===
=== Exponential & Root Functions ===
=== Factorial Function ===
=== Combined Expressions ===
=== Mathematical Constants ===
=== Input Validation & Error Handling ===
=== Edge Cases ===

==================================================
TEST RESULTS
==================================================
✓ sin(0°) = 0
✓ sin(30°) = 0.5
... (more tests)

==================================================
✓ ALL TESTS PASSED
Passed: XX/XX (100%)
Failed: 0/XX
==================================================
```
