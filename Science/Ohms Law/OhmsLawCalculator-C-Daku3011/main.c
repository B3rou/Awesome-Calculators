#include <stdio.h>

int main(int argc, char const *argv[])
{
    double first, second; //User input numbers
    char op; //Operator
    
    printf("Choose any one Voltage(V), Current(I), or Resistance(R) : ");
    scanf("%c", &op);
    getchar(); //Consume newline character
    switch (op)
    {
        // For Voltage(V) calculation
        case 'V':
        case 'v': // for both lowercase and uppercase
            printf("Please enter Current(I) and Resistance(R):\n"); // Asking user for I and R
            scanf("%lf%lf", &first, &second);
            getchar();

            printf("As per Formula V*R = V = : %.2lf V\n", first * second);
            break;

        // For Current(I) calculation
        case 'I':
        case 'i':// for both lowercase and uppercase
            printf("Please enter Voltage(V) and Resistance(R):\n"); // asking user for V and R 
            scanf("%lf%lf", &first, &second);
            getchar();

            if (second == 0){
                printf("Can't divide by zero, terminating...");
                return 0;
            }
            
            printf("As per formula V/R = I = %.2lf I\n", first / second);
            break;
            

        // For Resistance(R) calculation
        case 'R':
        case 'r':// for both lowercase and uppercase
            printf("Please enter Voltage(V) and Current(I):\n"); //Asking user for V and I
            scanf("%lf%lf", &first, &second);
            getchar();

            if (second == 0){
                printf("Can't divide by zero, terminating...");
                return 0;
            }
            
            printf("As per formual V/I = R = %.2lf R\n", first / second);
            break;

        default:
            printf("Invalid operator entered!");
            break;
    }

    return 0;
}
