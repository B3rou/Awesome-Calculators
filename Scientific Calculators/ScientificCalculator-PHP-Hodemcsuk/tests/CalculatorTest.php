<?php
/**
 * Unit Tests for ScientificCalculator Class
 *
 * Run with: php tests/CalculatorTest.php
 */

require_once __DIR__ . '/../Calculator.php';

class CalculatorTest {
    private $passed = 0;
    private $failed = 0;
    private $tests = [];

    /**
     * Assert that two values are approximately equal
     */
    private function assertApprox($expected, $actual, $message, $tolerance = 0.0001) {
        if (abs($expected - $actual) < $tolerance) {
            $this->passed++;
            $this->tests[] = ['status' => 'PASS', 'message' => $message, 'expected' => $expected, 'actual' => $actual];
            return true;
        }
        $this->failed++;
        $this->tests[] = ['status' => 'FAIL', 'message' => $message, 'expected' => $expected, 'actual' => $actual];
        return false;
    }

    /**
     * Assert that calculation returns an error
     */
    private function assertError($expression, $expectedErrorContains, $calc) {
        $result = $calc->calculate($expression);
        if (!$result && strpos($calc->getError(), $expectedErrorContains) !== false) {
            $this->passed++;
            $this->tests[] = ['status' => 'PASS', 'message' => "Error test: $expression", 'expected' => "Error containing '$expectedErrorContains'", 'actual' => $calc->getError()];
            return true;
        }
        $this->failed++;
        $this->tests[] = ['status' => 'FAIL', 'message' => "Error test: $expression", 'expected' => "Error containing '$expectedErrorContains'", 'actual' => $result ? 'No error' : $calc->getError()];
        return false;
    }

    /**
     * Test basic trigonometric functions in degrees
     */
    public function testTrigonometricDegrees() {
        echo "\n=== Trigonometric Functions (Degrees) ===\n";
        $calc = new ScientificCalculator('deg');

        // sin tests
        $calc->calculate('sin(0)');
        $this->assertApprox(0, $calc->getResult(), 'sin(0°) = 0');

        $calc->calculate('sin(30)');
        $this->assertApprox(0.5, $calc->getResult(), 'sin(30°) = 0.5');

        $calc->calculate('sin(90)');
        $this->assertApprox(1, $calc->getResult(), 'sin(90°) = 1');

        $calc->calculate('sin(180)');
        $this->assertApprox(0, $calc->getResult(), 'sin(180°) = 0');

        // cos tests
        $calc->calculate('cos(0)');
        $this->assertApprox(1, $calc->getResult(), 'cos(0°) = 1');

        $calc->calculate('cos(60)');
        $this->assertApprox(0.5, $calc->getResult(), 'cos(60°) = 0.5');

        $calc->calculate('cos(90)');
        $this->assertApprox(0, $calc->getResult(), 'cos(90°) = 0');

        $calc->calculate('cos(180)');
        $this->assertApprox(-1, $calc->getResult(), 'cos(180°) = -1');

        // tan tests
        $calc->calculate('tan(0)');
        $this->assertApprox(0, $calc->getResult(), 'tan(0°) = 0');

        $calc->calculate('tan(45)');
        $this->assertApprox(1, $calc->getResult(), 'tan(45°) = 1');

        // cot tests (cotangent = 1/tan = cos/sin)
        $calc->calculate('cot(45)');
        $this->assertApprox(1, $calc->getResult(), 'cot(45°) = 1');

        $calc->calculate('cot(30)');
        $this->assertApprox(sqrt(3), $calc->getResult(), 'cot(30°) = √3');

        $calc->calculate('cot(60)');
        $this->assertApprox(1/sqrt(3), $calc->getResult(), 'cot(60°) = 1/√3');
    }

    /**
     * Test trigonometric functions in radians
     */
    public function testTrigonometricRadians() {
        echo "\n=== Trigonometric Functions (Radians) ===\n";
        $calc = new ScientificCalculator('rad');

        $calc->calculate('sin(0)');
        $this->assertApprox(0, $calc->getResult(), 'sin(0) = 0');

        $calc->calculate('sin(pi/2)');
        $this->assertApprox(1, $calc->getResult(), 'sin(π/2) = 1');

        $calc->calculate('cos(0)');
        $this->assertApprox(1, $calc->getResult(), 'cos(0) = 1');

        $calc->calculate('cos(pi)');
        $this->assertApprox(-1, $calc->getResult(), 'cos(π) = -1');

        $calc->calculate('tan(pi/4)');
        $this->assertApprox(1, $calc->getResult(), 'tan(π/4) = 1');
    }

    /**
     * Test logarithmic functions
     */
    public function testLogarithmic() {
        echo "\n=== Logarithmic Functions ===\n";
        $calc = new ScientificCalculator('deg');

        // log (base 10)
        $calc->calculate('log(1)');
        $this->assertApprox(0, $calc->getResult(), 'log(1) = 0');

        $calc->calculate('log(10)');
        $this->assertApprox(1, $calc->getResult(), 'log(10) = 1');

        $calc->calculate('log(100)');
        $this->assertApprox(2, $calc->getResult(), 'log(100) = 2');

        $calc->calculate('log(1000)');
        $this->assertApprox(3, $calc->getResult(), 'log(1000) = 3');

        // ln (natural log)
        $calc->calculate('ln(1)');
        $this->assertApprox(0, $calc->getResult(), 'ln(1) = 0');

        $calc->calculate('ln(e)');
        $this->assertApprox(1, $calc->getResult(), 'ln(e) = 1');

        $calc->calculate('ln(e*e)');
        $this->assertApprox(2, $calc->getResult(), 'ln(e²) = 2');
    }

