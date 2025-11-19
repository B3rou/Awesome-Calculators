def add (a, b):
    return a + b

def subtract(a, b):
    return a - b

def multiply(a, b):
    return a * b

def divide(a, b):
    if b == 0:
        result = "Cannot divide by zero"
    else:
        result = a / b
    return result

def main():
    end = False
    while(end != True): 
        print("\n=== Simple Calculator CLI ===")
        print("1. Addition")
        print("2. Subtraction")
        print("3. Multiplication")
        print("4. Division")
        print("5. Exit")

        operation = input("select an option: ")

        if operation == "1":
            num1 = float(input("Enter the first number: "))
            num2 = float(input("Enter the second number: "))
            result = add(num1, num2)
        
        elif operation == "2":
            num1 = float(input("Enter the first number: "))
            num2 = float(input("Enter the second number: "))
            result = subtract(num1, num2)
        
        elif operation == "3":
            num1 = float(input("Enter the first number: "))
            num2 = float(input("Enter the second number: "))
            result = multiply(num1, num2)
        
        elif operation == "4":
            num1 = float(input("Enter the first number: "))
            num2 = float(input("Enter the second number: "))
            result = divide(num1, num2)
        
        elif operation == "5":
            print("Exiting calculator. Goodbye!")
            end = True
            continue

        else:
            print("Invalid option. Try again.")
            continue

        print(f"Result: {result}")
           
main()