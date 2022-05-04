#include <msp430.h>               // Peripheral Address
#include "../driverlib/driverlib.h"
#include "i2clcd.h"
#include <stdio.h>

void ILCDI2CInit(void){
    P1SEL0 |= BIT2 | BIT3;

    UCB0CTLW0 |= UCSWRST;                   // Software reset enabled
    UCB0CTLW0 |= UCTR | UCMODE_3 | UCMST;   // I2C mode, Master mode, sync
    UCB0BRW = 0x000b;                       // baudrate = SMCLK / 11
    UCB0I2CSA = 0x0027;                     // Slave address
    UCB0CTLW0 &= ~UCSWRST;                  // clear reset register
}

void ILCDI2CTxByte(unsigned char dd){
    UCB0TXBUF = dd;
    while (!(UCB0IFG & UCTXIFG0));
    UCB0IFG &= ~UCTXIFG;
}

void ILCDI2CTxStart(void){
    UCB0CTLW0 |= UCTXSTT;   // send start condition
}

void ILCDI2CTxStop(void){
    UCB0CTLW0 |= UCTXSTP;   // send stop condition
}

void ILCDInit(void){
    ILCDI2CInit();

    ILCDI2CTxStart();

    //Reset
    ILCDI2CTxByte(0x03);
    ILCDI2CTxByte(0x34);
    ILCDI2CTxByte(0x30);
	__delay_ms__(10);
    ILCDI2CTxByte(0x34);
    ILCDI2CTxByte(0x30);
	__delay_ms__(10);
    ILCDI2CTxByte(0x34);
    ILCDI2CTxByte(0x30);
	__delay_ms__(10);

    ILCDI2CTxByte(0x20);
    ILCDI2CTxByte(0x24);
    ILCDI2CTxByte(0x20);
	__delay_ms__(10);

    ILCDI2CTxByte(0x24);
    ILCDI2CTxByte(0x20);
    ILCDI2CTxByte(0x84);
    ILCDI2CTxByte(0x80);

    ILCDI2CTxByte(0x04);
    ILCDI2CTxByte(0x00);
    ILCDI2CTxByte(0xc4);
    ILCDI2CTxByte(0xc0);

    ILCDI2CTxByte(0x04);
    ILCDI2CTxByte(0x00);
    ILCDI2CTxByte(0x14);
    ILCDI2CTxByte(0x10);

    ILCDI2CTxByte(0x84);
    ILCDI2CTxByte(0x80);
    ILCDI2CTxByte(0x04);
    ILCDI2CTxByte(0x00);

	ILCDI2CTxStop();
}

void ILCDClearDisplay(void){
    ILCDI2CTxStart();
    ILCDI2CTxByte(0x04);
    ILCDI2CTxByte(0x00);
    ILCDI2CTxByte(0x14);
    ILCDI2CTxByte(0x10);
	ILCDI2CTxStop();
}

int ILCDSetCursor(int line, int col){
    unsigned short address = 0;
    if(line==1){
        address = 0x80 + col;
        ILCDI2CTxStart();
        ILCDI2CTxByte(0x0C | (address & 0xf0));
        ILCDI2CTxByte(0x08 | (address & 0xf0));
        ILCDI2CTxByte(0x0C | ((address << 4) & 0xf0));
        ILCDI2CTxByte(0x08 | ((address << 4) & 0xf0));
        ILCDI2CTxStop();
        __delay_ms__(30);
    } else if(line==2) {
        address = 0xc0 + col;
        ILCDI2CTxStart();
        ILCDI2CTxByte(0x0C | (address & 0xf0));
        ILCDI2CTxByte(0x08 | (address & 0xf0));
        ILCDI2CTxByte(0x0C | ((address << 4) & 0xf0));
        ILCDI2CTxByte(0x08 | ((address << 4) & 0xf0));
        ILCDI2CTxStop();
        __delay_ms__(30);
    } else {
        return -1;  // Invalid line number
    }
    return 1;   //  success
}

void ILCDPrint(unsigned char * txt){
    ILCDI2CTxStart();
    while(*txt != 0){
        ILCDI2CTxByte(0x0d | (*txt & 0xf0));
        ILCDI2CTxByte(0x09 | (*txt & 0xf0));
        ILCDI2CTxByte(0x0d | ((*txt << 4) & 0xf0));
        ILCDI2CTxByte(0x09 | ((*txt << 4) & 0xf0));
        txt++;
    }
	ILCDI2CTxStop();
}

void ILCDPrintInt(int num)
{
    char tempBuffer[20] = {};
    sprintf(tempBuffer,"%d",num);
    ILCDPrint((unsigned char *)tempBuffer);
}
