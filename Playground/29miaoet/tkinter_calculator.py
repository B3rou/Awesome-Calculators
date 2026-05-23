
import tkinter as tk
from tkinter import font
import re
from decimal import Decimal, getcontext, DivisionByZero, Overflow

#=================================================EVENT FUNCTIONS=====================================================#

getcontext().prec = 40

# Global control variables, very important! Also, very messy:
cont = False # continue, determines whether read_input should read.
dest = False # destroy, determines if an error has occurred.
mutable = 0 # mutable, determines how many characters are entered by the user, resets after each calculation.

signs = ["+","-","×","÷"]

def read_input(something):
    global cont
    global mutable
    if dest: clear_screen()
    
    if cont or something in signs:
        existing_text=lbl_value["text"]
        lbl_value["text"]=existing_text + something
    else:
        lbl_value["text"]=something
    cont = True
    mutable += 1

    
def remove_first(s, char):
    index = s.find(char)
    if index == -1:
        return s
    return s[:index] + s[index+1:]
    
def clear_screen():
    global cont
    global dest
    lbl_value["text"]="0"
    cont=False
    dest=False
    
def format_decimal(x):
    if x.adjusted() >= 50:
        return f"{x:.35E}"
    else:
        return format(x, 'f')
    
def calculate(sign):
    global cont
    global mutable
    if dest: 
       clear_screen()
       return
    try:
    
        expression=lbl_value["text"]

        if "+" in expression and "E" not in expression:
            terms = expression.split("+")
            expression = Decimal(terms[0]) + Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "-" in expression and "E" not in expression and expression[0] != "-" or expression[0] == "-" and expression.count("-") == 2 and "E" not in expression:
            if expression.count("-") == 1 and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]) - Decimal(terms[1])
                expression=expression.normalize()
            elif expression.count("-") == 2 and expression[0] == "-":
                terms = expression.split("-")
                expression = - Decimal(terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "×" in expression:
            terms = expression.split("×")
            expression = Decimal(terms[0]) * Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "÷" in expression:
            terms = expression.split("÷")
            expression = Decimal(terms[0]) / Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "E" in expression:
            if expression.count("+") == 2:
                terms = expression.split("+")
                expression = Decimal(terms[0]+"+"+terms[1]) + Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif expression.count("-") == 2 and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]+"-"+terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif expression.count("-") == 3:
                terms = expression.split("-")
                expression = - Decimal(terms[1]+"-"+terms[2]) - Decimal(terms[3])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E+" in expression and "-" in expression and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]) - Decimal(terms[1])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E+" in expression and expression.count("-") == 2:
                terms = expression.split("-")
                expression = - Decimal(terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E-" in expression and "+" in expression:
                terms = expression.split("+")
                expression = Decimal(terms[0]) + Decimal(terms[1])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
        mutable = 0
        read_input(sign)
        cont = True
    
    except DivisionByZero:
        lbl_value["text"]="Cannot divide by 0"
        cont = False
    except Overflow:
        lbl_value["text"]="Overflow"
        cont = False
    except ArithmeticError:
        pass
        
def is_calculate(sign):
    global cont
    global dest
    global mutable
    if dest: 
       clear_screen()
       return
    try:
        expression=Decimal(lbl_value["text"])
        
        if sign == "1/x":
            expression=1/expression
            lbl_value["text"]=str(expression)
            cont = False
        elif sign == "²":
            digits_before_decimal = len(str(int(expression))) * 2
            getcontext().prec = digits_before_decimal + 40 
            expression = Decimal(expression)
            expression = expression ** 2
            rounded = expression.quantize(Decimal('1e-30'))
            expression = rounded.normalize()
            getcontext().prec = 40
            expression = Decimal(expression)
            expression = format_decimal(expression)
            lbl_value["text"]=str(expression)
            cont = False
        elif sign == "√":
            if expression<0:
                lbl_value["text"]=handle_complex(expression)
                cont = False
                dest = True
            else:
                expression=expression.sqrt()
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            cont = False
        elif sign == "±":
            expression=-expression
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
            cont = True
        elif sign == "%":
            expression=expression/100
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
            cont = False
        mutable = 0
            
    except DivisionByZero:
        lbl_value["text"]="Cannot divide by 0"
        dest = True
    except Overflow:
        lbl_value["text"]="Overflow"
        dest = True
    except ValueError:
        lbl_value["text"]="Overflow"
        dest = True
    except ArithmeticError:
        pass
    
    
    
def get_result():
    global cont
    global dest
    try:
    
        expression=lbl_value["text"]

        if "+" in expression and "E" not in expression:
            terms = expression.split("+")
            expression = Decimal(terms[0]) + Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "-" in expression and "E" not in expression and expression[0] != "-" or expression[0] == "-" and expression.count("-") == 2 and "E" not in expression:
            if expression.count("-") == 1 and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]) - Decimal(terms[1])
                expression=expression.normalize()
            elif expression.count("-") == 2 and expression[0] == "-":
                terms = expression.split("-")
                expression = - Decimal(terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "×" in expression:
            terms = expression.split("×")
            expression = Decimal(terms[0]) * Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "÷" in expression:
            terms = expression.split("÷")
            expression = Decimal(terms[0]) / Decimal(terms[1])
            expression=expression.normalize()
            lbl_value["text"]=str(expression)
        elif "E" in expression:
            if expression.count("+") == 2:
                terms = expression.split("+")
                expression = Decimal(terms[0]+"+"+terms[1]) + Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif expression.count("-") == 2 and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]+"-"+terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif expression.count("-") == 3:
                terms = expression.split("-")
                expression = - Decimal(terms[1]+"-"+terms[2]) - Decimal(terms[3])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E+" in expression and "-" in expression and expression[0] != "-":
                terms = expression.split("-")
                expression = Decimal(terms[0]) - Decimal(terms[1])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E+" in expression and expression.count("-") == 2:
                terms = expression.split("-")
                expression = - Decimal(terms[1]) - Decimal(terms[2])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
            elif "E-" in expression and "+" in expression:
                terms = expression.split("+")
                expression = Decimal(terms[0]) + Decimal(terms[1])
                expression=expression.normalize()
                lbl_value["text"]=str(expression)
        else:
            lbl_value["text"]=str(expression)
        cont = False
        
        
        
    except DivisionByZero:
        lbl_value["text"]="Cannot divide by 0"
        dest = True
    except Overflow:
        lbl_value["text"]="Overflow"
        dest = True
    except ArithmeticError:
        pass
        
