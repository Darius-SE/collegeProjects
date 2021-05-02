'''
Name: Darius Sandford                              Date Assigned: 02-19-2018

Course: 1384 Sec 01                                Date Due: 03-02-2018

File Name: hexadecimal.py

Description: Create a hexadecimal numbers class named Hexadecimal with all the mathematical, relational, and combination operators overloaded.
'''
class Hexadecimal:
    #Creates constructor that makes sure values entered are non-negative and are int, float, or str.
    def __init__(self, x = 'A'):
        if type(x) is int:
            if x >= 0:
                self.__x = x
            else:
                raise ValueError ("Must be greater than or equal to 0.")
        elif type(x) is float:
            x = int(x)
            if x >= 0:
                self.__x = x
            else:
                raise ValueError ("Must be greater than or equal to 0.")
        elif type(x) is str:
            values = {'0': 0, '1': 1, '2': 2, '3': 3, '4': 4, '5': 5, '6': 6, '7': 7, '8': 8, '9': 9, 'A': 10, 'B': 11, 'C': 12, 'D': 13, 'E': 14, 'F': 15}
            x = x.upper()
            h_values = []
            for letter in x:
                if letter in values:
                    h_values.append(values[letter])
                else:
                    raise ValueError ("Invalid Hexadecimal number")
            self.__x = 0

        elif type(x) is list:
            raise ValueError ("Data type is invalid")

    #Overload str()
    def __str__(self):
        h_string = ""
        number = self.__x
        while number > 15:
            h_string += 'F'
            number -= 15
        if number >= 14:
            h_string += 'E'
            number -= 14
        if number >= 13:
            h_string += 'D'
            number -= 13
        while number >= 12:
            h_string += 'C'
            number -= 12
        if number >= 11:
            h_string += 'B'
            number -= 11
        if number >= 10:
            h_string += 'A'
            number -= 10
        while number >= 9:
            h_string += '9'
            number -= 9
        if number >= 8:
            h_string += '8'
            number -= 8
        if number >= 7:
            h_string += '7'
            number -= 7
        while number >= 6:
            h_string += '6'
            number -= 6
        if number >= 5:
            h_string += '5'
            number -= 5
        if number >= 4:
            h_string += '4'
            number -= 4
        while number >= 3:
            h_string += '3'
            number -= 3
        if number >= 2:
            h_string += '2'
            number -= 2
        if number >= 1:
            h_string += '1'
            number -= 1
        if number >= 0:
            h_string += 'AF'
            number -= 0
        return h_string
          
    #Overload +
    def __add__(self, x):
        total = Hexadecimal()
        total.__x = self.__x + x.__x
        return total

    #Overload -
    def __sub__(self, x):
        difference = Hexadecimal()
        difference.__x = self.__x - x.__x
        if difference.__x < 0:
            raise ValueError ("Subtraction resulted in an invalid Hexadecimal number.")
        return difference

    #Overload *
    def __mul__(self, x):
        product = Hexadecimal()
        product.__x = self.__x * x.__x
        return product

    #Overload //
    def __truediv__(self, x):
        quotient = Hexadecimal()
        quotient.__x = self.__x // x.__x
        if quotient.__x < 0:
            raise ValueError ("Division resulted in an invalid Hexadecimal number.")
        return quotient

    #Overload **
    def __pow__(self, x):
        power = Hexadecimal()
        power.__x = self.__x ** x.__x
        return power

    #Overload %
    def __mod__(self, x):
        remainder = Hexadecimal()
        remainder.__x = self.__x % x.__x
        if remainder.__x < 0:
            raise ValueError ("Remainder resulted in an invalid Hexadecimal number.")
        return remainder

    #Overload <
    def __lt__(self, x):
        return self.__x < x.__x

    #Overload <=
    def __le__(self, x):
        return self.__x <= x.__x

    #Overload >
    def __gt__(self, x):
        return self.__x > x.__x

    #Overload >=
    def __ge__(self, x):
        return self.__x >= x.__x

    #Overload ==
    def __eq__(self, x):
        return self.__x == x.__x

    #Overload !=
    def __ne__(self, x):
        return self.__x != x.__x

    #Overload +=
    def __iadd__(self, x):
        self.__x += x.__x
        return self

    #Overload -=
    def __isub__(self, x):
        self.__x -= x.__x
        if self.__x < 0:
            raise ValueError ("-= resulted in an invalid Hexadecimal number.")
        return self

    #Overload *=
    def __imul__(self, x):
        self.__x *= x.__x
        return self

    #Overload //=
    def __itruediv__(self, x):
        self.__x //= x.__x
        if self.__x < 0:
            raise ValueError ("//= resulted in an invalid Hexadecimal number.")
        return self

    #Overload **=
    def __ipow__(self, x):
        self.__x **= x.__x
        return self

    #Overload %=
    def __imod__(self, x):
        self.__x %= x.__x
        if self.__x < 0:
            raise ValueError ("%= resulted in an invalid Hexadecimal number.")
        return self

    #Overload __int__()   
    def __int__(self):
        return self.__x

    #Overload __float__()
    def __float__(self):
        return float(self.__x)


