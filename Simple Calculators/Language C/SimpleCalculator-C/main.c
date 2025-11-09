#include <stdio.h>

int main(void) {

    double first, second;  // Two numbers to be used in the operation
    char op;               // The operator character (+, -, *, /)

    // Ask the user for two numbers
    printf("Please enter 2 numbers:\n");
    scanf("%lf%lf", &first, &second);

    getchar();  // Consume the newline character left in the input buffer

    // Ask the user to choose an operation
    printf("Select the operation you want to perform (+, -, *, /): ");
    scanf("%c", &op);

    getchar();  // Consume the newline character again (optional, for safety)

    // Perform the chosen operation
    switch (op) {
        case '+':
            printf("The result of your operation: %.2lf", first + second);
            break;
        case '-':
            printf("The result of your operation: %.2lf", first - second);
            break;
        case '*':
            printf("The result of your operation: %.2lf", first * second);
            break;
        case '/':
            printf("The result of your operation: %.2lf", first / second);
            break;
        default:
            printf("Invalid operator entered!");
            break;
    }

    // Wait for user input before closing (useful when running from IDE)
    getchar();
    getchar();

    return 0;
}