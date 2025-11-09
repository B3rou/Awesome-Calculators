import datetime
import pytz
import sys

def get_day_suffix(day):
    if 10 <= day % 100 <= 20:
        return 'th'
    else:
        return {1: 'st', 2: 'nd', 3: 'rd'}.get(day % 10, 'th')

def get_valid_timezone(prompt):
    while True:
        try:
            tz_str = input(prompt)
            if tz_str.lower() == 'exit':
                return None
            
            return pytz.timezone(tz_str)
            
        except pytz.UnknownTimeZoneError:
            print(f"  [Error] Unknown time zone: '{tz_str}'")
            print("  Please use a valid IANA time zone name (e.g., 'America/New_York', 'Europe/Istanbul', 'UTC', 'Asia/Tokyo').")
            print("  Enter 'exit' to quit.")
        except Exception as e:
            print(f"An unexpected error occurred: {e}")

def converter():
    print("🕒 Welcome to the Time Zone Converter")
    print("   Enter 'exit' at any time to quit.")
    print("-" * 40)
    
    while True:
        source_tz = get_valid_timezone("\nEnter source time zone (e.g., 'Europe/Istanbul'): ")
        if source_tz is None:
            break

        target_tz = get_valid_timezone("Enter target time zone (e.g., 'America/New_York'): ")
        if target_tz is None:
            break

        try:
            source_dt = datetime.datetime.now(source_tz)

            target_dt = source_dt.astimezone(target_tz)

            source_time_str = source_dt.strftime('%I:%M %p (%Z)')
            
            day = target_dt.day
            suffix = get_day_suffix(day)
            target_time_str = target_dt.strftime(f'%I:%M %p on %B {day}{suffix}, %Y (%Z)')

            print("\n--- Result ---")
            print(f"Source: {source_tz.zone}")
            print(f"   -> Current time is: {source_time_str}")
            print(f"Target: {target_tz.zone}")
            print(f"   -> Converted time is: {target_time_str}")
            print("-" * 40)

        except Exception as e:
            print(f"An error occurred during conversion: {e}")
            
    print("\nThank you for using the Time Zone Converter! Goodbye. 👋")

if __name__ == "__main__":
    try:
        import pytz
    except ImportError:
        print("Error: The 'pytz' library is required but not installed.")
        print("Please install it by running: pip install pytz")
        sys.exit(1)
        
    converter()