def clear_entry():
    global cont    
    exponp = False
    exponm = False
    text = lbl_value["text"]
    if "E+" in text:
        text = text.replace("E+", "E")
        exponp = True
    elif "E-" in text:
        text = text.replace("E-", "E")
        exponm = True
    result = re.split(r'[+\-×÷]', text)
    del(result[-1])
    result = "".join(result)
    if result == "": result = "0"
    if exponp: result = result.replace("E", "E+")
    elif exponm: result = result.replace("E", "E-")
    lbl_value["text"] = result
    cont = False

def backspace():
    global cont
    global mutable
    text = lbl_value["text"]
    if mutable > 0:
        result = text[:-1]
        if result == "": result = "0"
        mutable -= 1
        lbl_value["text"] = result
    cont = True

def handle_complex(expression):
    expression = -expression
    expression = expression.sqrt()
    if expression == 1:
        result = "i"
    else:
        result = str(expression)+"i"
    return result
    
    
#===============================================TKINTER GRAPHICS================================================#


window = tk.Tk()
window.rowconfigure(0, minsize=120, weight=1)
window.rowconfigure(1, minsize=480, weight=1)
window.columnconfigure(0, minsize=1150, weight=1)
window.title("Tkinter Calculator")

numbers = tk.Frame(master=window, bg="#f3f3f3")
frm_display = tk.Frame(master=window, bg="#E6F0FA")
frm_display.grid_rowconfigure(0, weight=1)
frm_display.grid_columnconfigure(0, weight=1)
numbers.grid_rowconfigure([0,1,2,3,4,5], weight=1)
numbers.grid_columnconfigure([0,1,2,3], weight=1)

my_font = font.Font(family="Segoe UI", size=30, weight="bold")

button_style={
    "font": ("Segoe UI", 17),
    "relief": "raised",
    "bg": "#f9f9f9"
}

operator_style={
    "font": ("Segoe UI", 17),
    "relief": "raised",
    "bg": "#f1f1f1"
}

equal_style={
    "font": ("Segoe UI", 17),
    "relief": "raised",
    "bg": "#0067c0",
    "fg": "white"
}



# first row
btn_per = tk.Button(master=numbers, text="%", **operator_style, command=lambda: is_calculate("%"))
btn_per.grid(row=0, column=0, sticky="nesw", padx=2, pady=2)

btn_ce = tk.Button(master=numbers, text="CE", **operator_style, command=clear_entry)
btn_ce.grid(row=0, column=1, sticky="nesw", padx=2, pady=2)

btn_c = tk.Button(master=numbers, text="C", **operator_style, command=clear_screen)
btn_c.grid(row=0, column=2, sticky="nesw", padx=2, pady=2)

