#include <stdio.h>

/*
    Ohm's Law Calculator in C
    Formula: V = I * R

    V = Voltage (Volts)
    I = Current (Amperes)
    R = Resistance (Ohms)
*/

int main() {
    int choice;
    float V, I, R;

    printf("=== Ohm's Law Calculator ===\n");
    printf("What would you like to calculate?\n");
    printf("1. Voltage (V)\n");
    printf("2. Current (I)\n");
    printf("3. Resistance (R)\n");

    printf("Enter your choice (1-3): ");
    scanf("%d", &choice);

    switch(choice) {
        case 1:
            // Calculate Voltage
            printf("\nEnter Current (I) in Amperes: ");
            scanf("%f", &I);
            printf("Enter Resistance (R) in Ohms: ");
            scanf("%f", &R);
            V = I * R;
            printf("\nVoltage = %.2f Volts\n", V);
            break;

        case 2:
            // Calculate Current
            printf("\nEnter Voltage (V) in Volts: ");
            scanf("%f", &V);
            printf("Enter Resistance (R) in Ohms: ");
            scanf("%f", &R);
            if (R == 0){
                printf("Can't divide by zero, terminating...");
                return 0;
            }
            I = V / R;
            printf("\nCurrent = %.2f Amperes\n", I);
            break;

        case 3:
            // Calculate Resistance
            printf("\nEnter Voltage (V) in Volts: ");
            scanf("%f", &V);
            printf("Enter Current (I) in Amperes: ");
            scanf("%f", &I);
            if (I == 0){
                printf("Can't divide by zero, terminating...");
                return 0;
            }
            R = V / I;
            printf("\nResistance = %.2f Ohms\n", R);
            break;

        default:
            printf("\nInvalid choice! Please run the program again.\n");
    }

    return 0;
}
