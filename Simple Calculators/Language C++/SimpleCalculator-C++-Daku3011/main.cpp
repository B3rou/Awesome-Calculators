#include<iostream>
using namespace std;

int main() {
    int first, second; //Two integer variables to hold user input
    cout << "Enter two integers: ";
    
    cin >> first >> second; //Read two integers from user

    char op; //Variable to hold the operator
    cout << "Enter an operator (+, -, *, /): ";
    cin >> op; //Read the operator from user

    int result; 

    switch(op) {
        // ---- Addition ----
        case '+':
            result = first + second;
            cout << "Addition of " << first << " and " << second << " is : " << result << endl;
            break;

        // --- Subtraction ----
        case '-':
            result = first - second;
            cout << "Subtraction of " << first << " and " << second << " is : " << result << endl;
            break;
        
            // ---- Multiplication ----
        case '*':
            result = first * second;
            cout << "Multiplication of " << first << " and " << second << " is : " << result << endl;
            break;

        // ---- Division ----
        case '/':
            // Check for division by zero
            if(second != 0) {
                result = first / second;
                cout << "Division of " << first << " and " << second << " is : " << result << endl;
            } else { // Handle division by zero
                cout << "Error: Division by zero!" << endl;
            }
            break;

        // ---- Invalid Operator ----            
        default:
            cout << "Error: Invalid operator!" << endl;
    }
    return 0;
}