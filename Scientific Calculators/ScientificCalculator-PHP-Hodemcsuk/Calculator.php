<?php
/**
 * ScientificCalculator Class
 *
 * Handles all mathematical operations including:
 * - Trigonometric functions (sin, cos, tan)
 * - Logarithmic functions (log base 10, natural log)
 * - Exponential and root functions (exp, sqrt)
 * - Factorial calculation
 * - Combined expression parsing
 * - Input validation
 */

class ScientificCalculator {
    private $angleMode = 'rad';
    private $result = null;
    private $error = null;

    /**
     * Constructor
     * @param string $mode Angle mode: 'rad' or 'deg'
     */
    public function __construct($mode = 'rad') {
        $this->angleMode = $mode;
    }

    /**
     * Calculate factorial of a number
     * @param int $n Non-negative integer
     * @return int Factorial result
     * @throws Exception If input is invalid
     */
    private function factorial($n) {
        if ($n < 0 || floor($n) != $n) {
            throw new Exception("Factorial requires a non-negative integer");
        }
        if ($n > 170) {
            throw new Exception("Factorial input too large (max: 170)");
        }
        $result = 1;
        for ($i = 2; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    /**
     * Convert degrees to radians if angle mode is degrees
     * @param float $value Angle value
     * @return float Value in radians
     */
    private function toRadians($value) {
        if ($this->angleMode === 'deg') {
            return deg2rad($value);
        }
        return $value;
    }

    /**
     * Parse and evaluate a combined mathematical expression
     * Supports: sin, cos, tan, log, ln, exp, sqrt, factorial (!), +, -, *, /, ^, (, )
     * @param string $expression Mathematical expression
     * @return float Result of evaluation
     * @throws Exception If expression is invalid
     */
    public function evaluateExpression($expression) {
        // Clean the expression
        $expr = trim($expression);
        $expr = str_replace(' ', '', $expr);

        if (empty($expr)) {
            throw new Exception("Empty expression");
        }

        // Process factorial notation first (e.g., 5!)
        $expr = preg_replace_callback('/(\d+)!/', function($matches) {
            return $this->factorial(intval($matches[1]));
        }, $expr);

        // Process scientific functions iteratively (from innermost to outermost)
        $functions = ['sin', 'cos', 'tan', 'cot', 'log', 'ln', 'exp', 'sqrt'];
        $maxIterations = 500;
        $iteration = 0;

        while ($iteration < $maxIterations) {
            $found = false;

            foreach ($functions as $func) {
                // Find function call and extract its balanced parentheses content
                $funcPos = strpos($expr, $func . '(');
                if ($funcPos !== false) {
                    // Make sure it's not part of another word (e.g., 'asin')
                    if ($funcPos > 0 && ctype_alpha($expr[$funcPos - 1])) {
                        continue;
                    }

                    $startParen = $funcPos + strlen($func);
                    $innerContent = $this->extractBalancedParens($expr, $startParen);

                    if ($innerContent !== null) {
                        $found = true;
                        $fullMatch = $func . '(' . $innerContent . ')';

                        // Check if inner content contains functions - if so, evaluate recursively
                        $hasNestedFunc = false;
                        foreach ($functions as $f) {
                            if (strpos($innerContent, $f . '(') !== false) {
                                $hasNestedFunc = true;
                                break;
                            }
                        }

                        if ($hasNestedFunc) {
                            // Recursively evaluate nested functions first
                            $innerValue = $this->evaluateExpression($innerContent);
                        } else {
                            // Replace constants and power operator, then evaluate
                            $innerExpr = $this->replaceConstants($innerContent);
                            $innerExpr = str_replace('^', '**', $innerExpr);
                            $innerValue = $this->evaluateSimpleExpression($innerExpr);
                        }

                        $result = $this->applyFunction($func, $innerValue);
                        $expr = str_replace($fullMatch, '(' . $result . ')', $expr);
                        break;
                    }
                }
            }

            if (!$found) break;
            $iteration++;
        }

        // Replace constants in remaining expression
        $expr = $this->replaceConstants($expr);

        // Replace ^ with ** for power operation
        $expr = str_replace('^', '**', $expr);

        // Validate the final expression
        // Allow E/e for scientific notation (e.g., 1.23E-10)
        if (!preg_match('/^[\d\.\+\-\*\/\(\)\s\*Ee]+$/', $expr)) {
            throw new Exception("Invalid characters in expression");
        }

        // Evaluate the final mathematical expression
        return $this->evaluateSimpleExpression($expr);
    }

    /**
     * Replace mathematical constants (pi, e) with their values
     * @param string $expr Expression containing constants
     * @return string Expression with constants replaced
     */
    private function replaceConstants($expr) {
        // Replace pi first (before e, to avoid issues)
        $expr = str_replace('pi', '(' . M_PI . ')', $expr);
        $expr = str_replace('π', '(' . M_PI . ')', $expr);

        // Replace standalone 'e' (not part of 'exp' or scientific notation like '1e5')
        // Match 'e' that is not preceded by a letter or digit, and not followed by 'xp' or a digit
        $expr = preg_replace('/(?<![a-zA-Z0-9])e(?!xp)(?![0-9])/', '(' . M_E . ')', $expr);

        return $expr;
    }

    /**
     * Extract content within balanced parentheses starting at given position
     * @param string $expr The expression string
     * @param int $startPos Position of the opening parenthesis
     * @return string|null Content inside parentheses, or null if unbalanced
     */
    private function extractBalancedParens($expr, $startPos) {
        if ($startPos >= strlen($expr) || $expr[$startPos] !== '(') {
            return null;
        }

        $depth = 0;
        $content = '';

        for ($i = $startPos; $i < strlen($expr); $i++) {
            $char = $expr[$i];

            if ($char === '(') {
                $depth++;
                if ($depth > 1) {
                    $content .= $char;
                }
            } elseif ($char === ')') {
                $depth--;
                if ($depth === 0) {
                    return $content;
                }
                $content .= $char;
            } else {
                if ($depth > 0) {
                    $content .= $char;
                }
            }
        }

        return null; // Unbalanced
    }

    /**
     * Apply a scientific function to a value
     * @param string $func Function name
     * @param float $value Input value
     * @return float Result of function
     * @throws Exception If function fails validation
     */
    private function applyFunction($func, $value) {
        switch ($func) {
            case 'sin':
                return sin($this->toRadians($value));

            case 'cos':
                return cos($this->toRadians($value));

            case 'tan':
                $radValue = $this->toRadians($value);
                $cosValue = cos($radValue);
                if (abs($cosValue) < 1e-10) {
                    throw new Exception("tan() undefined at this angle");
                }
                return tan($radValue);

            case 'cot':
                $radValue = $this->toRadians($value);
                $sinValue = sin($radValue);
                if (abs($sinValue) < 1e-10) {
                    throw new Exception("cot() undefined at this angle");
                }
                return cos($radValue) / $sinValue;

            case 'log':
                if ($value <= 0) {
                    throw new Exception("log() requires positive number");
                }
                return log10($value);

            case 'ln':
                if ($value <= 0) {
                    throw new Exception("ln() requires positive number");
                }
                return log($value);

            case 'exp':
                if ($value > 709) {
                    throw new Exception("exp() overflow");
                }
                return exp($value);

            case 'sqrt':
                if ($value < 0) {
                    throw new Exception("sqrt() requires non-negative number");
                }
                return sqrt($value);

            default:
                throw new Exception("Unknown function: $func");
        }
    }

    /**
     * Safely evaluate a simple mathematical expression (no functions)
     * @param string $expr Expression with only numbers and operators
     * @return float Result
     * @throws Exception If expression is invalid
     */
    private function evaluateSimpleExpression($expr) {
        $expr = str_replace(' ', '', $expr);

        // Validate - only allow safe characters
        // Allow E/e for scientific notation (e.g., 1.23E-10, 2.5e5)
        if (!preg_match('/^[\d\.\+\-\*\/\(\)\sEe]+$/', $expr)) {
            throw new Exception("Invalid expression syntax");
        }

        // Check for balanced parentheses
        $depth = 0;
        for ($i = 0; $i < strlen($expr); $i++) {
            if ($expr[$i] === '(') $depth++;
            if ($expr[$i] === ')') $depth--;
            if ($depth < 0) throw new Exception("Unbalanced parentheses");
        }
        if ($depth !== 0) throw new Exception("Unbalanced parentheses");

        // Additional syntax validation to prevent eval errors
        // Check for empty parentheses
        if (strpos($expr, '()') !== false) {
            throw new Exception("Empty parentheses not allowed");
        }

        // Check for consecutive operators (except ** for power and unary minus)
        // First temporarily replace ** with a placeholder
        $tempExpr = str_replace('**', '§POW§', $expr);
        if (preg_match('/[\+\*\/]{2,}/', $tempExpr)) {
            throw new Exception("Invalid operator sequence");
        }

        // Check for operator at start (except minus for negative)
        if (preg_match('/^[\+\*\/]/', $expr)) {
            throw new Exception("Expression cannot start with operator");
        }

        // Check for operator at end
        if (preg_match('/[\+\-\*\/]$/', $expr)) {
            throw new Exception("Expression cannot end with operator");
        }

        // Check for operator before closing parenthesis
        if (preg_match('/[\+\-\*\/]\)/', $expr)) {
            throw new Exception("Operator before closing parenthesis");
        }

        // Check for operator after opening parenthesis (except minus)
        if (preg_match('/\([\+\*\/]/', $expr)) {
            throw new Exception("Invalid operator after opening parenthesis");
        }

        // Check for missing operator after closing parenthesis followed by digit
        if (preg_match('/\)\d/', $expr)) {
            throw new Exception("Missing operator after parenthesis");
        }

        // Check for missing operator between closing and opening parenthesis
        if (preg_match('/\)\(/', $expr)) {
            throw new Exception("Missing operator between parentheses");
        }

        // Check for empty expression (use strlen instead of empty because empty('0') is true in PHP)
        if (strlen($expr) === 0) {
            throw new Exception("Empty expression");
        }

        // Evaluate safely after validation
        $result = @eval("return ($expr);");

        if ($result === false && $expr !== 'false') {
            throw new Exception("Failed to evaluate expression");
        }

        if (!is_numeric($result) || is_nan($result) || is_infinite($result)) {
            throw new Exception("Invalid result");
        }

        return $result;
    }

    /**
     * Main calculation entry point
     * @param string $expression Expression to calculate
     * @return bool Success status
     */
    public function calculate($expression) {
        try {
            $this->result = $this->evaluateExpression($expression);
            $this->error = null;
            return true;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            $this->result = null;
            return false;
        }
    }

    /**
     * Get the calculation result
     * @return float|null Result or null if error
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * Get the error message
     * @return string|null Error message or null if success
     */
    public function getError() {
        return $this->error;
    }

    /**
     * Format result for display
     * @param float $result Number to format
     * @return string Formatted result
     */
    public function formatResult($result) {
        if (is_nan($result) || is_infinite($result)) {
            return "Error";
        }

        // Use scientific notation for very large or small numbers
        if (abs($result) > 1e10 || (abs($result) < 1e-10 && $result != 0)) {
            return sprintf("%.6e", $result);
        }

        // Round to avoid floating point precision issues
        return round($result, 10);
    }
}
