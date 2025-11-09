def main():
    
    print("--- 🧮 Basic Python Calculator (C-Style) ---")

    try:
        first = float(input("Please enter the first number: "))
        second = float(input("Please enter the second number: "))
    except ValueError:
        print("\n[Error] Invalid input. Please enter numeric values.")
        return

    op = input("Select the operation you want to perform (+, -, *, /): ")

    if op == '+':
        result = first + second
        print(f"The result of your operation: {result:.2f}")
    
    elif op == '-':
        result = first - second
        print(f"The result of your operation: {result:.2f}")
    
    elif op == '*':
        result = first * second
        print(f"The result of your operation: {result:.2f}")
    
    elif op == '/':
        if second == 0:
            print("\n[Error] Invalid operation: Cannot divide by zero.")
        else:
            result = first / second
            print(f"The result of your operation: {result:.2f}")
    
    else:
        print("\n[Error] Invalid operator entered!")

if __name__ == "__main__":
    main()