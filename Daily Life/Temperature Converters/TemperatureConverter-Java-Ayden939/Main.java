import java.util.Scanner;

public class Main{



    public static void main(String[] args){

        // Read in Input
        Scanner scan = new Scanner(System.in);
        System.out.println("Temperature Converter");
        System.out.println("Option 1: Fahrenheit -> Celsius");
        System.out.println("Option 2: Celsius -> Fahrenheit");
        System.out.println("Please enter 1 or 2 for the conversion type:    ");
        int choice = scan.nextInt();

        // Validate choice is appropriate
        while(choice != 1 && choice != 2){
            System.out.println("Invalid input, please enter 1 or 2: ");
            choice = scan.nextInt();
        }

        // Validate temperature is appropriate
        System.out.println("Please enter a temperature: ");
        while(!scan.hasNextFloat() ){
            System.out.println("Invalid input! Please enter a numeric value:");
            scan.next();
        }
        float temp = scan.nextFloat();

        //Based on choice, call correct method and print result
        if(choice == 1){
            float celsius = getCelsius(temp);
            System.out.printf("%.1f", celsius);
            System.out.println();
        }else{
            float fahrenheit = getFahrenheit(temp);
            System.out.printf("%.1f", fahrenheit);
            System.out.println();
        }        
    }

    // Method to convert fahrenheit to celsius
    public static float getCelsius(float fahrenheit){

        float celsius = (fahrenheit - 32) * 5/9;
        
        return celsius;
    }

    // Method to convert celsius to fahrenheit
    public static float getFahrenheit(float celsius){

        float fahrenheit = (celsius * 9/5) + 32;

        return fahrenheit;
    }

}