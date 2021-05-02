from hexadecimal import Hexadecimal

def main():
    grade = 0
    #Constructor worth 25 points
    grade += test_constructor()

    #Overloaded str() worth 10 points
    grade += test_str()

    #Overloaded math operators (+, -, *, /, **, %) worth 20 points
    grade += test_math_ops()

    #Overloaded relational operators (>, <, <=, >=, ==, !=) worth 20 points
    grade += test_relational_ops()

    #Overloaded combination operators (+=, -=, *=, /=, **=, %=) worth 20 points
    grade += test_combo_ops()

    #Overloaded casting (int(), float()) worth 5 points
    grade += test_overloaded_casting()

    print(grade)

    return


#If there are no problems with the constructor, this function should return 20
def test_constructor():
    grade = 0
    #These should work
    try:
        a = Hexadecimal()
    except Exception as ex:
        print("Constructor doesn't have default arguments.")
    else:
        grade += 2

    try:
        b = Hexadecimal(10)
    except Exception as ex:
        print("Constructor doesn't accept positive ints.")
    else:
        grade += 2

    try:
        c = Hexadecimal(10.1)
    except Exception as ex:
        print("Constructor doesn't accept positive floats.")
    else:
        grade += 2

    try:
        d = Hexadecimal('10')
    except Exception as ex:
        print("Constructor doesn't accept string version of ints")
    else:
        grade += 2.5

    
    #These shouldn't work
    try:
        e = Hexadecimal([1, 2, 3])
    except Exception as ex:
        grade += 1
    else:
        print("Constructor shouldn't accept lists")
        
    try:
        e = Hexadecimal('Q')
    except Exception as ex:
        grade += 1
    else:
        print("Constructor shouldn't accept a 'Q'")

    try:
        f = Hexadecimal(-1)
    except Exception as ex:
        grade += 1
    else:
        print("Constructor shouldn't accept negative integers.")

    try:
        g = Hexadecimal(-20.1)
    except Exception as ex:
        grade += 1
    else:
        print("Constructor shouldn't accept negative floats.")
        
    #Decided that constructor should be worth 20 points, so multiplied by 2
    grade *= 2
    return grade

#If there are no problems with __str__, this function should return 10
def test_str():
    #As long as there is a constructor and an overloaded str() function,
    #the try block shouldn't be necessary, but I included it, just in case.
    grade = 0
    try:
        x = Hexadecimal('AF')
        if str(x) == "AF":
            grade += 5
        else:
            print("Overloaded str:", str(x), 'should be AF.')
            print("Check the overloaded str(), but also could be in constructor.")
        x = Hexadecimal('0')
        if str(x) == "0":
            grade += 5
        else:
            print("Overloaded str:", str(x), 'should be 0.')
    except Exception as ex:
        print("Crashed when testing str().")
        
    return grade

#If there are no problems, should return 20
def test_math_ops():
    grade = 0
    try:
        two = Hexadecimal(2)
        ten = Hexadecimal(10)
        zero = Hexadecimal(0)
        five = Hexadecimal(5)
        fifteen = Hexadecimal(15)
        fifty = Hexadecimal(50)

        #Add
        try:
            total = ten + zero
            if str(total) == str(ten):
                grade += 3
            else:
                print("Overloaded + not working correctly.")
            total = ten + five
            if str(total) == str(fifteen):
                grade += 2
            else:
                print("Overloaded + not working correctly.")
        except Exception as ex:
            print("Crashed when trying to add Hexadecimal objects.")

        #Subtract
        try:
            difference = fifteen - five
            if str(difference) == str(ten):
                grade += 3
            else:
                print("Overloaded - not working correctly.")
        except Exception as ex:
            print("Crashed when trying to subtract Hexadecimal objects.")
        try:
            difference = ten - fifteen
        except Exception as ex:
            grade += 2
        else:
            print("Your class stored a negative in an object as the result of subtracting.")
            print("It should have raised an exception and didn't.")

        #Multiply
        try:
            product = five * ten
            if str(product) == str(fifty):
                grade += 2
            else:
                print("Overloaded * not working correctly.")
            product = five * zero
            if str(product) == str(zero):
                grade += 1
            else:
                print("Overloaded * not working correctly.")
        except Exception as ex:
            print("Crashed when trying to multiply Hexadecimal objects.")

        #Divide
        try:
            quotient = fifty / five
            if str(quotient) == str(ten):
                grade += 2
            else:
                print("Overloaded / not working correctly.")
        except Exception as ex:
            print("Crashed when trying to divide Hexadecimal objects.")
        try:
            quotient = fifty / zero
        except Exception as ex:
            grade += 1
        else:
            print("Should have raised an exception when trying to divide by zero.")

        #Power
        try:
            answer = five ** two
            if str(answer) == str(Hexadecimal(25)):
                grade += 2
            else:
                print("Overloaded ** not working correctly.")
        except Exception as ex:
            print("Crashed when trying to raise a hexadecimal to a power")

        #Mod
        try:
            answer = ten % five
            if str(answer) == str(zero):
                grade += 1
            else:
                print("Overloaded % not working correctly.")
        except Exception as ex:
            print("Crashed when trying to calculate remainder.")
        try:
            answer = ten % zero
        except Exception as ex:
            grade += 1
        else:
            print("Should have raised an exception when trying to divide by zero -- which is used with % operations.")
            

    except Exception as ex:
        print("Crashed when testing math operations.")

    return grade