btn_bk = tk.Button(master=numbers, text="⌫", **operator_style, command=backspace)
btn_bk.grid(row=0, column=3, sticky="nesw", padx=2, pady=2)

# second row

btn_rc = tk.Button(master=numbers, text="1/x", **operator_style, command=lambda: is_calculate("1/x"))
btn_rc.grid(row=1, column=0, sticky="nesw", padx=2, pady=2)

btn_sq = tk.Button(master=numbers, text="x²", **operator_style, command=lambda: is_calculate("²"))
btn_sq.grid(row=1, column=1, sticky="nesw", padx=2, pady=2)

btn_sqrt = tk.Button(master=numbers, text="√", **operator_style, command=lambda: is_calculate("√"))
btn_sqrt.grid(row=1, column=2, sticky="nesw", padx=2, pady=2)

btn_d = tk.Button(master=numbers, text="÷", **operator_style, command=lambda: calculate("÷"))
btn_d.grid(row=1, column=3, sticky="nesw", padx=2, pady=2)

# third row
btn_7 = tk.Button(master=numbers, text="7", **button_style, command=lambda: read_input("7"))
btn_7.grid(row=2, column=0, sticky="nesw", padx=2, pady=2)

btn_8 = tk.Button(master=numbers, text="8", **button_style, command=lambda: read_input("8"))
btn_8.grid(row=2, column=1, sticky="nesw", padx=2, pady=2)

btn_9 = tk.Button(master=numbers, text="9", **button_style, command=lambda: read_input("9"))
btn_9.grid(row=2, column=2, sticky="nesw", padx=2, pady=2)

btn_t = tk.Button(master=numbers, text="×", **operator_style, command=lambda: calculate("×"))
btn_t.grid(row=2, column=3, sticky="nesw", padx=2, pady=2)

# fourth row
btn_4 = tk.Button(master=numbers, text="4", **button_style, command=lambda: read_input("4"))
btn_4.grid(row=3, column=0, sticky="nesw", padx=2, pady=2)

btn_5 = tk.Button(master=numbers, text="5", **button_style, command=lambda: read_input("5"))
btn_5.grid(row=3, column=1, sticky="nesw", padx=2, pady=2)

btn_6 = tk.Button(master=numbers, text="6", **button_style, command=lambda: read_input("6"))
btn_6.grid(row=3, column=2, sticky="nesw", padx=2, pady=2)

btn_m = tk.Button(master=numbers, text="-", **operator_style, command=lambda: calculate("-"))
btn_m.grid(row=3, column=3, sticky="nesw", padx=2, pady=2)

# fifth row
btn_1 = tk.Button(master=numbers, text="1", **button_style, command=lambda: read_input("1"))
btn_1.grid(row=4, column=0, sticky="nesw", padx=2, pady=2)

btn_2 = tk.Button(master=numbers, text="2", **button_style, command=lambda: read_input("2"))
btn_2.grid(row=4, column=1, sticky="nesw", padx=2, pady=2)

btn_3 = tk.Button(master=numbers, text="3", **button_style, command=lambda: read_input("3"))
btn_3.grid(row=4, column=2, sticky="nesw", padx=2, pady=2)

btn_p = tk.Button(master=numbers, text="+", **operator_style, command=lambda: calculate("+"))
btn_p.grid(row=4, column=3, sticky="nesw", padx=2, pady=2)

# sixth row
btn_neg = tk.Button(master=numbers, text="±", **button_style, command=lambda: is_calculate("±"))
btn_neg.grid(row=5, column=0, sticky="nesw", padx=2, pady=2)

btn_0 = tk.Button(master=numbers, text="0", **button_style, command=lambda: read_input("0"))
btn_0.grid(row=5, column=1, sticky="nesw", padx=2, pady=2)

btn_dot = tk.Button(master=numbers, text=".", **button_style, command=lambda: read_input("."))
btn_dot.grid(row=5, column=2, sticky="nesw", padx=2, pady=2)

btn_eq = tk.Button(master=numbers, text="=", **equal_style, command=get_result)
btn_eq.grid(row=5, column=3, sticky="nesw", padx=2, pady=2)


lbl_value = tk.Label(master=frm_display, text="0", font=my_font, bg="#E6F0FA")

numbers.grid(row=1, column=0, sticky="nsew", padx=5, pady=5)
lbl_value.grid(sticky="e", padx=15)
frm_display.grid(row=0, column=0, sticky="nsew", padx=5, pady=(5,0))

window.mainloop()
