/*
  Student Name: Darius Sandford
  Student NetID: ds2309
  Compiler Used: CLion
  Program Description:
        The purpose of this program is to implement the use of classes to convert degrees Fahrenheit to degrees .Celsius and vice versa
 */
#include <iostream>
#include "temperature.h"
#include <string>


using std::cout;
using std::cin;
using std::endl;
using std::string;

int main() {
    temperature temp;
    double userTemp = 0;
    string scale = "";
    cout <<"Please enter temperature scale as C or F: " << endl;
    cin >> scale;

    cout << " Please enter a temperature: " << endl;
    cin >> userTemp;

    if(scale == "F") {

        temp.setTempFahrenheit(userTemp);

        cout << "Temperature in degrees Celsius: " << temp.getDegreesCelsius() << endl;
    }

    if(scale == "C") {
        temp.setTempCelsius(userTemp);

        cout << "Temperature in degrees Fahrenheit is: " << temp.getDegreesFahrenheit() << endl;

        return 0;
    }


}