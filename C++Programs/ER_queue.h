//
// Created by dariu on 11/12/2018.
//
#include <iostream>
#include <string>
#include <vector>

#ifndef ER_QUEUE_ER_QUEUE_H
#define ER_QUEUE_ER_QUEUE_H

using namespace std;

class patient{

public:

    //Attributes
    string Name = "";
    string Complaint = "";
    int Priority = 0;
    int Ticket = 0;

    //Empty constructor that creates a basic patient with an ambulatory level complaint and a ticket of -1
    patient()
    {
        Name = "Amber";
        Complaint = "Headache";
        Priority = 1;
        Ticket = -1;
    }

    //Constructor that creates a patient with name, complaint, priority, and ticket set to the specified values
    patient(string n, string c, int p, int t)
    {
        Name = n;
        Complaint = c;
        Priority = p;
        Ticket  = t;
    }
};


class ER_queue {

private:

    //Attributes
    vector<patient *> heap;
    bool mode{};
    int next_ticket = 0;

public:

    // Empty constructor that creates an empty priority queue in Build mode
    ER_queue()
    {
        Set_Mode(false);
        next_ticket = 1;
    }

    /*
      Creates a patient with attributes Name, Complaint, Priority, and inserts them into the vector heap.
      This method will adjust the priority queue if ER_queue is in Run Mode.
     */
    bool insert(string newPatient, string newComplaint, int newPriority)
    {
        patient * p = new patient(newPatient, newComplaint, newPriority, next_ticket);
        next_ticket++;
        heap.push_back(p);

        if(mode)
        {
            bubbleUp();
        }
    }

    //Returns the contents of the heap's root without altering them.
    patient * Peek()
    {
        return heap[0];
    }

    //When the ER_queue is in Run mode, removes the top most value in the priority queue and returns it.
    patient * Remove()
    {
        patient * temp = heap[0];
        swap(0,heap.size() - 1);
        heap.pop_back();

        heapify(0);

        return temp;

    }

    //Turns the contents of the vector heap into a proper heap; sets mode to true
    void Build_Heap()
    {
        Set_Mode(true);
        for(int index = heap.size()/2; index >= 0; index--)
        {
            heapify(index);
        }

    }

    //Sets the mode of the ER_queue. True = Run Mode; False= Build Mode.
    void Set_Mode(bool m)
    {
        mode = m;
    }

    //Returns the mode of the ER_queue.
    bool Get_Mode()
    {
        return mode;
    }

    /*
      Checks to see if the specified node has a child and then compares the priority and ticket to see which is greater
      and sets the maxIndex to the one that is of greater value. Thus, restoring the heap property.
     */
    void heapify(int index)
    {
        int left = 2*index + 1;
        int right = left + 1;

        if(left >= heap.size())
        {
            return;
        }

        int maxIndex = index;
        if(heap[left] -> Priority > heap[index] -> Priority)
        {
            maxIndex = left;
        }

        else if((heap[left] -> Priority == heap[index] -> Priority) && (heap[left] -> Ticket < heap[index] -> Ticket))
        {
            maxIndex = index;
        }

        if((right < heap.size()) && (heap[right] -> Priority > heap[maxIndex] -> Priority))
        {
            maxIndex = right;
        }

        else if((right < heap.size()) && (heap[right] -> Priority == heap[index] -> Priority) && (heap[right] -> Ticket < heap[index] -> Ticket))
        {
            maxIndex = index;
        }

        if(maxIndex != index)
        {
            swap(index, maxIndex);
            heapify(maxIndex);
        }
    }

    //Compares the Priority and Ticket of the childNode and parentNode, then swaps them accordingly based off which one is greater.
    void bubbleUp()
    {
        int childNode = heap.size() - 1;
        while(childNode > 0)
        {
           int parentNode = (childNode - 1) / 2;
           if(heap[childNode] -> Priority > heap[parentNode] -> Priority)
           {
               swap(parentNode,childNode);
               childNode = parentNode;
           }
           else if((heap[childNode] -> Priority == heap[parentNode] -> Priority) && (heap[childNode] -> Ticket < heap[parentNode] -> Ticket))
           {
               swap(parentNode, childNode);
               childNode = parentNode;
           }else
           {
               return;
           }
        }
    }

    //Swaps elements of the heap
    void swap(int a, int b)
    {
        patient *temp = heap[a];
        heap[a] = heap[b];
        heap[b] = temp;
    }

};


#endif //ER_QUEUE_ER_QUEUE_H
