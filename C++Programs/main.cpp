/*
  Student Name: Darius Sandford
  Student NetID: ds2309
  Compiler Used: CLion
  Program Description:
  The purpose of this program is model the daily flow of patients through an emergency room. The system must be able to
  store the patient's name and complaint and then be able to prioritize their access based on the severity of their
  complaint and the order they entered the ER.
 */
#include <iostream>
#include <string>
#include "ER_queue.h"

using namespace std;
ER_queue queue;

//Prompts the user for the patient's name, complaint, priority, and calls queue.insert()
void Add(ER_queue)
{
    string Name = "";
    string Complaint = "";
    int Priority;

    cout << "Please enter the patient's name: " << endl;
    cin.ignore();
    getline(cin, Name);
    cout << "Please enter the patient's complaint: " << endl;
    getline(cin, Complaint);
    cout << "The levels and priorities of the patients' conditions are Code(5), Critical(4), Urgent(3), Non-urgent(2), and Ambulatory(1)." << endl;
    cout << endl;

    //Prompts the user to enter Priority until they enter a valid Priority.
    do{
        cout << "Enter the patient's priority: " << endl;
        cin >> Priority;
    }while(Priority < 1 || Priority > 5);

    queue.insert(Name, Complaint, Priority);

}

//Displays the next patient to be seen and updates the priority queue accordingly
void Next(ER_queue)
{
    patient * p2 = queue.Peek();
    cout << "The next patient to be seen is: " << p2 -> Name << endl;
    cout << "The patient's complaint is: " << p2 -> Complaint << endl;
    cout << "The patient's priority is: " << p2 -> Priority << endl;

    queue.Remove();
}

//Switches to Run Mode if in Build Mode
void Run(ER_queue)
{
    queue.Set_Mode(true);
}

//Switches to Build Mode if in Run Mode
void Build(ER_queue)
{
    queue.Set_Mode(false);
}

int main() {

    // Enters a command loop
    while (true) {
        /*
          Gives the user their command options based on the mode.
          Build Mode supports the following commands:
          Add(prompts the user for the patient's name, complaint, priority, and calls queue.insert())
          Run(switches to Run Mode)
          Exit(terminates the program)
         */
        if(!queue.Get_Mode())
        {
            cout << "You are currently in Build mode." << endl;
            cout << endl;
            cout << "Build mode supports the following commands: Add, Run, and Exit." << endl;
            cout << endl;
            cout << "Would you like to Add(1), switch to Run(2), or Exit the program(3)?" << endl;
            int answer;
            cin >> answer;

            switch(answer)
            {
                case 1:
                {
                    Add(queue);
                    break;
                }
                case 2:
                {
                    Run(queue);
                    break;
                }
                case 3:
                {
                    return 0;
                }
                default:
                {
                    cout << "Invalid type of command entered." << endl;
                    cout << endl;
                    break;
                }
            }
        }

        /*
          Gives the user their command options based on the mode.
          Run Mode supports the following commands:
          Add(prompts the user for the patient's name, complaint, priority, and calls queue.insert())
          Next(displays the next patient to be seen in the ER queue and updates the priority queue)
          Peek(displays the next patient to be seen without altering the priority queue)
          Build(switches to Build Mode)
          Exit(terminates the program)
         */
        else
        {
            queue.Get_Mode();
            queue.Build_Heap();
            cout << "You are currently in Run Mode." << endl;
            cout << endl;
            cout << "Run mode supports the following commands: Add, Next, Peek, Build, and Exit." << endl;
            cout << endl;
            cout << "Would you like to Add(1), Next(2), Peek(3), switch to Build(4), or Exit the program(5)?" << endl;
            int answer;
            cin >> answer;

            switch(answer)
            {
                case 1:
                {
                    Add(queue);
                    break;
                }
                case 2:
                {
                    Next(queue);
                    break;
                }
                case 3:
                {
                    patient *p = queue.Peek();
                    cout << "The next patient to be seen is: " << p -> Name << endl;
                    cout << "The patient's complaint is: " << p -> Complaint << endl;
                    cout << "The patient's priority is: " << p -> Priority << endl;
                    break;
                }
                case 4:
                {
                    Build(queue);
                    break;
                }
                case 5:
                {
                    return 0;
                }
                default:
                {
                    cout << "Invalid type of command entered" << endl;
                    cout << endl;
                    break;
                }
            }
        }
    }


    return 0;
}