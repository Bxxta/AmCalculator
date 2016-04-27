	/*
	*
	* Set your validate option.
		--- Option ---
		*maxLengthHour   = 	max string length Hour.
		*minSalary =		min Salary, how employee can write.
		*maxSalary = 		max Salary, how employee can write.
	*
	*/

var ValidationOption  = {
						maxHour: 200,
						minSalary: 7,
						maxSalary: 15,
						}
						
	/*
	*
	*Set your option to create erorPrint.
		--- Option ---
		*nodeParent = Parent Object HTML.
		*nodeChild  = Child Object HTML.
		*errorTable = Posible errors.
			---Options----
			[0] Salary is not number.
			[1] Salary is too low.
			[2] Salary is too high or Salary is too low
			[3] All hours is too much
			[4] Day hour or night hour is not exist.
			[5] Day hour or night hour is not number.
			[6] Hours is not number.
			[7] Hours is too much.
	*
	*/
						
var ErrorPrintOption = {
						nodeParent: document.getElementsByTagName('body')[0],
						nodeChild: document.forms[0],
						errorArr: new Array (
								'Podana kwota nie jest liczbą',
								'Podana kwota jest za mała',
								'Przekroczono maksymalną lub minimalną kwotę',
								'Przekroczono maksymalną ilość godzin',
								'Godziny dzienne jak i nocne nie mają żadnej wartośći',
								'Godziny dzienne lub nocne nie są liczbą',
								'Godziny nie są liczbą',
								'Za dużo godzin'
								),
												
						}
	/*
	*
	*Tax Contract Constructor
	*
	*/

var TaxContract = function (salaryHourZl, salaryHourGr, dayHour, nightHour){
	ValidateMethods.call (this);
	this.dayHour = dayHour;
	this.nightHour = nightHour;
	this.salaryHourZl = salaryHourZl;
	this.salaryHourGr = salaryHourGr;
	}

	/*
	*
	*Add methods validateForm to Object TaxContract.
	*Extend ValidateMethods Object.
	*
	*/

		
	
TaxContract.prototype.validateForm = function (){
	if (document.getElementById('error'))
		{
		ErrorPrintOption.nodeParent.removeChild(document.getElementById('error'));
		}
	if (this.salaryHourGr == "")
		{
		this.salaryHourGr = 0;
		}
		
		
	
	if ( this.isNaN(this.salaryHourZl) || this.isNaN(this.salaryHourGr) ){
		this.printError(0);
		return false;
		}
	
	
	this.salaryHourZl = this.parseFunc(this.salaryHourZl);
	this.salaryHourGr = Math.round(this.parseFunc(this.salaryHourGr));
	var salary = this.salaryHourZl + this.salaryHourGr/100;
	if (salary > ValidationOption.maxSalary || salary < ValidationOption.minSalary){
		this.printError(2);
		return false;
		}
		
	
	if (this.dayHour == "" ){
		this.dayHour = 0;
		}
	if (this.nightHour == ""){
		this.nightHour = 0;
		}
	if (this.isNull(this.dayHour) && this.isNull(this.nightHour)){
		this.printError(4);
		return false;
		}
		
	if (this.isNaN(this.dayHour) || this.isNaN(this.nightHour)){
		this.printError(5);
		return false;
		} 	
	this.dayHour = this.parseFunc(this.dayHour);
	this.nightHour = this.parseFunc (this.nightHour);
	var hours = this.dayHour + this.nightHour;
	if (hours > ValidationOption.maxHour){
		this.printError(3);
		return false;
		}
		
		
	return true;
	}



	/*
	*
	*Tax Order Object
	*
	*/



	
var TaxOrder = function (salaryHourZl,salaryHourGr, hour){
	ValidateMethods.call(this);
	this.salaryHourZl = salaryHourZl;
	this.salaryHourGr = salaryHourGr;
	this.hour = hour;

	}

	
	/*
	*
	*Add methods validateForm to Object TaxOrder.
	*Extend ValidateMethods Object.
	*
	*/


	
TaxOrder.prototype.validateForm = function (){
	
	if (document.getElementById('error'))
		{
		ErrorPrintOption.nodeParent.removeChild(document.getElementById('error'));
		}
	if (this.salaryHourGr == "")
		{
		this.salaryHourGr = 0;
		}
			
		
	if (this.isNaN(this.salaryHourZl) || this.isNaN(this.salaryHourGr)){
		this.printError(0);
		return false;
		}
		
		
	this.salaryHourZl = this.parseFunc(this.salaryHourZl);
	this.salaryHourGr = Math.round(this.parseFunc(this.salaryHourGr));
	var salary = this.salaryHourZl + this.salaryHourGr/100;
	if (salary > ValidationOption.maxSalary || salary < ValidationOption.minSalary)
		{
		this.printError(2);
		return false;
		}
	
	
	if (this.isNull(this.hour)){
		this.printError(6);
		return false;
		}
	
	this.hour = this.parseFunc(this.hour);
	if (this.hour > ValidationOption.maxHour)
		{
		this.printError(8);
		return false;
		}
	return true;
	}

	
	/*
	*
	*Extend class.
	*isNaN: check return is NaN
	*isNull: check paramValue is empty.
	*parseFunc = Use math and parse to int type.
	*printError = create ElementHTML and put error Info.
	*
	*/	
	
var ValidateMethods = function (){

this.isNaN = function (paramValue) {
	if (isNaN(parseInt(paramValue,10))) return true; else return false;
	}
this.isNull = function (paramValue){
	return !paramValue;
	}
this.parseFunc = function (paramValue){
	return Math.abs(parseInt(paramValue,10));
	}
this.printError = function (paramValue){
	if (!document.getElementById('error')){
			var p_Create = document.createElement('p');
			p_Create.setAttribute('id' , 'error');
			ErrorPrintOption.nodeParent.insertBefore( p_Create , ErrorPrintOption.nodeChild);
			p_Create.classList.add ('tax_warning');
			}
	for (var i= 0 ; i < ErrorPrintOption.errorArr.length ; i++){
				if( paramValue == i){
				document.getElementById('error').innerHTML = "" + ErrorPrintOption.errorArr[i] + "";
				break;
				}
			}
	
	}
}
	