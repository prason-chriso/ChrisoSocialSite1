<html>
<head><title>surfZone sign Up</title>
<link style= "text/css" rel="stylesheet" href="signup_styles.css"/>
</head>

<body>
	<fieldset name="field" id ="field1">
		<legend>SurfZone Sign UP</legend> 	
			<table align ="center" name= "t" cellspacing ="4">
					<form name= "myForm" method = "POST" onSubmit="validate()" action="insertdata.php"> <!-- here the php file processing name is directly given -->
						<tr> <!-- first name -->
							<td>First Name:</td>
							<td><input type="text" name="fname"
							 onchange ="validateFName()" size="30" placeholder="your first name" id="first" /></td>
							<td>
								<span id="first_name_error" class="required">*
										<img id ="input_ok_fname" style="height: 500%; width: auto; visibility: hidden;" src="images/input_ok.jpg"/>
								</span>
							</td>
						</tr>
	
						<tr> <!-- last name -->
							<td>Last Name : </td>
								<td><input type="text" name="lname" onchange="validateLName()" size="30" placeholder="your last name" id="last"/></td>
							<td>
								<span id="last_name_error" class="required">*
										<img id="input_ok_lname" style="height: 500%; width: auto; visibility: hidden;" src="images/input_ok.jpg"/>
								</span>
							</td>

						</tr>
	
	<tr> <!-- email --> 
	<td>Email : </td>
	<td><input id="email" type="text" onchange="validateEmail()" name="email"  size="30" placeholder="enter your email"/></td>
	<td>
		<span id="email_error" class="required">*
							<img id="input_ok_email" style="height: 500%; width: auto; visibility: hidden;" src="images/input_ok.jpg"/>
		</span>
	</td>
	</tr>
	
	<tr> <!-- user name -->
						<td>User Name : </td>
								<td><input type="text" name="uname"  size="30" placeholder="preferred username" 
								onchange = "validateUserName()" id="userName"/>
								</td>
								<td>
								<span id="userName_error" class="required">*
										<img id="input_ok_userName" style="height: 500%; width: auto; visibility: hidden;" src="images/input_ok.jpg"/>
								</span>
							</td>
						</tr>
	
	<tr> <!-- password -->
				<td>Password</td>
						<td>
								<input type="password" name="pass" onchange="validatePassword()" id ="pass" size="30" placeholder="password"/>
								<input type="checkbox" id="show" name="show" 
								onclick="showpass()" >&nbsp;&nbsp;show password
						</td>
						<td>
								<span id="pass_error" class="required">*
										<img id="input_ok_pass" style="height: 500%; width: auto; visibility: hidden;" src="images/input_ok.jpg"/>
								</span>
							</td>

	</tr>
	<tr> <!-- password retype -->
	<td>Re-type Password</td>
	<td>
		<input type="password" id="repass" name="repass" onchange="checkRepass()" size="30" placeholder="retype-password"/>
	</td>
	<td>
								<span id="repass_error" class="required">*
										<img id="input_ok_repass" style="height: 300%; width: 70%; visibility: hidden;" src="images/matched.jpg"/>
								</span>
							</td>

	</tr>
	
	<tr> <!-- Gender -->
	<td>Gender: </td>
	<td class="field" >
		<input type="radio" class="gen" name="gender" value="male"/>Male &nbsp;&nbsp;&nbsp;
		<input type="radio" class="gen" name="gender" value="female"/>Female &nbsp;&nbsp;&nbsp;
		<input type="radio" class="gen" name="gender" value="other"/>Other &nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	
	<tr> <!-- date of birth -->
	
	<td>DOB</td>
	<td class="field">
	<select class="dob" id="year" name="year">
	<option value="defaultY">..Year..</option>
	<?php 
 	for($i=1940; $i<=2000; $i++){
			echo "<option value ='$i'>$i</option>";
	}
	?>
	</select>&nbsp;&nbsp;&nbsp;
	
	<select class="dob" id="month" name="month">
		<option value="defaultM">...Month...</option>
	<?php 
		for($i=1; $i<=12; $i++){
			echo "<option value ='$i'>$i</option>";
		}
	?>
		</select>&nbsp;&nbsp;&nbsp;
		
	<select class="dob" id="day" name="day">
		<option value="defaultD">Day...</option>
		<?php
		for($i=1; $i<33; $i++){
			echo "<option value='$i'> $i</option>";
			
		}
		?>
		</select> 
	</td>			
	</tr>
	<tr> <!-- agree the term and condition -->
		<td colspan='3'>
			<input type="checkbox" value ="agree"  id="agree" onclick="checkAgree()" name="agree_condition"/>
						&nbsp;&nbsp; I agree all the terms and conditions.
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<p style="display: inline-block; " align="right"><span class="required">*</span> (are all required field)</p>
		</td>

		</tr>
					 
				<tr> <!-- submit and reset block -->
					<td colspan='2'>
						<input type="submit" value="Sign UP" name="submit" class="signup_button"/>
			&nbsp;&nbsp;&nbsp;
			<input type="reset" value ="Reset"  name ="reset" class="signup_button"/>
		</td>
	</tr>
</form>
</table>
</fieldset>
</body>
<script language="javascript">

