#ifndef LCD_I2CLCD_H_
#define LCD_I2CLCD_H_

#define __delay_ms__(x) __delay_cycles((long) x* 1000)
#define __delay_us__(x) __delay_cycles((long) x)

void ILCDI2CInit(void);
void ILCDInit(void);
void ILCDClearDisplay(void);
void ILCDPrint(unsigned char * txt);
void ILCDI2CTxStart(void);
void ILCDI2CTxStop(void);
void ILCDI2CTxByte(unsigned char dd);
int ILCDSetCursor(int line, int col);
void ILCDPrintInt(int num);

#endif /* LCD_I2CLCD_H_ */
