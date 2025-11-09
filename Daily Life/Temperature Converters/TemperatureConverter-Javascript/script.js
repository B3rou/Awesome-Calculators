import readline from 'node:readline';


// Allows javascript to read inputs from the command line
const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout,
});


// Ask for type of Conversion
rl.question("Please type \n'c' if you want to convert from Celcius to Fahrenheit, and type \n'f' if you want to convert from Fahrenheit to Celcius.\n (Hit 'enter/return' after typing your selection):\n ", (type) => {

    // If type is Celcius -> Fahrenheit 
    if(type == 'c'){

        // Asks for temp in Celcius
        rl.question("You chose to convert from C->F. Please enter the temp in degrees Celcius: \n", (temp) => {
            //Converts C->F
            const F = (temp * (9/5) + 32);
            console.log(`${temp}° degress Celcius is equal to ${F.toFixed(2)} degrees Fahrenheit`);
            // Close Command line interface
            rl.close();
        });

    // If type is Fahrenheit -> Celcius
    } else if(type == 'f'){

        // Asks for temp in Fahrenheit
        rl.question("You chose to convert from F->C. Please enter the temp in degrees Fahrenheit: \n", (temp) => {
            // Converts F->C
            const C = (temp -  32) * (5/9); 
            console.log(`${temp}° Fahrenheit is equal to ${C.toFixed(2)} degrees Celcius`);
            // Close Command line interface
            rl.close();
        });


    // If type not recognized
    } else {
        rl.close();
    }
    
});





