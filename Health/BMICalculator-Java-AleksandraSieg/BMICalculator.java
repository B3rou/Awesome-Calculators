public class BMICalculator {
    public static double calculateBMI(double weight, double height) {
        height = height/100;
        return weight/(height*height);
    }
}