#If all relational operators work correctly, returns 20
def test_relational_ops():
    grade = 0

    try:
        one = Hexadecimal(1)
        two = Hexadecimal(2)

        #Testing <
        try:
            if one < two:
                grade += 2
            else:
                print("Trouble with <")
            if two < one:
                print("Trouble with <")
            else:
                grade += 1
        except Exception as ex:
            print("Crashed when testing <")

        #Testing <=
        try:
            if one <= two:
                grade += 2
            else:
                print("Trouble with <=")
            if one <= one:
                grade += 1
            else:
                print("Trouble with <=")
            if two <= one:
                print("Trouble with <=")
            else:
                grade += 1
        except Exception as ex:
            print("Crashed when testing <=")

        #Testing >
        try:
            if one > two:
                print("Trouble with >")
            else:
                grade += 2
            if two > one:
                grade += 1
            else:
                print("Trouble with >")
        except Exception as ex:
            print("Crashed when testing >")

        #Testing >=
        try:
            if two >= one:
                grade += 2
            else:
                print("Trouble with >=")
            if two >= two:
                grade += 1
            else:
                print("Trouble with >=")
            if one >= two:
                print("Trouble with >=")
            else:
                grade += 1
        except Exception as ex:
            print("Crashed when testing >=")

        #Testing ==
        try:
            if one == one:
                grade += 2
            else:
                print("Trouble with ==")
            if one == two:
                print("Trouble with ==")
            else:
                grade += 1
        except Exception as ex:
            print("Crashed when testing ==")

        #Testing !=
        try:
            if one != two:
                grade += 2
            else:
                print("Trouble with !=")
            if one != one:
                print("Trouble with !=")
            else:
                grade += 1
        except Exception as ex:
            print("Crashed when testing !=")
    except Exception as ex:
        print("Crashed when testing Relational operators")

    return grade

#If there are no problems, function returns 20
def test_combo_ops():
    grade = 0

    try:
        one = Hexadecimal(1)
        two = Hexadecimal(2)
        three = Hexadecimal(3)
        four = Hexadecimal(4)

        #Testing +=
        try:
            one += two
            if str(one) == str(three):
                grade += 3
            else:
                print("Trouble with +=")
            #resetting one
            one = Hexadecimal(1)
        except Exception as ex:
            print("Crashed when testing +=")

        #Testing -=
        try:
            one -= two
        except Exception as ex:
            grade += 1
        else:
            print("Your class stored a negative in an object as the result of -=.")
            print("It should have raised an exception and didn't.")

        one = Hexadecimal(1)
        try:
            two -= one
            if str(two) == str(one):
                grade += 3
            else:
                print("Trouble when testing -=")
                print(two, one)
            two = Hexadecimal(2)
        except Exception as ex:
            print("Crashed when testing -=")

        #Testing *=
        try:
            two *= two
            if str(two) == str(four):
                grade += 3
            else:
                print("Trouble when testing *=")
            two = Hexadecimal(2)
        except Exception as ex:
            print("Crashed when testing *=")

        #Testing /=
        try:
            four /= two
            if str(four) == str(two):
                grade += 3
            else:
                print("Trouble when testing /=")
            four = Hexadecimal(4)
        except Exception as ex:
            print("Crashed when testing /=")

        try:
            zero = Hexadecimal(0)
            four /= zero
        except ZeroDivisionError as ex:
            grade += 1
        else:
            print("Division by 0 is undefined, you should have raised an exception.")
          

        #Testing **=
        try:
            two **= two
            if str(four) == str(two):
                grade += 3
            else:
                print("Trouble when testing **=")
            two = Hexadecimal(2)
        except Exception as ex:
            print("Crashed when testing **=")

        #Testing %=
        try:
            four %= three
            if str(four) == str(one):
                grade += 2
            else:
                print("Trouble when testing %=")
            four = Hexadecimal(4)
        except Exception as ex:
            print("Crashed when testing %=")
        try:
            four %= zero
        except Exception as ex:
            grade += 1
        else:
            print("Your class should have caused a crash when trying to % by 0, but didn't.")
        four = Hexadecimal(4)
        
    except Exception as ex:
        print("Crashed when testing combination operators")

    return grade

#When there are no problems, the function returns 5
def test_overloaded_casting():
    grade = 0
    try:
        ten = Hexadecimal(10)

        x = int(ten)
        if type(x) is int and x == 10:
            grade += 3
        else:
            print("Can't cast Hexadecimal objects as ints correctly.")
    except Exception as ex:
        print("Crashed when casting Hexadecimal objects as ints.")

    try:
        ten = Hexadecimal(10)

        x = float(ten)
        if type(x) is float and x == 10.0:
            grade += 2
        else:
            print("Can't cast Hexadecimal objects as floats correctly.")
    except Exception as ex:
        print("Crashed when casting Hexadecimal object as ints.")

    return grade


main()
        
    
