import sys

UNIT_MAP = {
    '1': ('b', 'Bits'),
    '2': ('B', 'Bytes'),
    '3': ('KB', 'Kilobytes'),
    '4': ('MB', 'Megabytes'),
    '5': ('GB', 'Gigabytes'),
    '6': ('TB', 'Terabytes'),
    '7': ('PB', 'Petabytes')
}

FACTORS_IN_BYTES = {
    'b': 1 / 8,
    'B': 1,
    'KB': 1024,
    'MB': 1024**2,
    'GB': 1024**3,
    'TB': 1024**4,
    'PB': 1024**5
}

def display_menu():
    print("\n💾 Data Storage Units (JEDEC Standard):")
    for key, (short, long) in UNIT_MAP.items():
        print(f"  {key}. {long} ({short})")

def get_unit_choice(prompt):
    while True:
        choice = input(prompt)
        if choice.lower() == 'exit':
            return None
        if choice in UNIT_MAP:
            return UNIT_MAP[choice][0]
        print(f"  [Error] Invalid choice. Please enter a number between 1 and {len(UNIT_MAP)}.")

def get_value():
    while True:
        value_str = input("Enter the value to convert: ")
        if value_str.lower() == 'exit':
            return None
        try:
            value = float(value_str)
            return value
        except ValueError:
            print("  [Error] Invalid input. Please enter a number.")

def converter():
    print("--- 💾 Data Storage Converter ---")
    print("Using JEDEC standard (1 KB = 1024 Bytes)")
    print("Type 'exit' at any time to quit.")
    
    while True:
        display_menu()
        
        from_unit = get_unit_choice("\nConvert FROM (select a number): ")
        if from_unit is None:
            break
            
        to_unit = get_unit_choice("Convert TO (select a number): ")
        if to_unit is None:
            break
            
        value = get_value()
        if value is None:
            break
        
        try:
            value_in_bytes = value * FACTORS_IN_BYTES[from_unit]
            result = value_in_bytes / FACTORS_IN_BYTES[to_unit]
            
            print("\n--- Result ---")
            print(f"{value:,.12g} {from_unit} = {result:,.12g} {to_unit}")
            print("-" * 25)

        except Exception as e:
            print(f"An error occurred during conversion: {e}")

    print("\nThank you for using the converter. Goodbye!")

if __name__ == "__main__":
    converter()
