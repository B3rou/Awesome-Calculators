#!/usr/bin/env python3
"""
CookingConverter-Python/main.py

Simple interactive and CLI cooking/baking measurement converter.

Features:
 - Interactive menu to choose units and value
 - CLI mode for quick conversions: `python main.py <value> <from_unit> <to_unit>`
 - Supports: cups (US), metric_cup, tablespoons (tbsp), teaspoons (tsp), milliliters (ml), liters (l)

Conversion approach:
 - Convert input value to milliliters (mL) using a unit-to-mL mapping
 - Convert milliliters to target units

Author: @xyzarnav Contribution for Awesome-Calculators
"""

import argparse
import sys

# Unit definitions (in milliliters)
# Note: 1 tablespoon = 15 mL, 1 teaspoon = 5 mL (common metric approximations)
# US cup is commonly 240 mL (16 tbsp * 15 mL). Metric cup = 250 mL.
UNIT_TO_ML = {
    "ml": 1.0,
    "milliliter": 1.0,
    "millilitres": 1.0,
    "l": 1000.0,
    "liter": 1000.0,
    "litre": 1000.0,
    "tbsp": 15.0,
    "tablespoon": 15.0,
    "tablespoons": 15.0,
    "tsp": 5.0,
    "teaspoon": 5.0,
    "teaspoons": 5.0,
    # US cup = 240 mL (16 tbsp * 15 mL)
    "cup": 240.0,
    "cups": 240.0,
    # Metric cup often used in recipes (250 mL)
    "metric_cup": 250.0,
    "metriccup": 250.0,
}


def normalize_unit(unit: str) -> str:
    """Normalize user unit input (case-insensitive)."""
    return unit.strip().lower()


def convert(value: float, from_unit: str, to_unit: str) -> float:
    """Convert value from `from_unit` to `to_unit` using milliliters as pivot.

    Raises KeyError if units are unknown.
    """
    fu = normalize_unit(from_unit)
    tu = normalize_unit(to_unit)

    if fu not in UNIT_TO_ML:
        raise KeyError(f"Unknown from-unit: {from_unit}")
    if tu not in UNIT_TO_ML:
        raise KeyError(f"Unknown to-unit: {to_unit}")

    # Convert to milliliters, then to target unit
    value_ml = value * UNIT_TO_ML[fu]
    result = value_ml / UNIT_TO_ML[tu]
    return result


def list_supported_units() -> str:
    """Return a nicely formatted string of supported unit keys."""
    # Unique canonical keys for display
    keys = sorted(set([k for k in UNIT_TO_ML.keys() if k.isalpha() or '_' in k]))
    return ", ".join(keys)


def interactive_loop():
    print("Cooking Converter — convert between common cooking measurements")
    print("Supported units: ")
    print("  ", list_supported_units())
    print("You can use synonyms like 'tbsp', 'tablespoon', 'tsp', 'cup', 'metric_cup', 'ml', 'l'.")
    print("Type 'quit' at any prompt to exit.\n")

    while True:
        raw_value = input("Enter numeric value to convert (or 'quit'): ").strip()
        if raw_value.lower() in ("quit", "q", "exit"):
            print("Goodbye!")
            break

        try:
            value = float(raw_value)
        except ValueError:
            print("That's not a valid number. Try again.")
            continue

        from_unit = input("From unit: ").strip()
        if from_unit.lower() in ("quit", "q", "exit"):
            print("Goodbye!")
            break

        to_unit = input("To unit: ").strip()
        if to_unit.lower() in ("quit", "q", "exit"):
            print("Goodbye!")
            break

        try:
            result = convert(value, from_unit, to_unit)
        except KeyError as e:
            print(e)
            print("Supported units: ", list_supported_units())
            continue

        print(f"\n{value} {from_unit} = {result:.4f} {to_unit}\n")


def main(argv=None):
    parser = argparse.ArgumentParser(description="Cooking / baking unit converter")
    parser.add_argument("value", nargs="?", help="numeric value to convert (if omitted, interactive mode)")
    parser.add_argument("from_unit", nargs="?", help="unit to convert from")
    parser.add_argument("to_unit", nargs="?", help="unit to convert to")

    args = parser.parse_args(argv)

    if args.value is None:
        # interactive
        interactive_loop()
        return 0

    # CLI quick mode
    try:
        value = float(args.value)
    except ValueError:
        print("First argument must be a number (value to convert).")
        return 2

    if not args.from_unit or not args.to_unit:
        print("When running in CLI mode provide: <value> <from_unit> <to_unit>")
        print("Example: python main.py 1 cup tbsp")
        return 2

    try:
        result = convert(value, args.from_unit, args.to_unit)
    except KeyError as e:
        print(e)
        print("Supported units: ", list_supported_units())
        return 3

    # Print result and exit
    print(f"{value} {args.from_unit} = {result:.4f} {args.to_unit}")
    return 0


if __name__ == "__main__":
    sys.exit(main())
