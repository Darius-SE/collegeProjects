//
// Created by darius on 9/11/2018.
//
#include <iostream>
#include "temperature.h"

temperature::temperature()
{
    degrees = 0;
}

temperature::temperature(double temp)
{
    degrees = temp;
}

temperature::~temperature()
{

}

void temperature::setTempFahrenheit( double f)
{
    degrees = 5.0*(f-32)/9;
}

void temperature::setTempCelsius( double c)
{
    degrees = c;
}

double temperature::getDegreesCelsius() const
{
    return degrees;
}

double temperature::getDegreesFahrenheit() const
{
    return 9*degrees/5 + 32;
}


