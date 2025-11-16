import tkinter as tk
from tkinter import ttk, messagebox

def convert_temperature():
    try:
        temp = float(entry_temp.get())
        if conversion_type.get() == "C to F":
            result = (temp * 9/5) + 32
            label_result.config(text=f"{result:.2f} °F")
        else:
            result = (temp - 32) * 5/9
            label_result.config(text=f"{result:.2f} °C")
    except ValueError:
        messagebox.showerror("Invalid input", "Please enter a valid number.")

# Create main window
root = tk.Tk()
root.title("Temperature Converter")
root.geometry("300x200")
root.resizable(False, False)

# Entry for temperature
entry_temp = ttk.Entry(root, width=15, font=("Arial", 14))
entry_temp.pack(pady=10)

# Dropdown for conversion type
conversion_type = tk.StringVar(value="C to F")
dropdown = ttk.Combobox(root, textvariable=conversion_type, values=["C to F", "F to C"], state="readonly")
dropdown.pack(pady=5)

# Convert button
btn_convert = ttk.Button(root, text="Convert", command=convert_temperature)
btn_convert.pack(pady=10)

# Result label
label_result = ttk.Label(root, text="", font=("Arial", 16))
label_result.pack(pady=10)

root.mainloop()