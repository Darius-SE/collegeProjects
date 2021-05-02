'''
Name: Darius Sandford and Brandon Dickens                      Date Assigned: 02-22-2018

Course: 1384 Sec 11                                            Date due: 02-22-2018

File Name: feetInchesTest.py

Description: A program to test the class.
'''

from FeetInches import FeetInches

def main():
    #Gets input from the user
    feet = input("Enter a number of feet: ")
    inches = input("Enter a number of inches: ")

    #Creates an object of the class 
    measurement = FeetInches(feet, inches)
    print(measurement)

    #Test getters
    f = measurement.get_feet()
    i = measurement.get_inches()
    print(f)
    print(i)

    #Tests overload operators
    x = FeetInches(input("Enter a number: "))
    y = FeetInches(input("Enter a another number: "))

    #Tests __add__, __sub__, __mul__, and __truediv__
    total = x + y
    print("Total: ", total)
    difference = x - y
    print("Difference: ", difference)
    product = x * y
    print("Product: ", product)
    quotient = x / y
    print("Quotient: ", quotient)

    #Tests <, <=, >, >=, ==, !=
    if x > y:
        print(x, '>', y)
    if x >= y:
        print(x, '>=', y)
    if y < x:
        print(x, '<', y)
    if y <= x:
        print(x, '<=', y)
    if x == x:
        print(x, '==', x)
    if x != y:
        print(x, '!=', x)

    #Test __iadd__, __isub__, __imul__, __itruediv__
    measurement = FeetInches(feet, inches)
    x += y
    print(x)

    measurement = FeetInches(feet, inches)
    x -= y
    print(x)

    measurement = FeetInches(feet, inches)
    x *= y
    print(x)

    measurement = FeetInches(feet, inches)
    x /= y
    print(x)
    
    
main()


                


    
