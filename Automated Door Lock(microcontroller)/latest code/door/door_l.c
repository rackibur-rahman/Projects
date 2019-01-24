// Password based Door lock 
// modifying userID and Password
#include<reg51.h>
sfr ROW=0x80;	//assigning PORT-0 to read rows
sfr COL=0xA0;	//assigning PORT-2 to read colomns
sfr ldata=0x90;	//assigning PORT-1 for LCD data
sbit rs=P3^0;
sbit rw=P3^1;
sbit en=P3^2;
sbit busy=P1^7;
sbit servo=P3^3;          //Output to motor
void lcdcmd(unsigned char value) ;
void lcddata(unsigned char value);
void lcdready(void)	   ;
void printstring(unsigned char ch[]) ;
void LCDclear(void);
void msdelay(unsigned int value)  ;
int keypad();
void timer(unsigned int msec);
void door_open(void);

void door_close(void);
unsigned char userID[5]={"0227"};
unsigned char password[5]={"0070"};
unsigned char update_1[5]={"0000"};
 unsigned char update_2[5]={"0000"};
 unsigned char x;
void main(void)
{ 
 unsigned int i,k;
 
 
  lcdcmd(0x38);
  lcdcmd(0x0F);
  lcdcmd(0x06);
  lcdcmd(0x01);
  //while(1){
  LCDclear();
  lcdcmd(0x80);
  while(1)
  {
  printstring("userID:");
  lcdcmd(0x87);
  
   i=0;
  do
  {
   update_1[i]=keypad();
   lcddata(update_1[i]);
   i++;
   }while(i!=4);
   i=0;
   if(update_1[0]==userID[0] && update_1[1]==userID[1] && update_1[2]==userID[2] && update_1[3]==userID[3] )
   {
 		 lcdcmd(0xC0);
 		 printstring("password:");
  		 lcdcmd(0xC9);
  
 		 do
 		 {
  			 update_1[i]=keypad();
  			 i++;
  			 lcddata('*');
  		 }while(i!=4);
		  if(update_1[0]==password[0] && update_1[1]==password[1] && update_1[2]==password[2] && update_1[3]==password[3] )
 		   {
		   LCDclear();
		   printstring("Authenticated");
		   msdelay(2000);
		   LCDclear();
		   lcdcmd(0x80);
		   printstring("1.Unlock Door");
		   lcdcmd(0xC0);
		   printstring("2.lock Door");

		   do
		   {
		    k=keypad();
			}while(k!='1' && k!='2' && k!='C');
		    switch(k)
			{
			 case '1' :while(1)
						 { 
						 door_open();
						if('2'==keypad())
						   door_close();
			 			if('C' ==keypad())
				 			{
				 				main();
							}	
						}
			 			break;
			case '2' : 	while(1)
						{
						 door_close();
						 if('1'==keypad())
						 door_open();
						if('C' ==keypad())
						 {
				 			main();
					    	}
						}
						break;
			case 'C' : main();
						break;
			default  :main();
					  break;
			}
		   }

		   else
		   {
		   LCDclear();
		   printstring("Access Denide");
		   msdelay(1000);
		   LCDclear();
		  
		   main();
		   }
 	
 }
 else
 {
  LCDclear();
  printstring("Invalid UserID");
  msdelay(1000);
  main();  		   
 }
 }
 }
 /* sending commands to  LCD display to act in command mode */ 
void lcdcmd(unsigned char value)
{
 lcdready();
 ldata=value;
 rs=0;
 rw=0;
 en=1;
 msdelay(10);
 en=0;
 }
 /* sending commnad to LCD to display characters*/
void lcddata(unsigned char value)
{
 lcdready();
 ldata=value;
 rs=1;
 rw=0;
 en=1;
 msdelay(10);
 en=0;
 }
 /* checking LCD buffer for free */
void lcdready(void)
{
 busy=1;
 rs=0;
 rw=1;
 if(busy==1)
  {
   en=0;
   msdelay(1);
   en=1;
   }
}

void printstring(unsigned char ch[])
{
 unsigned int i;
 for(i=0;ch[i]!='\0';i++)
 lcddata(ch[i]);
 }
/* generating delay*/
void msdelay(unsigned int value)
{
 unsigned int i,j;
 for(i=0;i<value;i++)
 for(j=0;j<100;j++);
 }
void LCDclear(void)
 {
  lcdcmd(0x01);
  }
int keypad() 
 {
   unsigned char dat[4][4]={'7','8','9','%',	 // assigning key matrix
                          '4','5','6','*',
						   '1','2','3','-',
						   'C','0','=','+'};
 unsigned char colloc,rowloc;
 COL=0xFF;
 ROW=0x00;
 rs=0;
 rw=0;
 en=0;
 busy=0;
 /* setting LCD screen*/ 
 ldata=0x00;
 lcdcmd(0x38);
 lcdcmd(0x0E);
  lcdcmd(0x06);

 while(1)
 {
/* reading character from keyboard */
   do
   {
    ROW=0x00;
   	colloc=COL;
	colloc&=0x0F;
	}while(colloc!=0x0F);
	do
	{
	 do
	 {
	  msdelay(25);
	  colloc=COL;
	  colloc&=0x0F;
	  }while(colloc==0x0F);
	  msdelay(25);
	  colloc=COL;
	  colloc&=0x0F;
	  }while(colloc==0x0F);
    while(1)
	{
	 ROW=0xFE;
	 colloc=COL;
	 colloc&=0x0F;
	 if(colloc!=0x0F)
	 { 
	  rowloc=0;
	  break;
	  }
	  ROW=0xFD;
	  colloc=COL;
	  colloc&=0x0F;
	   if(colloc!=0x0F)
	   {
	    rowloc=1;
		break;
		}
	  ROW=0xFB;
	  colloc=COL;
	  colloc&=0x0F;
	   if(colloc!=0x0F)
	   {
	    rowloc=2;
		break;
		}
	  ROW=0xF7;
	  colloc=COL;
	  colloc&=0x0F;
	if(colloc!=0x0F)
	  {  
	      rowloc=3;
	      break;
	    }
	   }
   if(colloc==0x0E)
   return(dat[rowloc][0]);
   else if(colloc==0x0D)
   return(dat[rowloc][1]);
   else if(colloc==0x0B)
   return(dat[rowloc][2]);
   else
    return(dat[rowloc][3]);
	}
	}
 void timer(unsigned int msec)     // Function for timer
{
unsigned int i;
for(i=0;i<msec;i++)
{
TMOD=0x20;         // Mode2
TH1=0xD1;
TL1=0xFF;

TR1=1;
while(TF1==0);
TF1=0;
TR1=0;
}
}

void door_open()
{
 unsigned int i;
servo=0;
//anticlockwise direction
		for(i=0;i<1;i++)
		{
			servo=1;
			timer(10);
			servo=0;
			timer(380);
		}
}
void door_close()
{
 unsigned int i;
servo=0;
//clockwise direction
		for(i=0;i<1;i++)
		{
			servo=1;
			timer(60);
			servo=0;
			timer(340);
		}
}