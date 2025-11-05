#include <stdio.h>


int main(void) {
    
    float celsius, fahrenheit; // Variables to hold the temperature values
    char choice;              // Variable to hold user's choice

    printf("Choose conversion (°C to °F or °F to °C) [C/F]: ");
    scanf(" %c", &choice); // The leading space in " %c" is important to consume any leftover


    // --- Celsius to Fahrenheit Conversion ---
    if (choice == 'C' || choice == 'c') {

        printf("Enter temperature in Celsius: ");
        scanf("%f", &celsius);
        // Formula is (C * 9/5) + 32
        fahrenheit = (celsius * 9.0 / 5.0) + 32.0;
        printf("Temperature in Fahrenheit: %.2f\n", fahrenheit);
        

    // --- Fahrenheit to Celsius Conversion ---
    } else if (choice == 'F' || choice == 'f') {

        printf("Enter temperature in Fahrenheit: ");
        scanf("%f", &fahrenheit);
        // Formula is (F - 32) * 5/9
        celsius = (fahrenheit - 32.0) * 5.0 / 9.0;
        printf("Temperature in Celsius: %.2f\n", celsius);
        
    } else {
        printf("Invalid choice!\n");
        return 1; //This indicates an error occurred
    }

    return 0;
}
