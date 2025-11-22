import java.util.Scanner;
public class Main {
    public static void main(String [] args){
        double weight;
        double height;

        Scanner sc = new Scanner(System.in);

        //input weight in kg
        System.out.println("Please enter your weight in kg");
        if(!sc.hasNextDouble()){
            System.out.println("Error: weight must be a number");
            return;
        }
        weight = sc.nextDouble();

        //input height in kg
        System.out.println("Please enter your height in cm");
        if(!sc.hasNextDouble()){
            System.out.println("Error: height must be a number");
            return;
        }
        height = sc.nextDouble();

        if(weight <= 0 || height <=0){
            System.out.println("Error: weight and height must be a positive number");
            return;
        }

        //calculate BMI method
        double result = BMICalculator.calculateBMI(weight, height);
        double roundResult = Math.round(result*100.0)/100.0;

        System.out.println("Your BMI is: " + roundResult);

        if(roundResult < 18.5) {
            System.out.println("Underweight");
        }else if(roundResult >= 18.5 && roundResult < 25){
            System.out.println("Normal weight");
        }else if(roundResult >= 25 && roundResult < 30){
            System.out.println("Over weight");
        }else if(roundResult >= 30){
            System.out.println("Obesity");
        }

    }
}