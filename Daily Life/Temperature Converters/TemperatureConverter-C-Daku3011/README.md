# Temperature Converter

A simple temperature converter implemented in C that allows users to convert temperatures between Celsius and Fahrenheit.

## Implementations

### C Implementation
The C version (`main.c`) provides a straightforward command-line interface for temperature conversion.

#### Features
- Written in standard C
- Uses floating-point arithmetic for accurate calculations
- Basic error handling for invalid inputs
- Compact and efficient implementation

#### How to Compile and Run
```bash
gcc main.c -o temperature_converter
./temperature_converter
```

## Usage

This versions support:
1. Converting from Celsius to Fahrenheit (°C → °F)
2. Converting from Fahrenheit to Celsius (°F → °C)

### Input Format
- Choose conversion type by entering 'C' for Celsius to Fahrenheit or 'F' for Fahrenheit to Celsius
- Enter the temperature value when prompted

### Conversion Formulas
- Celsius to Fahrenheit: `°F = (°C × 9/5) + 32`
- Fahrenheit to Celsius: `°C = (°F - 32) × 5/9`

## Requirements
- C Version: Any C compiler (gcc recommended)

