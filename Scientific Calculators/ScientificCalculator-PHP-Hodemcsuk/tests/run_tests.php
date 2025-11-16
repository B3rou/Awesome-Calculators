#!/usr/bin/env php
<?php
/**
 * Test Runner Script
 *
 * Usage: php tests/run_tests.php
 *        or: ./tests/run_tests.php (if executable)
 */

echo "Starting Scientific Calculator Test Suite...\n\n";

// Change to project root directory
chdir(__DIR__ . '/..');

// Include and run tests
require_once 'tests/CalculatorTest.php';
