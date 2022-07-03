/*
 * INCLUDES
 * BEGIN
 */
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include "driverlib.h"
/*
 * INCLUDES
 * END
 */


/*
 * GLOBALS
 * BEGIN
 */
long temp;
volatile long IntDegC;
unsigned long debug_timeout = 250;
/*
 * GLOBALS
 * END
 */

/*
 * MACROS
 * BEGIN
 */
#define COMPARE_VALUE 50000
/*
 * MACROS
 * END
 */

/*
 * Functions declerations
 * BEGIN
 */
void UART_setup(void);
void UART_Send_Character(char c);
void UART_Send_String(char* string);
char UART_Get_Character();
void UART_Get_Word(char* buffer, int limit);
/*
 * Functions declerations
 * END
 */

void main(void)
{
	//stop watch dog
    WDT_A_hold(WDT_A_BASE);

    /*
     * GPIO Setup
     */


    /*
     * Timer Setup
     */
    Timer_A_initContinuousModeParam initContParam = {0};
    initContParam.clockSource = TIMER_A_CLOCKSOURCE_SMCLK;
    initContParam.clockSourceDivider = TIMER_A_CLOCKSOURCE_DIVIDER_1;
    initContParam.timerInterruptEnable_TAIE = TIMER_A_TAIE_INTERRUPT_DISABLE;
    initContParam.timerClear = TIMER_A_DO_CLEAR;
    initContParam.startTimer = false;
    Timer_A_initContinuousMode(TIMER_A1_BASE, &initContParam);

    //Initiaze compare mode
    Timer_A_clearCaptureCompareInterrupt(TIMER_A1_BASE,
                                         TIMER_A_CAPTURECOMPARE_REGISTER_0
                                         );

    Timer_A_initCompareModeParam initCompParam = {0};
    initCompParam.compareRegister = TIMER_A_CAPTURECOMPARE_REGISTER_0;
    initCompParam.compareInterruptEnable =
        TIMER_A_CAPTURECOMPARE_INTERRUPT_ENABLE;
    initCompParam.compareOutputMode = TIMER_A_OUTPUTMODE_OUTBITVALUE;
    initCompParam.compareValue = COMPARE_VALUE;
    Timer_A_initCompareMode(TIMER_A1_BASE, &initCompParam);

    Timer_A_startCounter(TIMER_A1_BASE,
                         TIMER_A_CONTINUOUS_MODE
                         );


    // UART setup
	UART_setup();

	/*
	 * ADC Setup
	 */
    ADC12_A_init(ADC12_A_BASE,
                 ADC12_A_SAMPLEHOLDSOURCE_SC,
                 ADC12_A_CLOCKSOURCE_ADC12OSC,
                 ADC12_A_CLOCKDIVIDER_1);

    ADC12_A_enable(ADC12_A_BASE);

    ADC12_A_enable(ADC12_A_BASE);

    ADC12_A_setupSamplingTimer(ADC12_A_BASE,
                               ADC12_A_CYCLEHOLD_768_CYCLES,
                               ADC12_A_CYCLEHOLD_4_CYCLES,
                               ADC12_A_MULTIPLESAMPLESDISABLE);

    ADC12_A_configureMemoryParam param = {0};
    param.memoryBufferControlIndex = ADC12_A_MEMORY_0;
    param.inputSourceSelect = ADC12_A_INPUT_TEMPSENSOR;
    param.positiveRefVoltageSourceSelect = ADC12_A_VREFPOS_INT;
    param.negativeRefVoltageSourceSelect = ADC12_A_VREFNEG_AVSS;
    param.endOfSequence = ADC12_A_NOTENDOFSEQUENCE;
    ADC12_A_configureMemory(ADC12_A_BASE,&param);

    ADC12_A_clearInterrupt(ADC12_A_BASE,
                           ADC12IFG0);
    ADC12_A_enableInterrupt(ADC12_A_BASE,
                            ADC12IE0);

    /*
     * ADC reference Setup
     */
    while(REF_ACTIVE == Ref_isRefGenBusy(REF_BASE))
    {
        ;
    }
    Ref_setReferenceVoltage(REF_BASE,
                            REF_VREF1_5V);
    Ref_enableReferenceVoltage(REF_BASE);

    __delay_cycles(75);
	__bis_SR_register(GIE);

	// trigger ADC conversion
	ADC12_A_startConversion(ADC12_A_BASE,
							ADC12_A_MEMORY_0,
							ADC12_A_SEQOFCHANNELS);

    while(1)
    {
    }
}

/*
 * ADC ISR
 */
