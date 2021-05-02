//
// Created by dariu on 10/10/2018.
//
#include <iostream>
#include <string>
//I referenced http://cs.stmarys.ca/~porter/csc//ref/stl/cont_deque.html to see what methods deque consisted of.
#include <deque>
#ifndef GRASSHOPPER_GRASSHOPPER_H
#define GRASSHOPPER_GRASSHOPPER_H

using namespace std;

class Grasshopper {

private:
    //Initialization of Grasshopper's attributes
    int kind;
    string kindHopper;
    int size;
    int item;
    string kindFood;
    deque <int> stomach;

public:
    //Creates a grasshopper of kind hopper
    Grasshopper()
    {
        if(kind == 2)
        {
            kindHopper = "hopper";
            size = 5;
            deque <int> stomach(size);
        }

    }

    //Creates a grasshopper of the kind specified
    Grasshopper(int k)
    {
        kind = k;

        switch(k)
        {
            case 1:
            {
                kindHopper = "cricket";
                size = 3;
                deque <int> stomach(size);
                break;
            }
            case 2:
            {
                kindHopper = "hopper";
                size = 5;
                deque <int> stomach(size);
                break;
            }
            case 3:
            {
                kindHopper = "locust";
                size = 9;
                deque <int> stomach(size);
                break;
            }
            default:
            {
                cout << "Invalid type of grasshopper" << endl;
                break;
            }
        }

    }

    //Creates a new digital grasshopper of the <kind> indicated that will delete the previous grasshopper and warn the user to commit before continuing
    int Train()
    {
        string confirmation;
        cout << endl;
        cout << "Warning you are about to delete the previous hopper, do you wish to continue?" << endl;
        cout << "If you are certain that you wish to delete the previous hopper, type YES." << endl;
        cin >> confirmation;

        if(confirmation == "YES")
        {
            Reset();
            cout << "Please enter a 1 for Cricket, a 2 for Hopper, or a 3 for Locust: " << endl;
            cin >> kind;
        }
        else
        {
            while(confirmation != "YES")
            {
                cout << "Invalid input. Please enter specified input" << endl;
                cin >> confirmation;
                if(confirmation == "YES")
                {
                    Reset();
                    cout << "Please enter a 1 for Cricket, a 2 for Hopper, or a 3 for Locust: " << endl;
                    cin >> kind;
                }
            }
        }

        switch(kind)
        {
            case 1:
            {
                kindHopper = "cricket";
                size = 3;
                deque <int> stomach(size);
                break;
            }
            case 2:
            {
                kindHopper = "hopper";
                size = 5;
                deque <int> stomach(size);
                break;
            }
            case 3:
            {
                kindHopper = "locust";
                size = 9;
                deque <int> stomach(size);
                break;
            }
            default:
            {
                cout << "Invalid type of grasshopper entered, so Train() was not executed and kind is still what you originally specified. Please try again and enter specified kind only." << endl;
                break;
            }
        }

    }

    //Returns empty or full based off the contents of the stomach
    void Status()
    {
        if(stomach.empty())
        {
            cout << "grasshopper is HUNGRY" << endl;
        }
        else if(stomach.size() == size)
        {
            cout << endl << "grasshopper is FULL" << endl;
        }
        else if(stomach.size() < size)
        {
            cout << endl << "grasshopper is not FULL, but still HUNGRY." << endl;
        }

    }

    //Performs the "eat" operation for the item specified and returns success or failure
    bool Eat(int i)
    {
        item = i;
        switch(i)
        {
            case 1:
            {
                kindFood = "grass";
                if(stomach.size() + 1 <= size)
                {
                    stomach.push_front(i);
                    cout << endl;
                    cout << "grass successfully eaten." << endl;
                }
                else
                {
                    cout << "Failure to eat grass." << endl;
                }
                break;
            }
            case 2:
            {
                kindFood = "seed";
                if(stomach.size() + 2 <= size)
                {
                    stomach.push_front(i);
                    stomach.push_front(i);
                    cout << endl;
                    cout << "seed successfully eaten." << endl;
                }
                else
                {
                    cout << "Failure to eat seed." << endl;
                }
                break;
            }
            case 3:
            {
                kindFood = "bug";
                if(stomach.size() + 3 <= size)
                {
                    stomach.push_front(i);
                    stomach.push_front(i);
                    stomach.push_front(i);
                    cout << endl;
                    cout << "bug successfully eaten." << endl;
                }
                else
                {
                    cout << "Failure to eat bug." << endl;
                }
                break;
            }
            default:
            {
                cout << "Invalid type of food item." << endl;
                break;
            }
        }

    }

    //Performs the "vomit" operation and returns the item removed or indicates failure
    int Vomit()
    {
        if(stomach.front() == 1 && stomach.size() > 0)
        {
            stomach.pop_front();
        }
        else if(stomach.front() == 2 && stomach.size() > 0)
        {
            stomach.pop_front();
            stomach.pop_front();
        }
        else if(stomach.front() == 3 && stomach.size() > 0)
        {
            stomach.pop_front();
            stomach.pop_front();
            stomach.pop_front();
        }
        else
        {
            cout << "There is nothing to vomit." << endl;
        }

    }

    //Performs the "excrete" operation and returns the item removed or indicates failure
    int Excrete()
    {
        if(stomach.back() == 1 && stomach.size() > 0)
        {
            stomach.pop_back();
        }
        else if(stomach.back() == 2 && stomach.size() > 0)
        {
            stomach.pop_back();
            stomach.pop_back();
        }
        else if(stomach.back() == 3 && stomach.size() > 0)
        {
            stomach.pop_back();
            stomach.pop_back();
            stomach.pop_back();
        }
        else
        {
            cout << "There is nothing to excrete." << endl;
        }

    }

    //Lists the contents the grasshopper's stomach and outputs HUNGRY if the stomach is empty or FULL if the stomach is full
    void Report()
    {
        for(int i = 0; i < stomach.size(); i++)
        {
            if(i > 0)
            {
                cout << ", ";
            }
            cout << stomach[i];
        }
        Status();

    }

    //Performs the "reset" operation
    void Reset()
    {
        stomach.clear();
    }


};


#endif //GRASSHOPPER_GRASSHOPPER_H