    /**
     * Test exponential and root functions
     */
    public function testExponentialRoots() {
        echo "\n=== Exponential & Root Functions ===\n";
        $calc = new ScientificCalculator('deg');

        // exp
        $calc->calculate('exp(0)');
        $this->assertApprox(1, $calc->getResult(), 'exp(0) = 1');

        $calc->calculate('exp(1)');
        $this->assertApprox(M_E, $calc->getResult(), 'exp(1) = e');

        $calc->calculate('exp(2)');
        $this->assertApprox(M_E * M_E, $calc->getResult(), 'exp(2) = e²');

        // sqrt
        $calc->calculate('sqrt(0)');
        $this->assertApprox(0, $calc->getResult(), 'sqrt(0) = 0');

        $calc->calculate('sqrt(1)');
        $this->assertApprox(1, $calc->getResult(), 'sqrt(1) = 1');

        $calc->calculate('sqrt(4)');
        $this->assertApprox(2, $calc->getResult(), 'sqrt(4) = 2');

        $calc->calculate('sqrt(16)');
        $this->assertApprox(4, $calc->getResult(), 'sqrt(16) = 4');

        $calc->calculate('sqrt(2)');
        $this->assertApprox(1.41421356, $calc->getResult(), 'sqrt(2) ≈ 1.414');

        // power
        $calc->calculate('2^3');
        $this->assertApprox(8, $calc->getResult(), '2^3 = 8');

        $calc->calculate('3^4');
        $this->assertApprox(81, $calc->getResult(), '3^4 = 81');

        $calc->calculate('10^2');
        $this->assertApprox(100, $calc->getResult(), '10^2 = 100');
    }

    /**
     * Test factorial function
     */
    public function testFactorial() {
        echo "\n=== Factorial Function ===\n";
        $calc = new ScientificCalculator('deg');

        $calc->calculate('0!');
        $this->assertApprox(1, $calc->getResult(), '0! = 1');

        $calc->calculate('1!');
        $this->assertApprox(1, $calc->getResult(), '1! = 1');

        $calc->calculate('5!');
        $this->assertApprox(120, $calc->getResult(), '5! = 120');

        $calc->calculate('10!');
        $this->assertApprox(3628800, $calc->getResult(), '10! = 3,628,800');
    }

    /**
     * Test combined expressions
     */
    public function testCombinedExpressions() {
        echo "\n=== Combined Expressions ===\n";
        $calc = new ScientificCalculator('deg');

        $calc->calculate('sin(90) + cos(0)');
        $this->assertApprox(2, $calc->getResult(), 'sin(90°) + cos(0°) = 2');

        $calc->calculate('sin(30) + cos(60)');
        $this->assertApprox(1, $calc->getResult(), 'sin(30°) + cos(60°) = 1');

        $calc->calculate('tan(45) * 2');
        $this->assertApprox(2, $calc->getResult(), 'tan(45°) * 2 = 2');

        $calc->calculate('sin(90) - cos(180)');
        $this->assertApprox(2, $calc->getResult(), 'sin(90°) - cos(180°) = 2');

        $calc->calculate('log(100) + ln(e)');
        $this->assertApprox(3, $calc->getResult(), 'log(100) + ln(e) = 3');

        $calc->calculate('sqrt(16) + 2^3');
        $this->assertApprox(12, $calc->getResult(), 'sqrt(16) + 2^3 = 12');

        $calc->calculate('5! / 10');
        $this->assertApprox(12, $calc->getResult(), '5! / 10 = 12');

        $calc->calculate('sin(45) * cos(45)');
        $this->assertApprox(0.5, $calc->getResult(), 'sin(45°) * cos(45°) = 0.5');

        $calc->calculate('(sin(30) + cos(60)) * 10');
        $this->assertApprox(10, $calc->getResult(), '(sin(30°) + cos(60°)) * 10 = 10');

        $calc->calculate('sqrt(sin(90) + cos(0) + 2)');
        $this->assertApprox(2, $calc->getResult(), 'sqrt(sin(90°) + cos(0°) + 2) = 2');
    }

    /**
     * Test constants
     */
    public function testConstants() {
        echo "\n=== Mathematical Constants ===\n";
        $calc = new ScientificCalculator('deg');

        $calc->calculate('pi');
        $this->assertApprox(M_PI, $calc->getResult(), 'pi = π');

        $calc->calculate('e');
        $this->assertApprox(M_E, $calc->getResult(), 'e = e');

        $calc->calculate('pi * 2');
        $this->assertApprox(M_PI * 2, $calc->getResult(), 'pi * 2 = 2π');

        $calc->calculate('e^2');
        $this->assertApprox(M_E * M_E, $calc->getResult(), 'e^2 = e²');
    }

