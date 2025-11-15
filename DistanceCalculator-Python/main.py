def show_menu():
    """
    Generates the selection menu.
    """
    conversions = [
        "1. Centimeter => Millimeters", "2. Millimeter => Centimeter",
        "3. Centimeter => Meter", "4. Meter => Centimeter",
        "5. Kilometer => Meter", "6. Meter => Kilometer",
        "7. Foot => Inch", "8. Inch => Foot",
        "9. Inch => Centimeter", "10. Centimeter => Inch",
        "11. Yard => Feet", "12. Feet => Yard",
        "13. Yard => Inch", "14. Inch => Yard",
        "15. Mile => Kilometer", "16. Kilometer => Mile",
    ]
    print("")
    GENERAL_WIDTH = 45  # used for centering and printing of outline
    print("Distance Calculator".center(GENERAL_WIDTH))
    print("=" * GENERAL_WIDTH)
    for i in range(0, len(conversions) - 1, 2):
        print(f"{conversions[i]:<30} {conversions[i + 1]:<30}")
    if len(conversions) % 2 != 0:
        print(conversions[-1])
    print("=" * GENERAL_WIDTH)
    print("17. Exit".center(GENERAL_WIDTH))
    print("")


def get_units(choice):
    """
    Grabs the units for displaying conversions

    Args:
        choice(int): The menu choice.

    Returns:
        tuple[str, str]: The from and to units
    """
    # sets the unit names for all menu choices, allows for better user interface experience
    units_map = {
        1: ("Centimeters", "Millimeters"),
        2: ("Millimeters", "Centimeters"),
        3: ("Centimeters", "Meters"),
        4: ("Meters", "Centimeters"),
        5: ("Kilometers", "Meters"),
        6: ("Meters", "Kilometers"),
        7: ("Feet", "Inches"),
        8: ("Inches", "Feet"),
        9: ("Inches", "Centimeters"),
        10: ("Centimeters", "Inches"),
        11: ("Yards", "Feet"),
        12: ("Feet", "Yards"),
        13: ("Yards", "Inches"),
        14: ("Inches", "Yards"),
        15: ("Miles", "Kilometers"),
        16: ("Kilometers", "Miles"),
    }
    return units_map.get(choice, ("", ""))


def handle_conversion(choice, num):
    """
    Calculates the conversion based on the menu choice

    Args:
        choice(int): The menu choice.
        num(float): The number to convert.

    Returns:
        float: The converted number.
    """
    match choice:
        case 1:
            return num * 10
        case 2:
            return num / 10
        case 3:
            return num / 100
        case 4:
            return num * 100
        case 5:
            return num * 1000
        case 6:
            return num / 1000
        case 7:
            return num * 12
        case 8:
            return num / 12
        case 9:
            return num * 2.54
        case 10:
            return num / 2.54
        case 11:
            return num * 3
        case 12:
            return num / 3
        case 13:
            return num * 36
        case 14:
            return num / 36
        case 15:
            return num * 1.60934
        case 16:
            return num / 1.60934
        case _:
            return None


def main():
    """
    Runs the distance converter program.

    Displays the conversion menu, processes user input for conversion choices,
    accepts numerical values, performs unit conversions, and displays results.

    The program loops until the user selects the 'Exit' option.
    """
    show_menu()
    while True:
        try:
            choice = int(input("Enter your choice: "))
        except ValueError:
            print("Please enter a valid integer choice.")
            continue

        if choice == 17:
            print("Goodbye!")
            break

        if choice not in range(1, 17):
            print("Invalid choice, please select a number from 1 to 16")
            continue

        from_unit, to_unit = get_units(choice)

        try:
            num = float(input(f"Enter value in {from_unit}: "))

            if float(from_unit) < 0:
                print("Numbers need to non-negative, please try again.")
                continue
        except ValueError:
            print("Invalid input, please enter a numeric value")
            continue

        result = handle_conversion(choice, num)
        if result is None:
            print("Conversion failed due to invalid choice.")
        else:
            print(f"{num} {from_unit} = {result} {to_unit}")


if __name__ == "__main__":
    main()