#pragma vector=ADC12_VECTOR
__interrupt void ADC12ISR(void)
{
    switch(__even_in_range(ADC12IV,34))
    {
    case  0: break;       //Vector  0:  No interrupt
    case  2: break;       //Vector  2:  ADC overflow
    case  4: break;       //Vector  4:  ADC timing overflow
    case  6:              //Vector  6:  ADC12IFG0
        //Move results, IFG is cleared
        temp = ADC12_A_getResults(ADC12_A_BASE,
                                  ADC12_A_MEMORY_0);

        IntDegC = (((temp - 1855) * 667) / 4096);

        // Trigger conversion for next time
		ADC12_A_startConversion(ADC12_A_BASE,
								ADC12_A_MEMORY_0,
								ADC12_A_SEQOFCHANNELS);
        //Exit active CPU
        //__bic_SR_register_on_exit(LPM4_bits);
        break;
    case  8: break;       //Vector  8:  ADC12IFG1
    case 10: break;       //Vector 10:  ADC12IFG2
    case 12: break;       //Vector 12:  ADC12IFG3
    case 14: break;       //Vector 14:  ADC12IFG4
    case 16: break;       //Vector 16:  ADC12IFG5
    case 18: break;       //Vector 18:  ADC12IFG6
    case 20: break;       //Vector 20:  ADC12IFG7
    case 22: break;       //Vector 22:  ADC12IFG8
    case 24: break;       //Vector 24:  ADC12IFG9
    case 26: break;       //Vector 26:  ADC12IFG10
    case 28: break;       //Vector 28:  ADC12IFG11
    case 30: break;       //Vector 30:  ADC12IFG12
    case 32: break;       //Vector 32:  ADC12IFG13
    case 34: break;       //Vector 34:  ADC12IFG14
    default: break;
    }
}

/*
 * TIMER ISR
 */
#pragma vector=TIMER1_A0_VECTOR
__interrupt void TIMER1_A0_ISR(void)
{
	char console_buffer[100] = {};
    uint16_t compVal = Timer_A_getCaptureCompareCount(TIMER_A1_BASE,
                                                      TIMER_A_CAPTURECOMPARE_REGISTER_0)
                       + COMPARE_VALUE;

    /*
     * Display temperature messages
     */
    if (!debug_timeout--) {
    	sprintf(console_buffer, "TEMP: %.2f\r\n", (float)IntDegC);
    	UART_Send_String(console_buffer);
    	debug_timeout = 250;
    }

    //Add Offset to CCR0
    Timer_A_setCompareValue(TIMER_A1_BASE,
                            TIMER_A_CAPTURECOMPARE_REGISTER_0,
                            compVal
                            );
}

/*
 * UART initialization function
 */
void UART_setup(void)
{
    P4SEL |= BIT4 + BIT5;   // Set USCI_A1 RXD/TXD to receive/transmit data
    UCA1CTL1 |= UCSWRST;    // Set software reset during initialization
    UCA1CTL0 = 0;           // USCI_A1 control register
    UCA1CTL1 |= UCSSEL_2;   // Clock source SMCLK
    UCA1BR0 = 0x09;         // 1048576 Hz  / 115200 lower byte
    UCA1BR1 = 0x00;         // upper byte
    UCA1MCTL = 0x02;        // Modulation (UCBRS0=0x01, UCOS16=0)
    UCA1CTL1 &= ~UCSWRST;   // Clear software reset to initialize USCI state machine
    //IE2 |= UCA1RXIE;        // Enable USCI_A1 RX interrupt
    //UCA1IE |= UCRXIE;        // Enable USCI_A1 RX interrupt
}

/*
 * UART sending a single character
 */
void UART_Send_Character(char c)
{
    while (!(UCA1IFG & UCTXIFG)); // Wait for previous character to transmit
    UCA1TXBUF = c;               // Put character into tx buffer
}

/*
 * UART sending a string
 */
void UART_Send_String(char* string)
{
    unsigned int i;
    for(i = 0; i < strlen(string); i++)
    {
        UART_Send_Character(string[i]);
    }
}

/*
 * UART getting character from terminal
 */
char UART_Get_Character()
{
    while(!(UCA1IFG & UCRXIFG)); // Wait for a new character
    return UCA1RXBUF;
}

/*
 * UART getting string from terminal
 */
void UART_Get_Word(char* buffer, int limit)
{
    char Current_Character = UART_Get_Character();
    UART_Send_Character(Current_Character);
    unsigned int i = 0;

    do
    {
        buffer[i] = Current_Character;
        Current_Character = UART_Get_Character();
        UART_Send_Character(Current_Character);
        if(i < limit-2)
        {
            i++;
        }

        else
        {
            break;
        }

    }

    while(Current_Character != '\r');
    UART_Send_Character('\r');
    UART_Send_Character('\n');
    buffer[i] = 0;
}
