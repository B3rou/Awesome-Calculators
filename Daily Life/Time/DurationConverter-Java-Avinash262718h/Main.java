import java.util.Scanner;
import java.util.Map;

public final class Main {
    // Stores all conversion factors with 'seconds' as the base unit.
    private static final Map<String, Integer> map = Map.of(
        "year", 31557600,
        "month", 2629800, // Note: This is an average month
        "week", 604800,
        "day", 86400,
        "hour", 3600,
        "min", 60,
        "sec", 1
    );

    public static void main(String[] args) 
  {
        // 'try-with-resources' is the *best* way to use a Scanner.
        // It automatically closes the scanner for you, even if an error happens.
        try (Scanner sc = new Scanner(System.in)) 
        {
            
            System.out.println("=== Duration Converter ===");
            System.out.println("Supported units: year, month, week, day, hour, min, sec.");
            System.out.println("Enter duration, from_unit, and to_unit (e.g., 2 hour min):");
            final long duration = sc.nextLong();
            final String from = sc.next().toLowerCase(); 
            final String to = sc.next().toLowerCase();  
            // validating the inputs
            if (!map.containsKey(from) || !map.containsKey(to)) 
            {
                System.err.println("Error: Unknown unit.");
                return; 
            }
            // multiplying the from_unit with duration and dividing with to_unit. It will eliminate the seconds reference.
            final double result = ((double) duration * map.get(from))/ map.get(to);
            System.out.println(duration + " " + from + " = " + result + " " + to);
        } catch (Exception e) 
        {
            System.err.println("Invalid input. Please enter a number followed by two units.");
        }
    }
}
