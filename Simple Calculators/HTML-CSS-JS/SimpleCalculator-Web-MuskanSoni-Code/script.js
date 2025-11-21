// Calculator logic with keyboard support and input sanitization
const displayEl = document.getElementById('display');
let current = '0';
let lastKey = null;

// Update the display input
function updateDisplay() {
  displayEl.value = current;
}

// Handle number/operator input
function inputValue(val) {
  if (current === '0' && val !== '.') current = val;
  else {
    // Prevent multiple dots in the same number segment
    if (val === '.' && current.slice(-1) === '.') return;
    current += val;
  }
  lastKey = 'digit';
  updateDisplay();
}

function clearAll() {
  current = '0';
  updateDisplay();
}

function backspace() {
  if (current.length === 1 || current === 'Error') current = '0';
  else current = current.slice(0, -1);
  updateDisplay();
}

function safeEval(expr) {
  // Sanitize: allow only digits, operators, dot, parentheses
  if (!/^[0-9+\-*/.() \t]+$/.test(expr)) return 'Error';
  try {
    // Use Function constructor for safer evaluation scope
    // eslint-disable-next-line no-new-func
    const result = Function(`"use strict"; return (${expr})`)();
    return (Number.isFinite(result) ? result : 'Error');
  } catch {
    return 'Error';
  }
}

function calculate() {
  // Normalize operators for evaluation
  let cleanExpr = current.replace(/×/g, '*').replace(/÷/g, '/').replace(/x/g, '*');
  
  const result = safeEval(cleanExpr);
  current = (result === 'Error') ? 'Error' : String(result);
  updateDisplay();
  lastKey = 'equals';
}

// Button click event listeners
document.querySelectorAll('.btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const val = btn.innerText; // Get button text directly

    if (val === 'C' || val === 'AC') clearAll();
    else if (val === 'DEL' || val === '←' || val === 'Back') backspace();
    else if (val === '=') calculate();
    else {
      inputValue(val);
    }
  });
});

// Keyboard support
window.addEventListener('keydown', (e) => {
  const key = e.key;
  if ((/^[0-9]$/).test(key)) inputValue(key);
  else if (key === '.') inputValue('.');
  else if (key === 'Enter' || key === '=') { e.preventDefault(); calculate(); }
  else if (key === 'Backspace') backspace();
  else if (key === 'Escape') clearAll();
  else if (['+','-','*','/','(',')'].includes(key)) inputValue(key);
});

// Initialize display
updateDisplay();