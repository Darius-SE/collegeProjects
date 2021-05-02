'''
Name: Darius Sandford                                Date Assigned: 02-08-2018

Course: 1384 Sec 11                                  Date due: 02-08-2018

File Name: Rectangle.py

Description: The purpose of this lab is to create a Rectangle class and make it as foolproof as possible.
'''
#Creates Class
class Rectangle:
    #Creates constructor that initializes data and makes sure value entered is int or float and is positive or negative
    def __init__(self, length = 1, width = 1):
        try:
            length = float(length)
            width = float(width)
        except Exception as ex:
            raise ValueError ("length and width must be int or float")

        if length <= 0:
            raise ValueError ("length must be positive and non-zero")

        elif width <= 0:
            raise ValueError ("length must be positive and non-zero")

        elif length == " ":
            raise ValueError ("length must be int or float")

        elif width == " ":
            raise ValueError ("length must be int or float")

        self.__length = length
        self.__width = width
        return
    #Creates a setter for length that makes sure value is an int or float and positive and non-zero
    def set_length(self, length):
        try:
            length = float(length)
        except Exception as ex:
            raise ValueError ("length must be int or float")

        if length <= 0:
            raise ValueError ("length must be positive and non-zero")

        elif length == " ":
            raise ValueError ("length must be int or float")

        self.__length = length
        return
    #Creates a getter for length that returns length
    def get_length(self):
        return self.__length
    #Creates a setter for width that makes sure value is an int or float and positive and non-zero
    def set_width(self, width):
        try:
            width = float(width)
        except Exception as ex:
            raise ValueError ("width must be int or float")

        if width <= 0:
            raise ValueError ("width must be positive and non-zero")

        elif width == " ":
            raise ValueError ("width must be int or float")

        self.__width = width
        return
    #Creates a getter for width that returns width
    def get_width(self):
        return self.__width
        
