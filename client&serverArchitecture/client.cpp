//Darius Sandford 902249118
/*
  Sources used: Youtuber: Sloan Kelly, Stack Overflow
 */
#include <iostream>
#include <sys/types.h>
#include <unistd.h>
#include <sys/socket.h>
#include <netdb.h>
#include <arpa/inet.h>
#include <netinet/in.h>
#include <fstream>
#include <string.h>
#include <string>
#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>

using namespace std;

int main(int argc, char *argv[])
{
  int portNum = atoi(argv[2]);
  //create socket
  int mySocket = socket(AF_INET, SOCK_STREAM, 0);
  if(mySocket == -1)
    {
      return 1;
    }

  //Create a hint structure for the server being connected to
  string ipAddress = argv[1];

  sockaddr_in client;
  client.sin_family = AF_INET;
  client.sin_port = htons(portNum);
  inet_pton(AF_INET, ipAddress.c_str(), &client.sin_addr);

  //Connect to server on the socket
  int resultOfConnect = connect(mySocket, (sockaddr*)&client, sizeof(client));
  if(resultOfConnect == -1)
    {
      return 1;
    }

  //while loop
  char buf[4096];

     //Initialize message for handshake with the server
     string clientToServer = "2020";

     //Send to server
     int sendResult = send(mySocket,clientToServer.c_str(), clientToServer.size() + 1,  0);
     if(sendResult == -1)
       {
	 cout << "Could not send to server!" << endl;
       }

     //Receive random port number from server
     char rPort[10];
     memset(rPort, 0, 10);
     recv(mySocket, &rPort, 10, 0);
     int randPort2;
     randPort2 = atoi(rPort);

 
   //Close the socket
   close(mySocket);

   struct hostent *s;
   s = gethostbyname(argv[1]);
   
   sockaddr_in server;
   int mysocket = 0;
   socklen_t slen = sizeof(server);
   char payload[10];

   //Create UDP socket
   if((mysocket = socket(AF_INET, SOCK_DGRAM, 0)) == -1)
     {
       cout << "Error in socket creation." << endl;
     }
   
   // Bind the socket
   memset((char *) &server, 0, sizeof(server));
   server.sin_family = AF_INET;
   server.sin_port = htons(randPort2);
   bcopy((char *)s->h_addr,
      (char*)&server.sin_addr.s_addr,
      s->h_length);

   // Opens and sends the file to the server
   FILE* f;
   char c;
   f = fopen("file.txt", "r");
   if(f == NULL)
     {
       cout << "Error" << endl;
     }

   int i = 0;
   int j = 0;
   char num[8];
   int count = 0;
   while((c=getc(f)) != EOF)
     {
       payload[i] = c;
       i++;
       if(i == 4)
	 {
	   sendto(mysocket, payload, sizeof(payload), 0, (struct sockaddr*)&server, slen);
	   cout << payload << endl;
	   memset(payload, 0, 10);
	   recvfrom(mysocket, payload, sizeof(payload), 0, (struct sockaddr*)&server, &slen);
	   while(j <= 4)
	     {
	       num[j] = toupper(payload[j]);
	       j++;
	     }
	   j = 0;
	   memset(num, 0, 8);
	   memset(payload, 0, 10);
	   i = 0;
	 }
     }
   j = 0;
   if(feof(f))
     {
       sendto(mysocket, payload, sizeof(payload), 0, (struct sockaddr*)&server, slen);
       cout << payload << endl;
       memset(payload, 0, 10);
       memset(num, 0, 8);
       recvfrom(mysocket, payload, sizeof(payload), 0, (struct sockaddr*)&server, &slen);
       while(j <= 4)
	 {
	   num[j] = toupper(payload[j]);
	   j++;
	 }
       j = 0;
     }

   // Close socket
   close(mysocket);
   return 0;
}