    /**
     * Test input validation and error handling
     */
    public function testValidation() {
        echo "\n=== Input Validation & Error Handling ===\n";
        $calc = new ScientificCalculator('deg');

        // Negative input for ln
        $this->assertError('ln(-1)', 'positive', $calc);
        $this->assertError('ln(0)', 'positive', $calc);

        // Negative input for log
        $this->assertError('log(-5)', 'positive', $calc);
        $this->assertError('log(0)', 'positive', $calc);

        // Negative input for sqrt
        $this->assertError('sqrt(-4)', 'non-negative', $calc);

        // Unbalanced parentheses
        $this->assertError('sin(90', 'Invalid', $calc);
        $this->assertError('cos(0))', 'parentheses', $calc);

        // Empty expression
        $this->assertError('', 'Empty', $calc);
    }

    /**
     * Test edge cases
     */
    public function testEdgeCases() {
        echo "\n=== Edge Cases ===\n";
        $calc = new ScientificCalculator('deg');

        // Very small numbers
        $calc->calculate('sin(0.001)');
        $this->assertApprox(sin(deg2rad(0.001)), $calc->getResult(), 'sin(0.001°) - very small angle');

        // Nested functions
        $calc->calculate('sqrt(sqrt(16))');
        $this->assertApprox(2, $calc->getResult(), 'sqrt(sqrt(16)) = 2');

        // Multiple operations
        $calc->calculate('1+2*3-4/2');
        $this->assertApprox(5, $calc->getResult(), '1+2*3-4/2 = 5 (order of operations)');

        // Large factorial
        $calc->calculate('20!');
        $this->assertApprox(2432902008176640000, $calc->getResult(), '20! = 2.43e18', 1e10);
    }

    /**
     * Test complex mathematical expressions
     */
    public function testComplexExpressions() {
        echo "\n=== Complex Mathematical Expressions ===\n";
        $calc = new ScientificCalculator('deg');

        // Triple nested functions
        $calc->calculate('sin(cos(tan(45)))');
        $expected = sin(deg2rad(cos(deg2rad(tan(deg2rad(45))))));
        $this->assertApprox($expected, $calc->getResult(), 'sin(cos(tan(45°))) - triple nesting');

        // Complex arithmetic with functions
        $calc->calculate('(sin(30) + cos(60)) * (tan(45) + 1) / 2');
        $this->assertApprox(1, $calc->getResult(), '(sin(30°) + cos(60°)) * (tan(45°) + 1) / 2 = 1');

        // Pythagorean identity: sin²(x) + cos²(x) = 1
        $calc->calculate('sin(37)^2 + cos(37)^2');
        $this->assertApprox(1, $calc->getResult(), 'sin²(37°) + cos²(37°) = 1 (Pythagorean identity)');

        // Log properties: log(a*b) = log(a) + log(b)
        $calc->calculate('log(2*5)');
        $this->assertApprox(1, $calc->getResult(), 'log(2*5) = log(10) = 1');

        $calc->calculate('log(2) + log(5)');
        $this->assertApprox(1, $calc->getResult(), 'log(2) + log(5) = 1');

        // Exponential and log inverse: ln(exp(x)) = x
        $calc->calculate('ln(exp(3))');
        $this->assertApprox(3, $calc->getResult(), 'ln(exp(3)) = 3');

        // exp(ln(x)) = x
        $calc->calculate('exp(ln(7))');
        $this->assertApprox(7, $calc->getResult(), 'exp(ln(7)) = 7');

        // Complex factorial expression
        $calc->calculate('(5! + 4!) / 3!');
        $this->assertApprox(24, $calc->getResult(), '(5! + 4!) / 3! = (120 + 24) / 6 = 24');

        // Power tower: 2^(3^2) = 2^9 = 512
        $calc->calculate('2^(3^2)');
        $this->assertApprox(512, $calc->getResult(), '2^(3^2) = 2^9 = 512');

        // Golden ratio approximation using sqrt
        $calc->calculate('(1 + sqrt(5)) / 2');
        $this->assertApprox(1.618033988749895, $calc->getResult(), '(1 + √5) / 2 ≈ φ (golden ratio)');

        // Euler's identity component: e^(i*pi) = -1, but we test: e^pi
        $calc->calculate('e^pi');
        $this->assertApprox(pow(M_E, M_PI), $calc->getResult(), 'e^π ≈ 23.14');

        // Complex expression with multiple constants
        $calc->calculate('pi * e + sqrt(2) * sqrt(3)');
        $expected = M_PI * M_E + sqrt(2) * sqrt(3);
        $this->assertApprox($expected, $calc->getResult(), 'π*e + √2*√3 ≈ 10.98');

        // Nested sqrt with arithmetic
        $calc->calculate('sqrt(sqrt(81) + sqrt(16))');
        $this->assertApprox(sqrt(9 + 4), $calc->getResult(), 'sqrt(sqrt(81) + sqrt(16)) = sqrt(13)');

        // Trigonometric + logarithmic combination
        $calc->calculate('sin(90) * log(1000) + cos(0) * ln(e^2)');
        $this->assertApprox(5, $calc->getResult(), 'sin(90°)*log(1000) + cos(0°)*ln(e²) = 1*3 + 1*2 = 5');
    }

