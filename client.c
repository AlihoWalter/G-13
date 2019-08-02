
 

#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>

 

int main()

{

 while(1){
 
//int start=system("server.exe");
    WSADATA wsaData;

    int iResult = WSAStartup(MAKEWORD(2,2), &wsaData);

    if (iResult != NO_ERROR)

              printf("Client: Error at WSAStartup().\n");

    else

              printf("");

 

    

    SOCKET m_socket;

    m_socket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);

 

    if (m_socket == INVALID_SOCKET)

    {

        printf("Client: socket() - Error at socket(): %ld\n", WSAGetLastError());

        WSACleanup();

        return 0;

    }

   else

       printf("");

 

    
    struct sockaddr_in clientService;

 

    clientService.sin_family = AF_INET;

    

    clientService.sin_addr.s_addr = inet_addr("127.0.0.1");

    clientService.sin_port = htons(55555);

 

    if (connect(m_socket, (SOCKADDR*)&clientService, sizeof(clientService)) == SOCKET_ERROR)

    {

        printf("Client: connect() - Failed to connect.\n");

        WSACleanup();

        return 0;

    }

    else

    {

       printf("");

       printf("");

    }

 

    

    int bytesSent;

    int bytesRecv = SOCKET_ERROR;

   char txt[200]="";
   int bytesTxt;
     char response[200]="";
     int bytesResponse;
    char sendbuf[200];
    char district[200];
    int bytesDistrict;
    char recvbuf[200] = "";
    char read[2]="";
    char commas[2]="";
    int bytesRead;
    int bytesSend;
    char command[5];
    int bytesCommand;
    char id[20]="";
    int bytesId;
   ;



       while(bytesRecv == SOCKET_ERROR)

       {

           bytesRecv = recv(m_socket, recvbuf, 200, 0);
          
        if (bytesRecv == 0 || bytesRecv == WSAECONNRESET)

        {

             printf("Client: Connection Closed.\n");

            break;

        }

 

        if (bytesRecv < 0)

            return 0;

       else

       {

              printf("");

              printf("");
             
         printf(" \n\n********************************************************************************\n");
          printf("                 WELCOME TO THE UNITED FRONT FOR TRANSFORMATION\n ");
           printf("        ***************************************************************\n");
            printf("          Please type the commands as indicates below;\n ");
             printf("########################################################################## \n\n");
              printf("             1. Addmember firstname lastname,2019/03/12,male,kampala_3271\n");
               printf("            2. check_status\n\n");
            

       }

    }
 printf("Server: Please enter your district \n");
 printf("Client: ");
 scanf("%s",district);
 
  bytesDistrict = send(m_socket, district, strlen(district), 0);
       
       
        printf("Server: Please enter your district identity \n");
 printf("Client: ");
 scanf("%s",txt);
 
  bytesTxt = send(m_socket, txt, strlen(txt), 0);
       
 printf("Server: Please enter your command");
printf("\nClient: ");
while((getchar())!='\n');
     // scanf("%m[^\n]s",sendbuf);
     gets(sendbuf);
    
       bytesSent = send(m_socket, sendbuf, strlen(sendbuf), 0);
       bytesCommand = recv(m_socket, command, 200, 0);
    //   printf("%s",command);
       

       if(bytesSent == SOCKET_ERROR)

              printf("Client: send() error %ld.\n", WSAGetLastError());

       else

       {
       	

             // printf("Client: send() is OK - Bytes sent: %ld\n", bytesSent);
             if(strcmp(command,"add")==0){
			
char command[200]="The server is now on standby";
              printf("Client: The command sent is: \"%s\"\n", sendbuf);
              bytesResponse = recv(m_socket, response, 200, 0);
              printf("Server: %s\n",response);
              bytesRead = recv(m_socket, read, 2, 0);
              if(strcmp(read,"n")==0){
              	printf("Client: Press y to sign or n to exit \n");
              	printf("Client: ");
              	scanf("%s",read);
              	bytesRead = send(m_socket,read , 2, 0);
			  
			  }
			        
              int i,j;
    int A[5][3];

  int bytesSign;
 if(strcmp(read,"y")==0){ 
  printf("Server: Please enter your id \n");
  printf("Client: ");
  scanf("%s",id);
  printf("Server: Please enter your signature\n");
  bytesId = send(m_socket,id , 20, 0);
    for(i=0;i<5;i++){
        for(j=0;j<3;j++)
        {
        	printf("Client: ");
            scanf("%d", &A[i][j]);
            char sign[200]="";
            itoa(A[i][j],sign,2);
			bytesSign = send(m_socket,sign , 30, 0);    // *(j+*(A+i))
             
        }//end of inner for loop
        printf("%s","\n");
    }
	printf("Server: This is your sign\n===============================================================================\n");
	for(i=0;i<5;i++){
        for(j=0;j<3;j++)
        {
           
            
            if(A[i][j] == 0)
            {
                printf("%s"," ");
            }
            if(A[i][j] == 1)
            {
                printf("%s ","*");
            }
             
        }
        printf("%s","\n");
    }
}
}

if(strcmp(command,"get")==0){
	char command[200]="The server is now on standby";
	char status[200]="";
	int bytesStatus;
	
bytesStatus = recv(m_socket, status, 200, 0);
printf("yes");
printf("Server: %s",status);	
	

}




else{
	//bytesResponse = recv(m_socket, response, 200, 0);
              printf("Server: %s\n",command);
	
}
}





    WSACleanup();

}

}
