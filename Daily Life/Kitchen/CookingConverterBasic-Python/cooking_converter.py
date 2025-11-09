# 🍳 Cooking Measurement Converter
# Author: @AkshadAwesome
# Description: A comprehensive interactive converter for US cooking measurements

def convert_units(value, from_unit, to_unit):
    """
    Converts between common US cooking measurement units.
    
    Args:
        value (float): The numerical value to convert
        from_unit (str): Source unit name
        to_unit (str): Target unit name
    
    Returns:
        float: Converted value
    
    Raises:
        ValueError: If units are not supported
    """
    # Base unit: teaspoons
    # All conversions are relative to teaspoons for simplicity
    conversions = {
        "teaspoon": 1,
        "tsp": 1,
        "tablespoon": 1 / 3,  # 1 tbsp = 3 tsp
        "tbsp": 1 / 3,
        "cup": 1 / 48,  # 1 cup = 48 tsp
        "fluid ounce": 1 / 6,  # 1 fl oz = 6 tsp
        "fl oz": 1 / 6,
        "pint": 1 / 96,  # 1 pint = 96 tsp (2 cups)
        "quart": 1 / 192,  # 1 quart = 192 tsp (4 cups)
        "gallon": 1 / 768,  # 1 gallon = 768 tsp (16 cups)
        "milliliter": 1 / 4.929,  # 1 tsp ≈ 4.929 mL
        "ml": 1 / 4.929,
    }
    
    # Normalize inputs to lowercase
    from_unit = from_unit.lower().strip()
    to_unit = to_unit.lower().strip()
    
    # Check if units are supported
    if from_unit not in conversions:
        raise ValueError(f"Unsupported source unit: '{from_unit}'")
    if to_unit not in conversions:
        raise ValueError(f"Unsupported target unit: '{to_unit}'")
    
    # Convert to base unit (teaspoons)
    value_in_tsp = value / conversions[from_unit]
    
    # Convert from base unit to target unit
    converted_value = value_in_tsp * conversions[to_unit]
    
    return converted_value


def display_supported_units():
    """Displays all supported US cooking measurement units."""
    print("\n📋 Supported Units:")
    print("   - teaspoon (tsp)")
    print("   - tablespoon (tbsp)")
    print("   - cup")
    print("   - fluid ounce (fl oz)")
    print("   - pint")
    print("   - quart")
    print("   - gallon")
    print("   - milliliter (ml)")
    print()


def get_valid_input(prompt, input_type=str):
    """
    Gets valid input from user with error handling.
    
    Args:
        prompt (str): Input prompt message
        input_type (type): Expected type (float or str)
    
    Returns:
        Validated user input
    """
    while True:
        try:
            user_input = input(prompt).strip()
            if input_type == float:
                value = float(user_input)
                if value <= 0:
                    print("❌ Please enter a positive number.")
                    continue
                return value
            return user_input
        except ValueError:
            print("❌ Invalid input. Please try again.")


def display_conversion_reference():
    """Displays a quick reference guide for common conversions."""
    print("\n💡 Quick Reference Guide:")
    print("   • 1 tablespoon = 3 teaspoons")
    print("   • 1 cup = 16 tablespoons = 48 teaspoons")
    print("   • 1 fluid ounce = 2 tablespoons = 6 teaspoons")
    print("   • 1 pint = 2 cups")
    print("   • 1 quart = 2 pints = 4 cups")
    print("   • 1 gallon = 4 quarts = 16 cups")


def main():
    """Main program loop for the cooking measurement converter."""
    print("=" * 60)
    print("🍳 Welcome to the Cooking Measurement Converter!")
    print("=" * 60)
    print("Convert between US cooking measurements")
    
    while True:
        display_supported_units()
        
        try:
            # Get user inputs
            value = get_valid_input("Enter value to convert: ", float)
            from_unit = get_valid_input("Convert from (e.g., cup): ", str)
            to_unit = get_valid_input("Convert to (e.g., tablespoon): ", str)
            
            # Perform conversion
            result = convert_units(value, from_unit, to_unit)
            
            # Display result
            print("\n" + "=" * 60)
            print(f"✅ RESULT: {value:.4g} {from_unit}(s) = {result:.4g} {to_unit}(s)")
            print("=" * 60)
            
            # Show reference guide
            display_conversion_reference()
            
        except ValueError as e:
            print(f"\n❌ Error: {e}")
        except Exception as e:
            print(f"⚠️  Unexpected error: {e}")
        
        # Ask if user wants to continue
        print()
        continue_choice = input("Convert another measurement? (y/n): ").strip().lower()
        if continue_choice not in ['y', 'yes']:
            print("\n👋 Thank you for using the Cooking Measurement Converter!")
            print("Happy cooking! 🍰\n")
            break
        print("\n" + "=" * 60 + "\n")


if __name__ == "__main__":
    main()
