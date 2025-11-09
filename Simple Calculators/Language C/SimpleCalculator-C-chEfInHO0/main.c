#include <stdio.h>

// --- Arithmetic Functions ---
float add(float num1, float num2) {
    return num1 + num2;
}

float subtract(float num1, float num2) {
    return num1 - num2;
}

float multiply(float num1, float num2) {
    return num1 * num2;
}

float divide(float num1, float num2) {
    return num1 / num2;
}

// --- Input/Validation Functions ---

/**
 * @brief Keeps looping until a valid operation (+, -, *, /) is entered.
 * * @param op Pointer to the char where the operation will be stored.
 */
void ask_operation(char *op) {
    int isValid = 0;
    // Keep asking until a valid operation is entered
    while (!isValid) {
        printf("\nSelect the operation to perform");
        printf("(+,-,/,*) : ");
        // Insert an extra space before %c to discard any remaining '\n'
        int res = scanf(" %c", op);
        // scanf returns 1 if a valid char was read
        isValid = res; 
    }
}

/**
 * @brief Clears the buffer when invalid input is detected.
 * * @param res The result of the scanf operation.
 * @return int 1 if input is valid, 0 otherwise.
 */
int validate_input(int res) {
    if (res != 1) {
        while (getchar() != '\n'); // clear stdin buffer
        return 0;                 // input invalid
    }
    return 1;                     // input valid
}


/**
 * @brief Keeps looping until a valid float is entered.
 * * @param num Pointer to the float where the number will be stored.
 */
void ask_input(float *num) {
    int isValid = 0;
    // Keep prompting the user until a valid float is provided
    while (!isValid) {
        printf("\nEnter a value : ");
        int res = scanf("%f", num);     // read float and store in pointer
        isValid = validate_input(res);  // validate result
    }
}


int main() {
    float num1, num2;  // store numeric inputs
    char op;           // store operation type
    int completed = 0; // flag to exit loop when a valid operation is completed

    // Ask for both operands
    ask_input(&num1);
    ask_input(&num2);

    // Keep asking for operation until a valid one is processed
    while (!completed) {
        ask_operation(&op); // ask which operation to perform

        // Perform operation according to user input
        switch (op) {
            case '+':
                printf("%.2f + %.2f = %.2f\n", num1, num2, add(num1, num2));
                completed = 1;
                break;
            case '-':
                printf("%.2f - %.2f = %.2f\n", num1, num2, subtract(num1, num2));
                completed = 1;
                break;
            case '*':
                printf("%.2f * %.2f = %.2f\n", num1, num2, multiply(num1, num2));
                completed = 1;
                break;
            case '/':
                // Check for division by zero before performing
                if (num2 == 0) {
                    printf("Can't divide by 0 (Zero). Select another operation.\n");
                } else {
                    printf("%.2f / %.2f = %.2f\n", num1, num2, divide(num1, num2));
                    completed = 1;
                }
                break;
            default:
                printf("Invalid operation. Try again.\n");
        }
    }

    return 0; // end of program
}