"""
Simple Calculator
This program implements a basic calculator with the following operations:
- Addition
- Subtraction
- Multiplication
- Division
"""

def add(x, y):
    """Add two numbers and return the result"""
    return x + y

def subtract(x, y):
    """Subtract y from x and return the result"""
    return x - y

def multiply(x, y):
    """Multiply two numbers and return the result"""
    return x * y

def divide(x, y):
    """Divide x by y and return the result
    Raises ZeroDivisionError if y is 0
    """
    if y == 0:
        raise ZeroDivisionError("Cannot divide by zero")
    return x / y

def calculator():
    """Main calculator function that handles user input and displays results"""
    print("Welcome to Simple Calculator")
    print("Operations:")
    print("1. Addition")
    print("2. Subtraction")
    print("3. Multiplication")
    print("4. Division")
    print("5. Exit")
    
    while True:
        # Get user choice
        choice = input("\nEnter choice (1-5): ")
        
        # Check if user wants to exit
        if choice == '5':
            print("Thank you for using Simple Calculator!")
            break
        
        # Validate user choice
        if choice not in ['1', '2', '3', '4']:
            print("Invalid input. Please enter a number between 1 and 5.")
            continue
        
        # Get operands
        try:
            num1 = float(input("Enter first number: "))
            num2 = float(input("Enter second number: "))
        except ValueError:
            print("Invalid input. Please enter valid numbers.")
            continue
        
        # Perform calculation based on user choice
        if choice == '1':
            print(f"{num1} + {num2} = {add(num1, num2)}")
        elif choice == '2':
            print(f"{num1} - {num2} = {subtract(num1, num2)}")
        elif choice == '3':
            print(f"{num1} * {num2} = {multiply(num1, num2)}")
        elif choice == '4':
            try:
                result = divide(num1, num2)
                print(f"{num1} / {num2} = {result}")
            except ZeroDivisionError as e:
                print(f"Error: {e}")

# Example usage
if __name__ == "__main__":
    calculator()