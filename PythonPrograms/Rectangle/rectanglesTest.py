'''
Name: Darius Sandford                             Date Assigned: 02-08-2018

Course: 1384 Sec 11                               Date due: 02-08-2018

File Name: rectanglesTest.py

Description: The purpose of this program is to test the Rectangles class
'''
from Rectangle import Rectangle

def main():
    #Prompts the user to enter the length and width
    length = input("Enter the length: ")
    width = input("Enter the width: ")
    #Creates an object of the class
    my_rectangle = Rectangle(length, width)
    #Print the length and width
    print("length:", my_rectangle.get_length())
    print("width:", my_rectangle.get_width())

    
main()
