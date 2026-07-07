#include <stdio.h>

int main(void) {
    /* Display menu */
    printf("=== Temperature Converter ===\n");
    printf("1. Celsius -> Fahrenheit\n");
    printf("2. Fahrenheit -> Celsius\n");
    printf("-1. Exit\n\n");

    int choice;
    double input, result;

    /* Loop until user chooses to exit */
    while (1) {
        printf("Enter your choice: ");
        scanf("%d", &choice);

        if (choice == 1) {
            /* Celsius to Fahrenheit: F = C * 9/5 + 32 */
            printf("Enter temperature in Celsius: ");
            scanf("%lf", &input);
            result = input * 1.8 + 32;
            printf("Result: %.2f F\n\n", result);
        } else if (choice == 2) {
            /* Fahrenheit to Celsius: C = (F - 32) * 5/9 */
            printf("Enter temperature in Fahrenheit: ");
            scanf("%lf", &input);
            result = (input - 32) / 1.8;
            printf("Result: %.2f C\n\n", result);
        } else if (choice == -1) {
            printf("Goodbye!\n");
            break;
        } else {
            printf("Invalid choice, please try again.\n\n");
        }
    }

    return 0;
}
