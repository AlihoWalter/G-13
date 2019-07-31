 

#include <stdio.h>
#include <stdlib.h>
#include <winsock2.h>

 

int main()

{
 while(1){
WORD wVersionRequested;

WSADATA wsaData;
char status[200];
int bytesStatus;
int counter;
int wsaerr;
int bytesSign;
char sign[50]="";
char id[20]="";
int bytesId;
int i;
int c=0;
int k,j;
    int A[5][3];



wVersionRequested = MAKEWORD(2, 2);

 

wsaerr = WSAStartup(wVersionRequested, &wsaData);

if (wsaerr != 0)

{

    

    printf("Server: The Winsock dll not found!\n");

    return 0;

}

else

{

       printf("Server: The Winsock dll found!\n");

       printf("Server: The status: %s.\n", wsaData.szSystemStatus);

}

 

                                        

if (LOBYTE(wsaData.wVersion) != 2 || HIBYTE(wsaData.wVersion) != 2 )

{

  

    printf("Server: The dll do not support the Winsock version %u.%u!\n", LOBYTE(wsaData.wVersion), HIBYTE(wsaData.wVersion));

    WSACleanup();

    return 0;

}

else

{

       printf("Server: The dll supports the Winsock version %u.%u!\n", LOBYTE(wsaData.wVersion), HIBYTE(wsaData.wVersion));

       printf("Server: The highest version this dll can support: %u.%u\n", LOBYTE(wsaData.wHighVersion), HIBYTE(wsaData.wHighVersion));

}

 


SOCKET m_socket;

 


m_socket = socket(AF_INET, SOCK_STREAM, IPPROTO_TCP);

 


if (m_socket == INVALID_SOCKET)

{

    printf("Server: Error at socket(): %ld\n", WSAGetLastError());

    WSACleanup();

    return 0;

}

else

{ printf("Server: socket() is OK!\n"); }

 

struct sockaddr_in service;

 



service.sin_family = AF_INET;



service.sin_addr.s_addr = inet_addr("127.0.0.1");


service.sin_port = htons(55555);

 

if (bind(m_socket, (SOCKADDR*)&service, sizeof(service)) == SOCKET_ERROR)

{

    printf("Server: bind() failed: %ld.\n", WSAGetLastError());

    closesocket(m_socket);

    return 0;

}

else

{

    printf("Server: bind() is OK!\n");

}



if (listen(m_socket, 10) == SOCKET_ERROR)

    printf("Server: listen(): Error listening on socket %ld.\n", WSAGetLastError());

else

{

   printf("Server: listen() is OK, I'm waiting for connections...\n");

}


SOCKET AcceptSocket;


printf("Server: Waiting for a client to connect...\n" );

printf("***Hint: Server is ready...run your client program...***\n");



while (1)

{

    AcceptSocket = SOCKET_ERROR;

    while (AcceptSocket == SOCKET_ERROR)

    {

        AcceptSocket = accept(m_socket, NULL, NULL);

    }

 

printf("Server: Client Connected!\n");

m_socket = AcceptSocket; 

break;

}

 

int bytesSent;

int bytesRecv = SOCKET_ERROR;

char sendbuf[200] = "Server is now accepting commnands";
char district[200]="";
int bytesDistrict;
char add[200]="Addmember,";
//char response[200];
char file[200]="";
char recvbuf[200] = "";
char commas[500]="";
char read[2];
int bytesRead;
int bytesCommas;
int bytesResponse;
int count;
 


	
	
	

//printf("Server: Sending some test data to client...\n");

bytesSent = send(m_socket, sendbuf, strlen(sendbuf), 0);

 

if (bytesSent == SOCKET_ERROR)

       printf("Server: send() error %ld.\n", WSAGetLastError());

else

{

       printf("Server: send() is OK.\n");

     //  printf("Server: Bytes Sent: %ld.\n", bytesSent);

}


bytesDistrict = recv(m_socket, district, 200, 0);
 
bytesRecv = recv(m_socket, recvbuf, 200, 0);
          

if (bytesRecv == SOCKET_ERROR)

       printf("Server: recv() error %ld.\n", WSAGetLastError());

else

{

       printf("Server: recv() is OK.\n");

       printf("Client: \"%s\"\n", recvbuf);

   //    printf("Server: Bytes received: %ld.\n", bytesRecv);
       for(i=0;i<strlen(recvbuf);i++){
       	//printf("%c\n",recvbuf[i]);
       	if((recvbuf[i])==','){
       	
       		c=c+1;		 
			     }
			  //	printf("%d",c);   
       	
}
//printf("%d",c);   
    if(strncmp(recvbuf,add,strlen(add))==0){
    	int bytesCommand;
    	char command[200]="add";
    	bytesCommand = send(m_socket, command, strlen(command), 0);
    	
	

	   if(c==4){
	   	strcpy(file,(recvbuf+10));
	   	strcat(district,",");
	   //	printf("%s",);
	   	printf("%s",district);
	   	
	   	
	   		FILE *pointer;
	   	pointer = fopen("data.txt", "r");
	   	while(!feof(pointer)){
	   	fscanf(pointer,"%c", commas);
	   	if(strcmp(commas,",")==0){
	   		count++;
		   }
	}	   
		   printf("%d",count);
	   	if(count>3)
	   	{
	
	   	
	   
	   	
	   	FILE *fptr;
	   	fptr = fopen("data.txt", "a");
	   	fprintf(fptr,"\n%s", district);
	   	fprintf(fptr,"%s", file);
	   	
       fclose(fptr);
	   
}

else{
	
	
	FILE *fptr;
	   	fptr = fopen("data.txt", "w");
	   	fprintf(fptr,"%s", district);
	   	fprintf(fptr,"%s", file);
	   	
       fclose(fptr);
	   
	
	
	
	
}
	   	
	   	char response[200]="Command executed succesfully";
	   	
	  bytesResponse = send(m_socket, response, strlen(response), 0); 
	  
	   	
	   //	printf("%s",commas);
	
	   	
	   
//       fclose(fpt);
//printf("%d",count);
char check[2]="n";


	bytesRead = send(m_socket, check, strlen(check), 0);
	
	

bytesRead = recv(m_socket, read, 2, 0);
            
if(strcmp(read,"y")==0 || strcmp(check,"y")==0){
	bytesId = recv(m_socket, id, 20, 0);
//	FILE *pinter;
//	   	pointer = fopen("sign.txt", "r");
//	   	while(!feof(pointer)){
//	   	fscanf(pointer,"%c", commas);
//	   	if(strcmp(commas,",")==0){
//	   		counter++;
//		   }
//	}	   
//		   printf("%d",&count);
//	   	if(count>0)
//	   	{
	
	
	
FILE *f;
	   	f = fopen("sign.txt", "a");
	   	fprintf(f,"%s", id);
	   	fprintf(f,"%s", ",");
	   	
	   	
       fclose(f);
        

for(k=0;k<16;k++){
        

			bytesSign = recv(m_socket,sign , 30, 0);    // *(j+*(A+i))
			printf("%s",sign);
       FILE *fp;
	   	fp = fopen("sign.txt", "a");
	   	fprintf(fp,"%s", sign);
	   	
       fclose(fp);
        
    }
//    FILE *fa;
//	   	fa = fopen("data.txt", "a");
//	   	fprintf(fa,"%s", "*,");
//	   	
//       fclose(fa);
	   }
}
	   else{
	   	 char response[200]="Missing fields";
	   	
	  bytesResponse = send(m_socket, response, strlen(response), 0); 	
	   	
	   }
}


if(strncmp(recvbuf,"get_status",9)==0){
int bytesCommand;
    	char command[200]="get";
    	bytesCommand = send(m_socket, command, strlen(command), 0);
FILE*location;
	location=fopen("status.txt","r");
	//char ride[200];
	while(!feof(location)){
	fgets(status,200,location);
	
	puts(status);
	
	}
	bytesStatus = send(m_socket, status, strlen(status), 0); 
	fclose(location);





}




else{
   
   int bytesAnswer;
   char answer[200]="Wrong command";
	   	
	  bytesAnswer = send(m_socket, answer, strlen(answer), 0); 
   
   	
}

       
}









WSACleanup();


}
}

 


