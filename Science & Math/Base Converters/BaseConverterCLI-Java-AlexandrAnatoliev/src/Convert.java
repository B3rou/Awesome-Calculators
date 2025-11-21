/**
* A command-line utility for converting numbers between different
*   numerals systems.
* 
* Support binary (BIN), octal (OCT), decimal (DEC), and 
*   hexadecimal (HEX) bases.
*
* @version  0.1.0
* @since    19.11.2025
* @author   AlexandrAnatoliev
*/
public class Convert {
    /**
    * Main method that handles command-line arguments and executes
    *   number conversion.
    *
    * @param args Command-line arguments in the format:
    *   [number] [sourceBase] [targetBase]
    *   Example: "1010 bin dec" converts binary 1010 to decimal
    */
    public static void main(String args[]) {
        String number;
        Bases sourceBase;
        Bases targetBase;

        if (args.length > 2) {
            number = args[0];
            sourceBase = Bases.valueOf(args[1].toUpperCase(java.util.Locale.ENGLISH));
            targetBase = Bases.valueOf(args[2].toUpperCase(java.util.Locale.ENGLISH));
            
            int num = parseStringToInt(number, sourceBase);
            String convertNumber = parseIntToString(num, targetBase);

            System.out.println(number + " " + sourceBase + " -> "
                    + convertNumber + " " + targetBase);

        }
        else {
            System.out.println("Examples of use:");
            System.out.println("java Convert 1010 bin dec");
            System.out.println("java Convert 15 dec hex");
            System.out.println("java Convert 77 oct bin");
            System.out.println("java Convert 1F hex dec");
        }
    }

    /**
    * Converts a string representation of number in the specified base
    *   to a decimal integer
    *
    * @param number The string representation of the number to convert 
    * @param base The numeral system base of the input number
    *   (BIN, OCT, DEC, HEX)
    * @return The decimal integer value of the input number
    * @throws NumberFormatException If the input string
    *   is not a valid number in the specified base
    */
    public static int parseStringToInt(String number, Bases base) {
        switch (base) {
            case BIN:
                return Integer.parseInt(number, 2);
            case OCT:
                return Integer.parseInt(number, 8);
            case HEX:
                return Integer.parseInt(number, 16);
        }
        return Integer.parseInt(number);
    }

    /**
    * Converts a decimal integer to a string representation 
    *   in the specified base.
    *
    * @param num The decimal integer to convert
    * @param base The targetBase numeral system base
    *   (BIN, OCT, DEC, HEX)
    * @return String representation of the number in the target base 
    */
    public static String parseIntToString(int num, Bases base) {
        switch (base) {
            case BIN:
                return Integer.toString(num, 2);
            case OCT:
                return Integer.toString(num, 8);
            case HEX:
                return Integer.toString(num, 16);
        }
        return Integer.toString(num);
    }
}
