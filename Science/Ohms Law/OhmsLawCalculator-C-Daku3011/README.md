# Ohm's Law Calculator

This is a simple C program that helps calculate electrical values using Ohm's Law. The program can calculate Voltage (V), Current (I), or Resistance (R) based on user input.

## Features

- Calculate Voltage (V) using Current (I) and Resistance (R)
- Calculate Current (I) using Voltage (V) and Resistance (R)
- Calculate Resistance (R) using Voltage (V) and Current (I)
- Supports both uppercase and lowercase input
- Displays results with 2 decimal places

## How to Use

1. ### Navigate to the directory containing main.c
    ```
    cd OhmsLawCalculator-C
    ```
    ### Compile the program
    ```
    gcc main.c -o ohms_law_calculator
    ```

2. Run the Program
    ```
    ./ohms_law_calculator
    ```
    
3. Choose what you want to calculate by entering:
    - 'V' or 'v' for Voltage
    - 'I' or 'i' for Current
    - 'R' or 'r' for Resistance
4. Enter the required values as prompted

5. The program will display the calculated result

## Formulas Used

- Voltage (V) = Current (I) × Resistance (R)
- Current (I) = Voltage (V) ÷ Resistance (R)
- Resistance (R) = Voltage (V) ÷ Current (I)

## Technical Requirements

- C compiler
- Standard input/output library (stdio.h)

## Error Handling

The program includes basic error handling for invalid operator input.

## Note

This program assumes correct numeric input from the user and does not include input validation for the numeric values.