//display the typed password to the user on the cheked
function showpass(){
	if(document.getElementById('show').checked)
		document.getElementById('pass').type = "text";
	else
		document.getElementById('pass').type ="password";

}

	function validate(){
		var fname =	validateFName();
		var lname =	validateLName();
		var email = validateEmail();
		var user =	validateUserName();
		var pass =	validatePassword();
		var repass =	checkRepass();
		
		if(!fname || !lname || !email || !user || !pass || !repass)
			alert("Required fields can't be left blanked ");
		return false;
	}

//to validate the firstname
function validateFName(){
	var name= document.getElementById('first').value;
	if(name == ""){
	document.getElementById('first_name_error').innerHTML = "First-Name is required";
	document.getElementById('first').focus();
	}
	else{// if the firstName field is not empty
		//var pattern = /[\D\W]/;
		var pattern = /^[A-Za-z]+$/;
		if(pattern.test(name)){
			document.getElementById('input_ok_fname').style.visibility ="visible";
			}
			else{
					alert("invalid first name");
					document.getElementById('first').value = "";
					document.getElementById('first').focus();
					document.getElementById('input_ok_fname').style.visibility ="hidden";
					return false;
					}
					
		}//end of the else ....of name validate ...
		return true;
} //end of validateFName...

//to validate the Lastname
function validateLName(){
	var name= document.getElementById('last').value;
	if(name == ""){
	document.getElementById('last_name_error').innerHTML = "Last-Name is required";
	document.getElementById('last').focus();
	}
	else{// if the firstName field is not empty
		//var pattern = /[\D\W]/;
		var pattern = /^[A-Za-z]+$/;
		if(pattern.test(name)){
			document.getElementById('input_ok_lname').style.visibility ="visible";
			}
			else{
					alert("invalid last name");
					document.getElementById('last').value = "";					
					document.getElementById('last').focus();
					document.getElementById('input_ok_lname').style.visibility ="hidden";
					return false;
					}
		
		}//end of the else ....of last name validate ...
return true;
} //end of validateLName...

function validateEmail(){
	var email = document.getElementById('email').value ;
	if(email == ""){
	document.getElementById('email_error').innerHTML = "Email is required";
	document.getElementById('email').focus();
	}
	else{
	var pattern = /^[A-Za-z\d\._]+\@+(gmail|yahoo|outlook|hotmail|ymail)+\.[a-z]{2,4}/;
		if(pattern.test(email)){
			document.getElementById('input_ok_email').style.visibility ="visible";
			}
			else{
					alert("invalid email");
					document.getElementById('email').value = "";					
					document.getElementById('email').focus();
					document.getElementById('input_ok_email').style.visibility ="hidden";
					return false;
					}
		}//end of the else ....of email validate ...
		return true;
} //end of validateEmail...

//to validate the userName
function validateUserName(){
	var name= document.getElementById('userName').value;
	if(name == ""){
	document.getElementById('userName_error').innerHTML = "User-Name is required";
	document.getElementById('userName').focus();
	}
	else{// if the firstName field is not empty
		var pattern = /^[A-Za-z\d\._]{3,}/;
		if(pattern.test(name)){
			document.getElementById('input_ok_userName').style.visibility ="visible";
			}
			else{
					alert("invalid userName");
					document.getElementById('userName').value = "";
					document.getElementById('userName').focus();
					document.getElementById('input_ok_userName').style.visibility ="hidden";
					return false;
				}
	
		}//end of the else ....of username validate ...
	return true;
} //end of validateUserName...

//function to validate the password
function validatePassword(){
	var password= document.getElementById('pass').value;
	if(password == ""){
	document.getElementById('pass_error').innerHTML = "User-Name is required";
	document.getElementById('pass').focus();
	}
	else{// if the password field is not empty
		if(password.length <5 || !(/[\d]+/.test(password)) )  {
			alert("too weak password");
			document.getElementById('pass').focus();
			document.getElementById('input_ok_pass').style.visibility ="hidden";
		}
		var pattern = /^[A-Za-z\d\W\D]{5,}/;
		if(pattern.test(password)){
			document.getElementById('input_ok_pass').style.visibility ="visible";
			return true;
			}
		return false;
		}//end of the else ....of password validate ...
} //end of validatePassword...

//to check the retypeed-password
function checkRepass(){
var password= document.getElementById('pass').value;
var re_password= document.getElementById('repass').value;

	if(password==re_password)
		document.getElementById('input_ok_repass').style.visibility ="visible";
	else{
		alert("Re-type password didn't matched");
		document.getElementById('repass').value ="";
		document.getElementById('repass').focus();
		document.getElementById('input_ok_repass').style.visibility ="hidden";
		return false;
	}
	return true;
}//end of the function checkRepass...

function checkGender(){
	var gender = document.getElementsByClassName('gen');
	var one_gender_selected = false;
	for(var i =0; i<gender.length; i++){
		if(gender[i].checked){
			one_gender_selected = true;
			break;
		}//end of inner if
	}//end of for loop

	if(one_gender_selected==false){
		alert("Select atleast one Gender");
		return false;
	}
	return true;
}//end of checkGender function...

function checkDate(){
	var DOB = document.getElementsByClassName('dob');
	if((DOB[0].value=='defaultY')||(DOB[1].value=='defaultM')||(DOB[2].value=='defaultD')){
		alert ("birthdate is not choosen");
		return false;
	}
		return true;
}

function checkAgree(){
	var a = checkDate();
	var b = checkGender();
	if(!a || !b)
		document.getElementById('agree').checked = false;

}
</script>

</html>

	