    /**
     * Test real-world scientific calculations
     */
    public function testRealWorldCalculations() {
        echo "\n=== Real-World Scientific Calculations ===\n";
        $calc = new ScientificCalculator('deg');

        // Decibel calculation: dB = 10 * log(P2/P1)
        // If P2/P1 = 100, then dB = 20
        $calc->calculate('10 * log(100)');
        $this->assertApprox(20, $calc->getResult(), '10*log(100) = 20 dB');

        // pH calculation: pH = -log([H+])
        // If [H+] = 0.0001, pH = 4
        $calc->calculate('log(10000)');
        $this->assertApprox(4, $calc->getResult(), 'log(10000) = 4 (pH calculation)');

        // Compound interest: A = P(1 + r)^n
        // P=1000, r=0.05, n=10
        $calc->calculate('1000 * (1.05)^10');
        $this->assertApprox(1628.894626777442, $calc->getResult(), '1000*(1.05)^10 ≈ 1628.89');

        // Distance calculation using Pythagorean theorem
        $calc->calculate('sqrt(3^2 + 4^2)');
        $this->assertApprox(5, $calc->getResult(), 'sqrt(3² + 4²) = 5 (Pythagorean theorem)');

        // Projectile motion: range = v²*sin(2θ)/g
        // v=20, θ=45, g=10 -> sin(90)=1, so range = 400/10 = 40
        $calc->calculate('20^2 * sin(90) / 10');
        $this->assertApprox(40, $calc->getResult(), 'v²*sin(2θ)/g = 400*1/10 = 40');

        // Radioactive decay: N = N0 * e^(-λt)
        // N0=1000, λ=0.1, t=5 -> 1000 * e^(-0.5)
        $calc->calculate('1000 * exp(-0.5)');
        $this->assertApprox(1000 * exp(-0.5), $calc->getResult(), '1000*e^(-0.5) ≈ 606.53');

        // Wave frequency: f = 1/(2π√(LC))
        // L=1, C=1 -> f = 1/(2π) ≈ 0.159
        $calc->calculate('1 / (2 * pi * sqrt(1))');
        $this->assertApprox(1 / (2 * M_PI), $calc->getResult(), '1/(2π) ≈ 0.159 Hz');

        // Combinatorics: C(10,3) = 10!/(3!*7!)
        $calc->calculate('10! / (3! * 7!)');
        $this->assertApprox(120, $calc->getResult(), '10!/(3!*7!) = C(10,3) = 120');

        // Standard deviation calculation component
        $calc->calculate('sqrt((4 + 1 + 9) / 3)');
        $this->assertApprox(sqrt(14/3), $calc->getResult(), 'sqrt((4+1+9)/3) ≈ 2.16');
    }

    /**
     * Test mathematical identities
     */
    public function testMathematicalIdentities() {
        echo "\n=== Mathematical Identities ===\n";
        $calc = new ScientificCalculator('deg');

        // Double angle: sin(2x) = 2*sin(x)*cos(x)
        $calc->calculate('sin(60)');
        $sin60 = $calc->getResult();
        $calc->calculate('2 * sin(30) * cos(30)');
        $this->assertApprox($sin60, $calc->getResult(), 'sin(60°) = 2*sin(30°)*cos(30°)');

        // cos(2x) = cos²(x) - sin²(x)
        $calc->calculate('cos(60)');
        $cos60 = $calc->getResult();
        $calc->calculate('cos(30)^2 - sin(30)^2');
        $this->assertApprox($cos60, $calc->getResult(), 'cos(60°) = cos²(30°) - sin²(30°)');

        // tan = sin/cos
        $calc->calculate('sin(45) / cos(45)');
        $this->assertApprox(1, $calc->getResult(), 'sin(45°)/cos(45°) = tan(45°) = 1');

        // log(x^n) = n*log(x)
        $calc->calculate('log(8)');
        $log8 = $calc->getResult();
        $calc->calculate('3 * log(2)');
        $this->assertApprox($log8, $calc->getResult(), 'log(8) = 3*log(2)');

        // e^(a+b) = e^a * e^b
        $calc->calculate('exp(3)');
        $exp3 = $calc->getResult();
        $calc->calculate('exp(1) * exp(2)');
        $this->assertApprox($exp3, $calc->getResult(), 'e³ = e¹ * e²');

        // sqrt(a*b) = sqrt(a) * sqrt(b)
        $calc->calculate('sqrt(12)');
        $sqrt12 = $calc->getResult();
        $calc->calculate('sqrt(3) * sqrt(4)');
        $this->assertApprox($sqrt12, $calc->getResult(), '√12 = √3 * √4');
    }

