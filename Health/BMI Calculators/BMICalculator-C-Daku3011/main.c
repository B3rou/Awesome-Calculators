#include <stdio.h>

int main(void) {
    
    float weight_kg, height_m, bmi;
    
    printf("Enter your weight in kilograms (e.g., 68.5): ");
    // Validate input: Check if scanf successfully read a float
    if (scanf("%f", &weight_kg) != 1 || weight_kg <= 0) {
        printf("Invalid input. Weight must be a positive number.\n");
        return 1; // Exit with an error
    }


    printf("Enter your height in meters (e.g., 1.75): ");
    // Validate input: Check if scanf successfully read a float
    if (scanf("%f", &height_m) != 1 || height_m <= 0) {
        printf("Invalid input. Height must be a positive number.\n");
        return 1; // Exit with an error
    }

    
    // Calculate BMI using the formula: weight / (height * height)
    bmi = weight_kg / (height_m * height_m);
    
    printf("\n--- Your Results ---\n");
    printf("Weight:   %.2f kg\n", weight_kg);
    printf("Height:   %.2f m\n", height_m);
    printf("Your BMI is: %.2f\n", bmi);

    // Interpret the BMI and print the corresponding category
    printf("Category: ");
    if (bmi < 18.5) {
        printf("Underweight\n");
    } else if (bmi >= 18.5 && bmi <= 24.9) {
        printf("Normal weight\n");
    } else if (bmi >= 25.0 && bmi <= 29.9) {
        printf("Overweight\n");
    } else { // bmi >= 30.0
        printf("Obesity\n");
    }

    // Display the WHO BMI categories for reference
    printf("\n--- BMI Categories (WHO) ---\n");
    printf("Underweight:    < 18.5\n");
    printf("Normal weight:  18.5–24.9\n");
    printf("Overweight:     25–29.9\n");
    printf("Obesity:        BMI of 30 or greater\n");

    return 0; // Indicate successful execution
}