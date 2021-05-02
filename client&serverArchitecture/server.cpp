// Darius Sandford 902249118
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
#include <time.h>
#include <string.h>
#include <string>
#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>

using namespace std;

int main(int argc, char *argv[])
{
  int portNum = atoi(argv[1]);
  // Create Socket
  int listening = socket(AF_INET, SOCK_STREAM, 0);
  if(listening == -1)
    {
      cerr << "Can't create a socket!" << endl;
      return -1;
    }

  // Bind the socket to a IP/port
  sockaddr_in server;
  server.sin_family = AF_INET;
  server.sin_port = htons(portNum);
  inet_pton(AF_INET, "0.0.0.0", &server.sin_addr);

  if(bind(listening, (sockaddr*)&server, sizeof(server)) == -1)
    {
      cerr << "Can't bind to IP/port" << endl;
      return -2;
    }

  // Mark the socket for listening
  if(listen(listening, SOMAXCONN) == -1)
    {
      cerr << "Can't listen" << endl;
      return -3;
    }

  // Accept a call
  sockaddr_in client;
  socklen_t clientSize = sizeof(client);
  char host[NI_MAXHOST];
  char randP[NI_MAXSERV];

  int clientSocket = accept(listening, (sockaddr*)&client, &clientSize);

  if(clientSocket == -1)
    {
      cerr << "Problem with client connecting!" << endl;
      return -4;
    }

  // Close listening socket
  close(listening);

  memset(host, 0, NI_MAXHOST);
  memset(randP, 0, NI_MAXSERV);

  int result = getnameinfo((sockaddr*)&client, sizeof(client), host, NI_MAXHOST, randP, NI_MAXSERV, 0);

  srand(time(NULL));
  int randPort = (rand() % 64511) + 1024;
  snprintf(randP, sizeof(randP), "%d", randPort);

  if(result)
    {
      cout << "Handshake detected. Selected the random port" << randP << endl;
    }else{
    inet_ntop(AF_INET, &client.sin_addr, host, NI_MAXHOST);
    cout << "Handshake detected. Selected the random port " << randP << endl;
  }
 
  // When received, display message
  char buf[4096];
 
  // Clear the buffer
  memset(buf, 0, 4096);
  
  // Wait for a message
  int bytesRecv = recv(clientSocket, buf, 4096, 0);
  if(bytesRecv == -1)
    {
      cerr << "There was a connection issue" << endl;
    }
      
  if(bytesRecv == 0)
    {
      cout << "The client disconnected" << endl;
    }


  socklen_t clen = sizeof(client);
  char ackTCP[] = "\nHandshake confirmed!\n";
  
  // Send random port
  send(clientSocket, randP, sizeof(randP), 0);
 
  // Close Socket
  close(clientSocket);
   
  int mysocket = 0;
  int i = 0;
  char payload[10];

  // Create UDP socket
  if((mysocket = socket(AF_INET, SOCK_DGRAM, 0)) == -1)
    {
      cout << "Error in socket creation." << endl;
    }

  // Bind the socket
  memset((char *) &server, 0, sizeof(server));
  server.sin_family = AF_INET;
  server.sin_port = htons(randPort);
  server.sin_addr.s_addr = htonl(INADDR_ANY);
  if(bind(mysocket, (struct sockaddr *)&server, sizeof(server)) == -1)
    {
      cout << "Error in binding." << endl;
    }

  // Server receives file data from client and writes it to the file (dataReceived.txt)
  FILE*h;
  int k = 0;
  int l = 0;
  char num2[8];
  h = fopen("dataReceived.txt","w");
  while(l < 14)
    {
      memset(payload, 0, 10);
      recvfrom(mysocket, payload, sizeof(payload), 0, (struct sockaddr *)&client, &clen);
      while(k <= 4)
	{
	  num2[k] = toupper(payload[k]);
	  k++;
	}
      k = 0;
      sendto(mysocket, num2, sizeof(num2), 0, (struct sockaddr *)&client, clen);
      memset(num2, 0, 8);
      fprintf(h, "%s \n", payload);
      l++;
      }

  // Close socket
  close(mysocket);
  return 0;
}
