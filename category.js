function databaseResult()
{	
	//Create XMLHttpRequest
	var ajax = new XMLHttpRequest();
	//Create variables to send to category.php
	var url = "category.php";
	var selectedCategory = document.getElementById("category").value;
	var vars = "theCategory="+selectedCategory;
	ajax.open("POST", url, true);
	
	//Set content type header information for sending url encoded variables in the request
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	//Access the onreadystatechange event for the XMLHttpRequest object
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			var return_data = ajax.responseText;
			document.getElementById("status").innerHTML = return_data;
		}
	}
	//Send the data to PHP and wait for response to update the status div
	ajax.send(vars);
	document.getElementById("status").innerHTML = "processing...";
}