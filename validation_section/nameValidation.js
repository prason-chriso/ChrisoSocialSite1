function validate(){
	var name= document.getElementById('first').value;
	if(name == "") alert("name is required");
	document.getElementById('first').focus;
	return;
/*	var pattern = /[a-z]/;
	if(pattern.test(name)){
		document.getElementById('first_name_error').innerHTML = "okay ";
	}
	else{
		document.getElementById('first_name_error').innerHTML = "error format";
	}
return;*/
}