    /**
     * Test ultra-complex expressions with 8-10+ components
     * Each expression combines multiple function types: sin, cos, tan, log, ln, exp, sqrt, factorial, power
     */
    public function testUltraComplexExpressions() {
        echo "\n=== Ultra-Complex Multi-Function Expressions ===\n";
        $calc = new ScientificCalculator('deg');

        // Test 1: All trig + log + factorial + power
        $calc->calculate('sin(30) + cos(60) + tan(45) + log(10) + ln(e) + 3! / 2^2');
        $expected = 0.5 + 0.5 + 1 + 1 + 1 + 6/4;
        $this->assertApprox($expected, $calc->getResult(), 'Test 1: sin + cos + tan + log + ln + factorial/power');

        // Test 2: Nested trig with log and sqrt
        $calc->calculate('sqrt(sin(90)^2 + cos(0)^2) * log(100) + ln(exp(2)) - tan(45)');
        $expected = sqrt(1 + 1) * 2 + 2 - 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 2: sqrt(sin²+cos²) * log + ln - tan');

        // Test 3: Triple factorial with trig and exp
        $calc->calculate('(5! - 4!) * sin(90) / (3! + exp(0)) + cos(180) * log(1000)');
        $expected = (120 - 24) * 1 / (6 + 1) + (-1) * 3;
        $this->assertApprox($expected, $calc->getResult(), 'Test 3: (5!-4!) * sin / (3!+exp) + cos*log');

        // Test 4: Power tower with trig and log
        $calc->calculate('2^(sin(90) + cos(0) + tan(45)) * log(10) + sqrt(ln(e^4))');
        $expected = pow(2, 1+1+1) * 1 + sqrt(4);
        $this->assertApprox($expected, $calc->getResult(), 'Test 4: 2^(sin+cos+tan) * log + sqrt(ln)');

        // Test 5: Complex fraction with all operators
        $calc->calculate('(sin(60) * cos(30) + tan(45)) / (log(100) - ln(1)) + sqrt(4!) - exp(1)');
        $expected = (sin(deg2rad(60)) * cos(deg2rad(30)) + 1) / (2 - 0) + sqrt(24) - M_E;
        $this->assertApprox($expected, $calc->getResult(), 'Test 5: (sin*cos+tan)/(log-ln) + sqrt(4!) - exp');

        // Test 6: Quadruple nested functions
        $calc->calculate('sin(cos(tan(45) * 30) + log(10)) + ln(exp(sqrt(16))) * 2!');
        $expected = sin(deg2rad(cos(deg2rad(1*30)) + 1)) + log(exp(4)) * 2;
        $this->assertApprox($expected, $calc->getResult(), 'Test 6: sin(cos(tan*30)+log) + ln(exp(sqrt)) * 2!');

        // Test 7: Factorial chain with trig
        $calc->calculate('(6! / 5! + 4! / 3!) * sin(30) * cos(60) + tan(0) + log(1) + ln(1)');
        $expected = (6 + 4) * 0.5 * 0.5 + 0 + 0 + 0;
        $this->assertApprox($expected, $calc->getResult(), 'Test 7: (6!/5! + 4!/3!) * sin*cos + tan + log + ln');

        // Test 8: Exponential decay with trig amplitude
        $calc->calculate('sin(90) * exp(-ln(2)) + cos(0) * sqrt(log(10000)) + tan(45) * 3!');
        $expected = 1 * exp(-log(2)) + 1 * sqrt(4) + 1 * 6;
        $this->assertApprox($expected, $calc->getResult(), 'Test 8: sin*exp(-ln) + cos*sqrt(log) + tan*3!');

        // Test 9: Pi and e with all functions
        $calc->calculate('sin(90) * pi + cos(0) * e + log(10) * sqrt(4) + ln(e) * 2! + tan(45)^3');
        $expected = 1 * M_PI + 1 * M_E + 1 * 2 + 1 * 2 + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 9: sin*π + cos*e + log*sqrt + ln*2! + tan³');

        // Test 10: Harmonic-like series with functions
        $calc->calculate('1/sin(90) + 1/cos(0) + 1/tan(45) + 1/log(10) + 1/ln(e) + 1/sqrt(1) + 1/exp(0) + 1/1!');
        $expected = 1/1 + 1/1 + 1/1 + 1/1 + 1/1 + 1/1 + 1/1 + 1/1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 10: Sum of reciprocals (1/sin + 1/cos + ...)');

        // Test 11: Alternating signs with mixed functions
        $calc->calculate('sin(90) - cos(180) + tan(45) - log(0.1) + ln(e^2) - sqrt(9) + 4! / 6 - 2^3');
        $expected = 1 - (-1) + 1 - (-1) + 2 - 3 + 4 - 8;
        $this->assertApprox($expected, $calc->getResult(), 'Test 11: Alternating signs with 8 terms');

        // Test 12: Product of all function types
        $calc->calculate('sin(90) * cos(0) * tan(45) * log(10) * ln(e) * sqrt(4) * exp(0) * 2!');
        $expected = 1 * 1 * 1 * 1 * 1 * 2 * 1 * 2;
        $this->assertApprox($expected, $calc->getResult(), 'Test 12: Product of 8 functions');

        // Test 13: Squared functions sum
        $calc->calculate('sin(45)^2 + cos(45)^2 + tan(45)^2 + log(10)^2 + ln(e)^2 + sqrt(4)^2 + (2!)^2 + exp(0)^2');
        $expected = 0.5 + 0.5 + 1 + 1 + 1 + 4 + 4 + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 13: Sum of squared functions');

        // Test 14: Complex denominators
        $calc->calculate('100 / (sin(90) + cos(0) + tan(45) + log(10) + ln(e) + sqrt(1) + exp(0) + 1! + 2!)');
        $expected = 100 / (1 + 1 + 1 + 1 + 1 + 1 + 1 + 1 + 2);
        $this->assertApprox($expected, $calc->getResult(), 'Test 14: 100 / (sum of 9 functions)');

        // Test 15: Pythagorean with extras
        $calc->calculate('sqrt(sin(53.13)^2 + cos(53.13)^2) + log(1000)/3 + ln(e^3)/3 + tan(45) + 3!/6 + exp(0)');
        $expected = 1 + 1 + 1 + 1 + 1 + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 15: Pythagorean identity + normalized terms');

        // Test 16: Exponential chain
        $calc->calculate('exp(ln(sin(90) + cos(0))) * log(exp(10)/exp(9)) + sqrt(tan(45) * 16) + 4!/24');
        $expected = exp(log(2)) * log10(exp(1)) + sqrt(16) + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 16: exp(ln(sin+cos)) * log(exp) + sqrt + factorial');

        // Test 17: Fibonacci-like with functions
        $calc->calculate('sin(90) + cos(0) + (sin(90)+cos(0)) + log(10) + (cos(0)+log(10)) + ln(e) + sqrt(4) + tan(45)');
        $expected = 1 + 1 + 2 + 1 + 2 + 1 + 2 + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 17: Fibonacci-like pattern with functions');

        // Test 18: Geometric mean approximation
        $calc->calculate('sqrt(sin(90) * cos(0) * tan(45) * log(10) * ln(e) * sqrt(4) * exp(0) * 2! * 3! * 4!)');
        $expected = sqrt(1 * 1 * 1 * 1 * 1 * 2 * 1 * 2 * 6 * 24);
        $this->assertApprox($expected, $calc->getResult(), 'Test 18: sqrt of product of 10 terms');

        // Test 19: Weighted average
        $calc->calculate('(2*sin(90) + 3*cos(0) + 4*tan(45) + 5*log(10) + 6*ln(e) + 7*sqrt(1) + 8*exp(0) + 9*1!) / 44');
        $expected = (2*1 + 3*1 + 4*1 + 5*1 + 6*1 + 7*1 + 8*1 + 9*1) / 44;
        $this->assertApprox($expected, $calc->getResult(), 'Test 19: Weighted sum / 44 = 1');

        // Test 20: Power ladder
        $calc->calculate('sin(90)^1 + cos(0)^2 + tan(45)^3 + log(10)^4 + ln(e)^5 + sqrt(4)^2 + exp(0)^1 + (2!)^3');
        $expected = 1 + 1 + 1 + 1 + 1 + 4 + 1 + 8;
        $this->assertApprox($expected, $calc->getResult(), 'Test 20: Functions raised to increasing powers');

        // Test 21: Circular function composition
        $calc->calculate('sin(cos(tan(45)*45)) * log(ln(exp(exp(1)))) + sqrt(sqrt(256)) + 5!/4! + 2^(3^1)');
        $expected = sin(deg2rad(cos(deg2rad(45)))) * log10(log(exp(M_E))) + 4 + 5 + 8;
        $this->assertApprox($expected, $calc->getResult(), 'Test 21: Deeply nested with multiple operations');

        // Test 22: Subtraction chain
        $calc->calculate('10! / 9! - 8! / 7! - sin(90) - cos(0) - tan(45) - log(10) - ln(e) - sqrt(1) - exp(0)');
        $expected = 10 - 8 - 1 - 1 - 1 - 1 - 1 - 1 - 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 22: Factorial ratios minus all functions');

        // Test 23: Mixed parentheses complexity
        $calc->calculate('((sin(30) + cos(60)) * (tan(45) + log(10))) / ((ln(e) + sqrt(4)) - (exp(0) - 2!))');
        $expected = ((0.5 + 0.5) * (1 + 1)) / ((1 + 2) - (1 - 2));
        $this->assertApprox($expected, $calc->getResult(), 'Test 23: Complex parentheses structure');

        // Test 24: Trigonometric sum formula
        $calc->calculate('sin(30)*cos(60) + cos(30)*sin(60) + tan(45)*log(10) + ln(e)*sqrt(9) + exp(0)*3! + 2^4/8');
        $expected = 0.5*0.5 + cos(deg2rad(30))*sin(deg2rad(60)) + 1*1 + 1*3 + 1*6 + 2;
        $this->assertApprox($expected, $calc->getResult(), 'Test 24: Trig product sums with other functions');

        // Test 25: Logarithmic identities
        $calc->calculate('log(10^3) + ln(e^4) - sqrt(25) + sin(90)*cos(0)*tan(45) + 5!/120 + 2^(1+1+1)');
        $expected = 3 + 4 - 5 + 1*1*1 + 1 + 8;
        $this->assertApprox($expected, $calc->getResult(), 'Test 25: Log identities with trig and factorial');

        // Test 26: Exponential growth model
        $calc->calculate('1000 * exp(ln(1.1) * 10) / sin(90) + cos(0) * log(100) * sqrt(16) * tan(45) * 2!');
        $expected = 1000 * pow(1.1, 10) / 1 + 1 * 2 * 4 * 1 * 2;
        $this->assertApprox($expected, $calc->getResult(), 'Test 26: Compound growth with multiple factors');

        // Test 27: Alternating products and quotients
        $calc->calculate('sin(90) * cos(0) / tan(45) * log(100) / ln(e) * sqrt(9) / exp(0) * 3! / 2^2');
        $expected = 1 * 1 / 1 * 2 / 1 * 3 / 1 * 6 / 4;
        $this->assertApprox($expected, $calc->getResult(), 'Test 27: Chain of * and / with 9 terms');

        // Test 28: Scientific notation calculation
        $calc->calculate('(sin(90) + cos(0)) * 10^6 / (tan(45) + log(10)) / (ln(e) + sqrt(1)) / (exp(0) + 1!) / 5!');
        $expected = 2 * 1000000 / 2 / 2 / 2 / 120;
        $this->assertApprox($expected, $calc->getResult(), 'Test 28: Large number with cascading divisions');

        // Test 29: Quadratic formula components
        $calc->calculate('(-sin(90) + sqrt(cos(0)^2 + 4*tan(45)*log(100))) / (2*ln(e)) + exp(0) * 3! - sqrt(4!)');
        $expected = (-1 + sqrt(1 + 8)) / 2 + 1 * 6 - sqrt(24);
        $this->assertApprox($expected, $calc->getResult(), 'Test 29: Quadratic formula pattern');

        // Test 30: Ultimate stress test
        $calc->calculate('sin(30)^2 + cos(60)^2 + tan(45) * log(1000)/3 + ln(e^6)/6 + sqrt(sqrt(256)) + 6!/720 + 2^(2^2) / 16 + exp(ln(pi)) / pi');
        $expected = 0.25 + 0.25 + 1*3/3 + 6/6 + 4 + 1 + 16/16 + 1;
        $this->assertApprox($expected, $calc->getResult(), 'Test 30: Ultimate 10-component stress test');
    }

