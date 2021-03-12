function processForm()
{
	//Boolean value that determines if every input is valid
	var correctValidation = true;
	
	//Definition and initialization of variables with empty values
	var name = "";
	var email = "";
	var agree = "";
	var currentGPA = "";
	var currentCredits = "";
	var newCredits = "";
	var GPAincrease = "";
	var currentGPAhours = "";
	var desiredGPA = "";
	var desiredGPAhours = "";
	var GPAhoursincrease = "";
	var amount = "";
	
	//Checks if name is empty
	if(document.getElementById("name").value == "")
	{
		document.getElementById('nameErr').innerHTML = "Your name must consist of letters and white space";
		var correctValidation = false;
	}else{
		var name = document.getElementById("name").value;
		document.getElementById('nameErr').innerHTML = "";
	}
	if(!(/^[a-zA-Z ]+$/.test(document.getElementById("name").value)))
	{
		document.getElementById('nameErr').innerHTML = "Your name must consist of letters and white space";
		correctValidation = false;
	}
	
	//Checks if email is empty
	if(document.getElementById("email").value == "")
	{
		document.getElementById('emailErr').innerHTML = "Invalid email format";
		var correctValidation = false;
	}else{
		var email = document.getElementById("email").value;
		document.getElementById('emailErr').innerHTML = "";
	}
	//Checks if email adress is well-formed
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email").value)))
		{
			document.getElementById('emailErr').innerHTML = "Invalid email format";
			var correctValidation = false;
		}
	
	//Checks if the user agrees to the terms and conditons
	var agree = document.getElementById("agree");
	if(agree.checked != true)
	{
		document.getElementById('agreeErr').innerHTML = "You must agree to the terms and conditions";
		var correctValidation = false;
	}else{
		var agree = document.getElementById("agree");
		document.getElementById('agreeErr').innerHTML = "";
	}
	
	//Checks if currentGPA is empty
	if(document.getElementById("currentGPA").value == "")
	{
		document.getElementById('currentGPAErr').innerHTML = "Your current GPA must be a number between 0.0 and 4.0";
		var correctValidation = false;
	}else{
		var currentGPA = document.getElementById("currentGPA").value;
		document.getElementById('currentGPAErr').innerHTML = "";
	}
	//Checks if the current GPA is a number between 0.0 and 4.0
	if(!(/^(?:4(?:\.0)?|[0-3](?:\.[0-9]+)?|0?\.[1-9]+)?$/.test(document.getElementById("currentGPA").value)))
	{
		document.getElementById('currentGPAErr').innerHTML = "Your current GPA must be a number between 0.0 and 4.0";
		var correctValidation = false;
	}
	
	//Checks if currentCredits is empty
	if(document.getElementById("currentCredits").value == "")
	{
		document.getElementById('currentCreditsErr').innerHTML = "Your current number of credits must be a positive integer";
		var correctValidation = false;
	}else{
		var currentCredits = document.getElementById("currentCredits").value;
		document.getElementById('currentCreditsErr').innerHTML = "";
	}
	//Checks if the number of credits is a positive integer
	if(!(/^[0-9]+(\\.[0-9]+)?$/.test(document.getElementById("currentCredits").value)))
	{
		document.getElementById('currentCreditsErr').innerHTML = "Your current number of credits must be a positive integer";
		var correctValidation = false;
	}
	
	//Checks if newCredits is empty
	if(document.getElementById("newCredits").value == "")
	{
		document.getElementById('newCreditsErr').innerHTML = "(the number of credits this semester must be an integer greater than 0)";
		var correctValidation = false;
	}else{
		var newCredits = document.getElementById("newCredits").value;
		document.getElementById('newCreditsErr').innerHTML = "";
	}
	//Checks if the number of credits this semester is an integer greater than 0
	if(!(/^[1-9]+[0-9]*$/.test(document.getElementById("newCredits").value)))
	{
		document.getElementById('newCreditsErr').innerHTML = "(the number of credits this semester must be an integer greater than 0)";
		var correctValidation = false;
	}
	
	//Checks if GPAincrease is empty
	if(document.getElementById("GPAincrease").value == "")
	{
		document.getElementById('GPAincreaseErr').innerHTML = "(your desired GPA increase must be a positive value)";
		var correctValidation = false;
	}else{
		var GPAincrease = document.getElementById("GPAincrease").value;
		document.getElementById('GPAincreaseErr').innerHTML = "";
	}
	//Checks if the desired GPA increase is a positive value
	if(!(/^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(document.getElementById("GPAincrease").value)))
	{
		document.getElementById('GPAincreaseErr').innerHTML = "(your desired GPA increase must be a positive value)";
		var correctValidation = false;
	}
	
	//Calculates GPA if there are no errors
	if(correctValidation == true)
	{
		var currentGPAhours = Number.parseFloat(currentGPA) * Number.parseInt(currentCredits);
		var desiredGPA = Number.parseFloat(currentGPA) + Number.parseFloat(GPAincrease);
		var desiredGPAhours = Number.parseFloat(desiredGPA) * (Number.parseInt(currentCredits) + Number.parseInt(newCredits));
		var GPAhoursincrease = Number.parseFloat(desiredGPAhours) - Number.parseFloat(currentGPAhours);
		var amount = Number.parseFloat(GPAhoursincrease) / Number.parseInt(newCredits);
		var amount = amount.toFixed(2);
		document.getElementById("amount").innerHTML = amount;
	}else{
		document.getElementById("amount").innerHTML = "????";
	}
}