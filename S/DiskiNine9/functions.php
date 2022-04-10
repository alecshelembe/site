<?php
// sever
$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "messages";

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);

function critical_check($var){
	if (!isset($_POST[$var])) {
		die("$var not found");
	}
}

function message_information_missing() {
	echo("<script type=\"text/javascript\">
		alert(\"Information missing\");
		</script>");
}

function message_saved() {
	echo("<script type=\"text/javascript\">
		alert(\"Thank You.\");
		</script>");
}

function redirect_back() {
	echo("<script type=\"text/javascript\">
		window.history.go(-1);
		</script>");
}

function wrong() {
	echo("<script type=\"text/javascript\">
		alert(\"Try again\");
		window.history.go(-1);
		</script>");
}

function check_if_empty($var) {
	if (empty($var)) {
		message_information_missing();
		redirect_back();
		die();
	}
}

function sanitizeString($var) {    
	if (get_magic_quotes_gpc())

		$var = stripsloashes($var);   
	$var = htmlentities($var);    
	$var = strip_tags($var); 

	if (strlen($var) > 400 ) {
		echo"Charachter break";
		die("fatal error"); 
	}
	$var = addslashes($var);
	return $var; 
}

function password_check($var,$var2) {
	if ($var !== $var2) {
		echo("<script type=\"text/javascript\">
			alert(\"Passwords don't match.\");
			</script>");
		redirect_back();
		die();
	}
}

function go_to($var){

	echo("<script type=\"text/javascript\">
		window.location.replace(\"$var\");
		</script>");
}

function new_message($varconn,$table,$message,$message_info,$name,$name_info,$surname,$surname_info,$email,$email_info,$number,$number_info){

	$query = "INSERT INTO $table ($message,$name,$surname,$email,$number) VALUES ('$message_info','$name_info','$surname_info','$email_info','$number_info');";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	message_saved();

}

function show_all($varconn,$table){

	$query = "SELECT * FROM $table;";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	while ($row = mysqli_fetch_assoc($result))
	{ 
		$email = $row['email'];
		$message = $row['message'];
		$number = $row['number'];
		$surname = $row['surname'];
		$name = $row['name'];
		$date = $row['date'];

	echo "<br>";
	echo "E-mail: $email<br><br>";
	echo "Name: $name<br><br>";
	echo "Surname: $surname<br><br>";
	echo "Number: $number<br><br>";
	echo "Message: $message<br><br>";
	echo "Date_Time: $date<br><br>";
	echo "<br>";
	}
}