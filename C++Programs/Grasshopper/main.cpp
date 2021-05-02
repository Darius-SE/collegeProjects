/*
  Student Name: Darius Sandford
  Student NetID: ds2309
  Compiler Used: CLion
  Program Description:
  This program should allow a user to issue a series of instructions to a digital grasshopper and report on the
  grasshopper's responses and status
 */
#include <iostream>
#include <string>
#include "Grasshopper.h"

using namespace std;

//Terminates the program
int Exit()
{
    return 0;
}

int main() {
    cout << "When creating an object of the class to create specified kind of hopper, pass in a 1 for a Cricket(stomach capacity of 3), a 2 for a Hopper(stomach capacity of 5), and a 3 for a Locust(stomach capacity of 9)." << endl;
    cout << endl;
    cout << "This program allows you to enter a series of commands to a digital grasshopper." << endl;
    cout << endl;
    cout << "These commands are: Train(), Eat(), Status(), Report(), Reset(), Vomit(), Excrete(), Exit()." << endl;
    cout << endl;
    cout << "The food items they can eat are Grass(pass in 1 to Eat()), Seeds(pass in 2 to Eat()), and Bugs(pass in 3 to Eat())." << endl;
    cout << endl;
    cout << "Grass takes occupies 1 unit of space, Seeds occupy 2 units of space, Bugs occupy 3 units of space." << endl;
    cout << endl;
    cout << "This program will let you know if your grasshopper is hungry or full." << endl;
    cout << endl;
    cout << "Have fun filling and emptying your grasshopper's stomach, they can be really fussy eaters!" << endl;

    Grasshopper Jiminy(1);
    Jiminy.Eat(2);
    Jiminy.Eat(3);
    Jiminy.Report();
    Jiminy.Vomit();
    Jiminy.Report();
    Jiminy.Vomit();
    Jiminy.Train();
    Jiminy.Eat(3);
    Jiminy.Eat(3);
    Jiminy.Eat(3);
    Jiminy.Report();

    Grasshopper theHopper(2);
    theHopper.Eat(3);
    theHopper.Eat(2);
    theHopper.Report();
    theHopper.Reset();
    theHopper.Report();

    Grasshopper bigBadLocust(3);
    bigBadLocust.Eat(3);
    bigBadLocust.Eat(3);
    bigBadLocust.Eat(2);
    bigBadLocust.Eat(1);
    bigBadLocust.Report();
    bigBadLocust.Excrete();
    bigBadLocust.Report();
    bigBadLocust.Excrete();
    bigBadLocust.Report();
    bigBadLocust.Excrete();
    bigBadLocust.Report();
    bigBadLocust.Excrete();
    bigBadLocust.Report();
    bigBadLocust.Excrete();
    bigBadLocust.Report();

    Exit();
}