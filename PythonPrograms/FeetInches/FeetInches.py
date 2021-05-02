'''
Name: Darius Sandford and Brandon Dickens                      Date Assigned: 02-22-2018

Course: 1384 Sec 11                                            Date due: 02-22-2018

File Name: FeetInches.py

Description: Create a class with regular methods as well as functions that allow objects of the class to be added, subtracted, etc.
'''
class FeetInches:
    #Create Constructor for class with exception handling that makes sure numbers entered are non-negative and convert feet to inches
    def __init__(self, feet = 1, inches = 1):
        try:
            feet = int(feet) * 12
            inches = int(inches)
        except Exception as ex:
            raise ValueError ("Number must be an int")
        if feet >= 0 or inches >= 0:
            self.__integer = feet + inches
        else:
            raise ValueError ("Number must be a positive or zero")   

    #Create getter for feet
    def get_feet(self):
        return self.__integer // 12

    #Create getter for inches
    def get_inches(self):
        return self.__integer % 12

    #Create setter for feet
    def set_feet(self, feet):
        try:
            feet = float(feet)
        except Exception as ex:
            raise ValueError ("Number must be int or float")

        self.__feet = feet

    #Create setter for inches
    def set_inches(self, inches):
        try:
            inches = float(inches)
        except Exception as ex:
            raise ValueError ("Number must be int or float")

        self.__inches = inches

    #Create str function for class
    def __str__(self):
        feet = self.__integer // 12
        inches = self.__integer % 12
        string = ""
        if feet == 1:
            string += "1 foot "
        else:
            string += (str(feet) + " feet ")
        if inches != 1:
            string += (str(inches) + " inches")
        else:
            string += (str(inches) + " inch")                   
        return string

    #Overload +
    def __add__(self, x):
        total = FeetInches()
        total.__integer = self.__integer + x.__integer
        return total
        
    #Overload -
    def __sub__(self, x):
        difference = FeetInches()
        difference.__integer = self.__integer - x.__integer
        if difference.__integer < 0:
            raise ValueError ("Subtraction resulted in an invalid distance")
        return difference

    #Overload *
    def __mul__(self, x):
        product = FeetInches()
        product.__integer = self.__integer * x.__integer
        return product

    #Overload //
    def __truediv__(self, x):
        quotient = FeetInches()
        quotient.__integer = self.__integer // x.__integer
        return quotient

    #Overload +=
    def __iadd__(self, x):
        self.__integer += x.__integer
        return self

    #Overload -=
    def __isub__(self, x):
        self.__integer -= x.__integer
        if self.__integer < 0:
            raise ValueError("-= resulted in an invalid distance")
        return self

    #Overload *=
    def __imul__(self, x):
        self.__integer *= x.__integer
        return self

    #Overload /=
    def __itruediv__(self, x):
        self.__integer /= x.__integer
        self.__integer = int(self.__integer)
        return self

    #Overload <
    def __lt__(self, x):
        return self.__integer < x.__integer

    #Overload <=
    def __le__(self, x):
        return self.__integer <= x.__integer

    #Overload >
    def __gt__(self, x):
        return self.__integer > x.__integer

    #Overload >=
    def __ge__(self, x):
        return self.__integer >= x.__integer

    #Overload ==
    def __eq__(self, x):
        return self.__integer == x.__integer

    #Overload !=
    def __ne__(self, x):
        return self.__integer != x.__integer

    

    
    
        
        

        

    
            
       
       
        
    
        
        
        
    
