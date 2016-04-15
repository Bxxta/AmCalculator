var taxJS = function (hour, dayHour, nightHour, salaryHourZl, salaryHourGr, isEmployContract){
	this.hour = hour;
	this.dayHour = dayHour;
	this.nightHour = nightHour;
	this.salaryHourZl = salaryHourZl;
	this.salaryHourGr = salaryHourGr;
	this.isEmployContract = isEmployContract;
		this.errorLog = function (errorParam) {
		switch (errorParam)
				{
					case 0:
					{
					alert("Podane kwoty są za duże lub zostały w ogóle nie podane");
					break;
					}
					case 1:
					{
					alert("Podane kwoty nie są liczbami");
					break;
					}
					case 2:
					{
					alert("Podane kwoty nie mogą być ujemne lub równe zero");
					break;
					}
					case 3:
					{
					alert("Bo uwierze, że zarabiasz więcej niż " + this.maxSalary() + " zł lub mniej niż " + this.minSalary() + " zł." );
					break;
					}
					case 4:
					{
					alert ("Godziny dzienne lub godziny nocne są równe zero");
					break;
					}
					case 5:
					{
					alert ("Za duża ilość godzin");
					break;
					}
					case 6:
					{
					alert ("Godziny nie są liczbami");
					break;
					}
					case 7:
					{
					alert ("Bo uwierze, że pozwolili Ci pracować powyżej " + this.maxHour() +" godzin.");
					break;
					}
				}
				
	
	
	
	
	}
	// Test function. If you dont want use this, please delete
	  this.printTest = function() {
        alert("test Function:  hour: " + this.hour + " dayHour: " + this.dayHour + " nightHour: " + this.nightHour + " salaryHourZl: " + this.salaryHourZl + " salaryHourGr: " + this.salaryHourGr + " isEmployContract: "  + this.isEmployContract); 
    }
	
	
	
	
	
	  this.validateForm = function ()
	{
		if (this.salaryHourZl.length> this.maxLength() || this.salaryHourGr.length > this.maxLength() || this.isNull(this.salaryHourZl))
			{
			this.errorLog(0);
			return;
			}
		else
			{
			
				if (this.isNaN(this.salaryHourZl) || this.isNaN(this.salaryHourGr) )
				{
				this.errorLog(1);
				return;
				}
				else
				{
				this.salaryHourZl = this.parseFunc(this.salaryHourZl);
				this.salaryHourGr = Math.round(this.parseFunc(this.salaryHourGr));
					if (this.isNull(this.salaryHourZl))
						{
						this.errorLog(2)
						return;
						}
					else
						{
						var salary = this.salaryHourZl + this.salaryHourGr/100;
						if (salary > this.maxSalary () || salary < this.minSalary())
							{
							this.errorLog(3)
							return;
							}
						}
				
				}
			}
			
			
			
		alert (salary);	
		if (this.isEmployContract == true)
			{
			if (this.isNull(this.dayHour) && this.isNull(this.nightHour))
				{
					this.errorLog(4);
					return;
				}
				else
				{
					if (this.dayHour.length > this.maxLengthHour() || this.nightHour.length > this.maxLengthHour())
						{
						this.errorLog(5);
						return;
						}
					else
					{
						if(this.isNaN(this.dayHour) && this.isNaN(this.nightHour))
						{
						this.errorLog(6);
						return;
						}
						else
						{
							this.dayHour = this.parseFunc(this.dayHour, 10);
							this.nightHour = this.parseFunc(this.nightHour, 10);
							if (this.dayHour > this.maxHour() || this.nightHour > this.maxHour())
							{
							this.errorLog(7)
							return;
							}
						}
					}
					
					
				}
			}
			if (this.isEmployContract == false)
			{
			
				if(this.isNull(this.hour))
				{
					this.errorLog(4);
					return;
				}
				else
				{
					if (this.hour.length > this.maxLengthHour())
					{
					this.errorLog(5);
					return;
					}
					else
					{
						if (this.isNaN(this.hour))
						{
						this.errorLog(6);
						return;
						}
						else
						{
						 this.hour = this.parseFunc(this.hour);
							if (this.hour > this.maxHour())
							{
							this.errorLog(7);
							return;
							}
						}
					}
				}
			}
		return true;
	}
	//Control Methods.
	this.isNaN = function (paramValue)
	{
	if (isNaN(parseInt(paramValue,10)))
		{
		return true;
		}
	else
		{
		return false;
		}
	}
	this.isNull = function (paramValue)
	{
	if (paramValue == 0 || paramValue == "")
		{
		return true;
		}
	else
		{
		return false;
		}
		
	
	}
	
	
	// Get and Set Methods. (After)
	this.parseFunc = function (paramValue)
	{
	return Math.abs(parseInt(paramValue,10));
	}
	this.maxSalary = function ()
	{
	var maxSalary = 15;
	return maxSalary;
	}
	this.maxLength = function ()
	{
	var maxLength = 2;
	return maxLength;
	}
	this.minSalary = function ()
	{
	
	var minSalary = 8;
	return minSalary;
	}
	this.maxLengthHour = function()
	{
	var maxLengthHour = 3;
	return maxLengthHour;
	}
	this.maxHour = function ()
	{
	var maxHour = 200;
	return maxHour;
	}
	
	
	
}
	  