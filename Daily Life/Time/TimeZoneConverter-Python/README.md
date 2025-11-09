# 🕒 Time Zone Converter (Python)

A command-line tool to convert the current time between different IANA time zones, written in Python.

This calculator fetches the current time in a specified source time zone and displays the corresponding time in a target time zone, correctly accounting for Daylight Saving Time (DST) rules.

---

## 📦 Features
-   Uses the **`pytz`** library for accurate, up-to-date time zone data.
-   Provides user-friendly error handling for invalid time zone names.
-   Displays the converted time in a clear, human-readable format, as requested in [Issue #22](https://github.com/B3rou/Awesome-Calculators/issues/22).
-   Includes an interactive loop to perform multiple conversions without restarting.

---

## 🚀 How to Run

1.  **Install the required dependency:**
    This program requires the `pytz` library. You can install it using pip:
    ```
    pip install pytz
    ```

2.  **Run the script:**
    Make sure you have **Python 3.7+** installed, then run the following command in your terminal:
    ```
    python main.py
    ```

---

## 💡 Example Usage

```
## 🕒 Welcome to the Time Zone Converter
Enter 'exit' at any time to quit.

Enter source time zone (e.g., 'Europe/Istanbul'): Asia/Tokyo
Enter target time zone (e.g., 'America/New_York'): America/New_York

## --- Result ---
Source: Asia/Tokyo -> Current time is: 10:00 AM (JST)
Target: America/New_York -> Converted time is: 09:00 PM on November 4th, 2025 (EST)
```

---

## 🧑‍💻 Author
Contributed by [ifauzeee](https://github.com/ifauzeee)  
Added as part of the **Awesome Calculators** collection.

## 📝 License
This calculator is open-source and available under the MIT License.