import math
import sys

def get_positive_float(prompt):
    while True:
        value_str = input(prompt)
        if value_str.lower() == 'exit':
            return None
        try:
            value = float(value_str)
            if value < 0:
                print("  [Error] Value cannot be negative. Please try again.")
            else:
                return value
        except ValueError:
            print("  [Error] Invalid input. Please enter a valid number.")

def calculator():
    print("--- 📐 Simple Area Calculator ---")
    print("Calculates the area of basic geometric shapes.")
    print("Type 'exit' at any time to quit.")
    
    while True:
        print("\nPlease select a shape:")
        print("  1. Circle")
        print("  2. Rectangle")
        print("  3. Square")
        print("  4. Triangle (Base/Height)")
        print("  5. Exit")
        
        choice = input("\nEnter choice (1-5): ")
        
        if choice == '5':
            print("\nThank you for using the Area Calculator. Goodbye! 👋")
            break
        
        try:
            if choice == '1':
                radius = get_positive_float("Enter the radius of the circle: ")
                if radius is None: 
                    continue
                area = math.pi * (radius ** 2)
                print("\n--- Result ---")
                print(f"The area of a circle with radius {radius:,.12g} is: {area:,.12g}")
                print("-" * 25)

            elif choice == '2':
                length = get_positive_float("Enter the length of the rectangle: ")
                if length is None: 
                    continue
                width = get_positive_float("Enter the width of the rectangle: ")
                if width is None: 
                    continue
                area = length * width
                print("\n--- Result ---")
                print(f"The area of a {length}x{width} rectangle is: {area:,.12g}")
                print("-" * 25)
                
            elif choice == '3':
                side = get_positive_float("Enter the side length of the square: ")
                if side is None: 
                    continue
                area = side ** 2
                print("\n--- Result ---")
                print(f"The area of a {side}x{side} square is: {area:,.12g}")
                print("-" * 25)

            elif choice == '4':
                base = get_positive_float("Enter the base of the triangle: ")
                if base is None: 
                    continue
                height = get_positive_float("Enter the height of the triangle: ")
                if height is None: 
                    continue
                area = 0.5 * base * height
                print("\n--- Result ---")
                print(f"The area of the triangle is: {area:,.12g}")
                print("-" * 25)

            else:
                print(f"  [Error] Invalid choice '{choice}'. Please enter a number between 1 and 5.")
        
        except Exception as e:
            print(f"An unexpected error occurred: {e}")

if __name__ == "__main__":
    calculator()
