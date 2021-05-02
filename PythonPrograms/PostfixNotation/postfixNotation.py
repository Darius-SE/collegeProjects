'''
Name: Darius Sandford                                      Date Assigned: 03-26-2018

Course: 1384 Sec 01                                        Date Due: 04-02-2018

File Name: postfixNotation.py

Description: Create a Stack class as a fixed length stack that can hold a maximum of 10 values and a program that tests the Stack class.
'''
class Stack:

    #Creates the constructor
    def __init__(self, data = 0, length = 0):
        self.__data = [None] * 10
        self.__length = 0
    #Destroys data
    def destroy(self):
        self.__data = [None] * 10
        self.__length = 0
        return

    #Creates is_stack_empty
    def is_stack_empty(self):
        return self.__length == 0

    #Creates is_stack_full
    def is_stack_full(self):
        if self.__length == 10:
            return True
        else:
            return False

    #Creates push
    def push(self, item):
        if not self.is_stack_full():
            self.__data[self.__length] = item
            self.__length += 1
        else:
            raise ValueError("Stack is full!")    

    def pop(self):
        if not self.is_stack_empty():
            self.__length -= 1
            return_value = self.__data[self.__length]
            self.__data[self.__length] = None
            return return_value
        else:
            raise ValueError("Stack is empty!")
        
    def top(self):
        for index in range(self.__length):
            if self.__data[index] == None:
                return self.__data[index - 1]
        return self.__data[self.__length - 1]

    def __len__(self):
        return len(self.__data)

    def __str__(self):
        return str(self.__data)
    
def main():
    expression_file = input("Enter the name of the file containing postfix expressions: ")

    found = False

    while not found:
        try:
            exp_list = open(expression_file)
        except FileNotFoundError as ex:
            print(expression_file, "is not found.")
            expression_file = input("Please enter another file name: ")
        else:
            found = True
        
        for expressions in range(10):
            expressions = exp_list.readline()
            print(expressions)
        
    calculator = Stack()

    for each in exp_list:
        try:
            value = int(each)
        except Exception as ex:
            second = calculator.pop()
            first = calculator.pop()

            if each == "+":
                answer = first + second
                calculator.push(answer)
            if each == '-':
                answer = first - second
                calculator.push(answer)
            elif each == "*":
                answer = first * second
                calculator.push(answer)
            elif each == "/":
                answer = first / second
                calculator.push(answer)
        else:
            calculator.push(value)
    print("Expression: ")
    print("Answer: ", calculator.pop())

    return

main()
            
        
        
    

    
