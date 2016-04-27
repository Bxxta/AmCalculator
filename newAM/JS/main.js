document.getElementById('send').addEventListener ('click' , main , 'false');
document.getElementById('employeeContract').addEventListener ('click', isEmployeeContract , 'false');
document.getElementById('orderContract').addEventListener('click',isOrderContract, 'false');


function main ()
{
var form = document.forms[0];
var salaryHourZl = form.salaryHourZl.value;
var salaryHourGr = form.salaryHourGr.value;



if (form.contract[0].checked){

		var isEmployContract = true;
		var dayHour = form.dayHour.value;
		var nightHour = form.nightHour.value;
		var worker = new TaxContract (salaryHourZl,salaryHourGr,dayHour, nightHour);
		worker.validateForm();
			
	}
else if (form.contract[1].checked) {

		var isEmployContract = false;
		var hour = form.hours.value;
		var worker = new TaxOrder (salaryHourZl, salaryHourGr, hour);
		if (worker.validateForm())
			{
			// Next Methods.
			alert("OK");
			}
	}
else{
		alert ("Nie wybrałeś żadnego umowy ;/");
		return;
	}

	
		
}


function isEmployeeContract ()
{
document.getElementById('labelforDay').classList.remove('hidden');
document.getElementById('labelforNight').classList.remove ('hidden');
document.getElementById('labelforHour').classList.add('hidden');
}

function isOrderContract ()
{
document.getElementById('labelforDay').classList.add('hidden');
document.getElementById('labelforNight').classList.add ('hidden');
document.getElementById('labelforHour').classList.remove('hidden');

}