<html>
<body>
	<form>
Name: 		<input type="text" name="name" placeholder="enter name" id="name"/>
		<span id= "display"></span>
		<br/>
		<input type="submit" value="check" onclick="validate()"/>
	</form>
	
<script type="text/javascript" language="javascript">
function validate(){
	var name= document.getElementById('first').value;
	var pattern = [a-z];
	if(pattern.test(name)){
		document.getElementById('first_name_error').innerHTML = "okay ";
	return;
	}
	else{
		document.getElementById('first_name_error').innerHTML = "error format";
	return;
	}
return;
}
</script>
</body>
</html>