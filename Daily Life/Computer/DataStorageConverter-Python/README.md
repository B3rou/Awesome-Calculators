# 💾 Data Storage Converter (Python)

A command-line tool to convert between various units of digital data storage.

This calculator specifically uses the **JEDEC (base 1024) standard**, where:
* `1 Kilobyte (KB) = 1024 Bytes`
* `1 Megabyte (MB) = 1024 Kilobytes`
* ...and so on.

---

## 📦 Features
-   Converts between:
    -   Bits (b)
    -   Bytes (B)
    -   Kilobytes (KB)
    -   Megabytes (MB)
    -   Gigabytes (GB)
    -   Terabytes (TB)
    -   Petabytes (PB)
-   Easy-to-use interactive menu interface.
-   Input validation for numeric values and menu choices.
-   Created to solve [Issue #26](https://github.com/B3rou/Awesome-Calculators/issues/26) in the Awesome-Calculators repository.

---

## 🚀 How to Run
No external dependencies are required. Simply run it with Python 3:

```bash
python main.py
````

---

## 💡 Example Usage

```bash
--- 💾 Data Storage Converter ---
Using JEDEC standard (1 KB = 1024 Bytes)
Type 'exit' at any time to quit.

💾 Data Storage Units (JEDEC Standard):

1.  Bits (b)
2.  Bytes (B)
3.  Kilobytes (KB)
4.  Megabytes (MB)
5.  Gigabytes (GB)
6.  Terabytes (TB)
7.  Petabytes (PB)

Convert FROM (select a number): 5
Convert TO (select a number): 3
Enter the value to convert: 1

--- Result ---
1 GB = 1,048,576 KB
```

---

## 🧑‍💻 Author

Contributed by [ifauzeee](https://github.com/ifauzeee)
Added as part of the **Awesome Calculators** collection.

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