    /**
     * Test deeply nested expressions with 12+ levels of nesting
     * These tests stress-test the recursive expression parser
     */
    public function testDeeplyNestedExpressions() {
        echo "\n=== Deeply Nested Expressions (12+ levels) ===\n";
        $calc = new ScientificCalculator('deg');

        // Test 1: 12-level nested sqrt (2^4096 root of a number)
        // sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(65536))))))))))))
        // = 65536^(1/4096) ≈ 1.00269
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(65536))))))))))))');
        $expected = pow(65536, 1/4096);
        $this->assertApprox($expected, $calc->getResult(), 'Test 1: 12-level nested sqrt (65536^(1/4096))');

        // Test 2: 12-level alternating sin/cos
        // sin(cos(sin(cos(sin(cos(sin(cos(sin(cos(sin(cos(0))))))))))))
        $calc->calculate('sin(cos(sin(cos(sin(cos(sin(cos(sin(cos(sin(cos(0))))))))))))');
        $v = 0;
        for ($i = 0; $i < 12; $i++) {
            $v = ($i % 2 == 0) ? cos(deg2rad($v)) : sin(deg2rad($v));
        }
        $this->assertApprox($v, $calc->getResult(), 'Test 2: 12-level alternating sin/cos');

        // Test 3: 12-level nested exp/ln (should return original value)
        // exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(5))))))))))))
        $calc->calculate('exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(5))))))))))))');
        $this->assertApprox(5, $calc->getResult(), 'Test 3: 12-level exp/ln nesting = 5');

        // Test 4: 13-level nested sqrt
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(8589934592)))))))))))))');
        $expected = pow(8589934592, 1/8192);
        $this->assertApprox($expected, $calc->getResult(), 'Test 4: 13-level nested sqrt');

        // Test 5: 12-level with arithmetic inside
        // sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(256 + 256))))))))))))
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(256 + 256))))))))))))');
        $expected = pow(512, 1/4096);
        $this->assertApprox($expected, $calc->getResult(), 'Test 5: 12-level sqrt with arithmetic (256+256)');

        // Test 6: Mixed functions 14-level deep
        // sin(cos(tan(sqrt(exp(ln(sqrt(cos(sin(tan(sqrt(exp(ln(sqrt(16))))))))))))))
        $calc->calculate('sin(cos(tan(sqrt(exp(ln(sqrt(cos(sin(tan(sqrt(exp(ln(sqrt(16))))))))))))))');
        $v = sqrt(16);           // 4
        $v = log($v);            // ln(4)
        $v = exp($v);            // 4
        $v = sqrt($v);           // 2
        $v = tan(deg2rad($v));   // tan(2°)
        $v = sin(deg2rad($v));   // sin(tan(2°)°)
        $v = cos(deg2rad($v));   // cos(...)
        $v = sqrt($v);           // sqrt(...)
        $v = log($v);            // ln(...)
        $v = exp($v);            // exp(...)
        $v = sqrt($v);           // sqrt(...)
        $v = tan(deg2rad($v));   // tan(...)
        $v = cos(deg2rad($v));   // cos(...)
        $v = sin(deg2rad($v));   // sin(...)
        $this->assertApprox($v, $calc->getResult(), 'Test 6: 14-level mixed functions');

        // Test 7: 15-level nested ln/exp
        $calc->calculate('ln(exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(exp(ln(e)))))))))))))))');
        $this->assertApprox(1, $calc->getResult(), 'Test 7: 15-level ln/exp = 1');

        // Test 8: 12-level with power operations
        // sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(2^12))))))))))))
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(2^12))))))))))))');
        $expected = pow(4096, 1/4096);
        $this->assertApprox($expected, $calc->getResult(), 'Test 8: 12-level sqrt of 2^12');

        // Test 9: 16-level nested sqrt (ultimate depth test)
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(4294967296))))))))))))))))');
        $expected = pow(4294967296, 1/65536);
        $this->assertApprox($expected, $calc->getResult(), 'Test 9: 16-level nested sqrt');

        // Test 10: 12-level with log10
        // log(exp(log(exp(log(exp(log(exp(log(exp(log(exp(10))))))))))))
        // This alternates between log10 and exp
        $calc->calculate('log(exp(log(exp(log(exp(log(exp(log(exp(log(exp(10))))))))))))');
        $v = 10;
        for ($i = 0; $i < 12; $i++) {
            $v = ($i % 2 == 0) ? exp($v) : log10($v);
        }
        $this->assertApprox($v, $calc->getResult(), 'Test 10: 12-level log/exp alternation');

        // Test 11: 12-level with constants
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(pi * e * 100))))))))))))');
        $expected = pow(M_PI * M_E * 100, 1/4096);
        $this->assertApprox($expected, $calc->getResult(), 'Test 11: 12-level sqrt with pi*e*100');

        // Test 12: 12-level sin only (converges to fixed point)
        $calc->calculate('sin(sin(sin(sin(sin(sin(sin(sin(sin(sin(sin(sin(90))))))))))))');
        $v = 90;
        for ($i = 0; $i < 12; $i++) {
            $v = sin(deg2rad($v));
        }
        $this->assertApprox($v, $calc->getResult(), 'Test 12: 12-level nested sin(90°)');

        // Test 13: 18-level nested sqrt (extreme depth)
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(10^18))))))))))))))))))');
        $expected = pow(1e18, 1/262144);
        $this->assertApprox($expected, $calc->getResult(), 'Test 13: 18-level nested sqrt of 10^18');

        // Test 14: 12-level with factorials
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(10!))))))))))))');
        $expected = pow(3628800, 1/4096);
        $this->assertApprox($expected, $calc->getResult(), 'Test 14: 12-level sqrt of 10!');

        // Test 15: 20-level nested sqrt (maximum depth stress test)
        $calc->calculate('sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(sqrt(10^30))))))))))))))))))))');
        $expected = pow(1e30, 1/1048576);
        $this->assertApprox($expected, $calc->getResult(), 'Test 15: 20-level nested sqrt (10^30^(1/2^20))');
    }

    /**
     * Run all tests
     */
    public function runAll() {
        echo "╔════════════════════════════════════════════╗\n";
        echo "║   Scientific Calculator - Test Suite      ║\n";
        echo "╚════════════════════════════════════════════╝\n";

        $this->testTrigonometricDegrees();
        $this->testTrigonometricRadians();
        $this->testLogarithmic();
        $this->testExponentialRoots();
        $this->testFactorial();
        $this->testCombinedExpressions();
        $this->testConstants();
        $this->testValidation();
        $this->testEdgeCases();
        $this->testComplexExpressions();
        $this->testRealWorldCalculations();
        $this->testMathematicalIdentities();
        $this->testUltraComplexExpressions();
        $this->testDeeplyNestedExpressions();

        $this->printResults();
    }

    /**
     * Print test results summary
     */
    private function printResults() {
        echo "\n" . str_repeat('=', 50) . "\n";
        echo "TEST RESULTS\n";
        echo str_repeat('=', 50) . "\n";

        foreach ($this->tests as $test) {
            $icon = $test['status'] === 'PASS' ? '✓' : '✗';
            $color = $test['status'] === 'PASS' ? "\033[32m" : "\033[31m";
            $reset = "\033[0m";
            echo "$color$icon $test[message]$reset\n";
            if ($test['status'] === 'FAIL') {
                echo "  Expected: {$test['expected']}\n";
                echo "  Actual: {$test['actual']}\n";
            }
        }

        echo "\n" . str_repeat('=', 50) . "\n";
        $total = $this->passed + $this->failed;
        $percentage = $total > 0 ? round(($this->passed / $total) * 100, 1) : 0;

        if ($this->failed === 0) {
            echo "\033[32m✓ ALL TESTS PASSED\033[0m\n";
        } else {
            echo "\033[31m✗ SOME TESTS FAILED\033[0m\n";
        }

        echo "Passed: {$this->passed}/{$total} ($percentage%)\n";
        echo "Failed: {$this->failed}/{$total}\n";
        echo str_repeat('=', 50) . "\n";
    }
}

// Run tests
$test = new CalculatorTest();
$test->runAll();
