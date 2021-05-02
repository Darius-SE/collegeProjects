//
// Created by darius on 9/11/2018.
//
#include <iostream>
#ifndef TEMPERATURE_TEMPERATURE_H
#define TEMPERATURE_TEMPERATURE_H

class temperature {
private:
    double degrees;

public:
    //Default constructor
    temperature();

    //Overloaded Constructor
    temperature(double);

    //Destructor
    ~temperature();

    //Accessor Functions
    double getDegreesCelsius() const;

    double getDegreesFahrenheit() const;

    //Mutator Functions
    void setTempFahrenheit(double f);

    void setTempCelsius(double c);

};




#endif //TEMPERATURE_TEMPERATURE_H
