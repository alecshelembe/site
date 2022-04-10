<?php
// sever
// $dbsevername = "localhost";
// $dbusername = "id14954189_scibonouser";
// $dbpassword = "*}Dlws58X-)J|F{K";
// $dbname = "id14954189_scibono";

$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "id14954189_scibono";

 // 6jk/4ZSBR[u8x$@E

$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);


function stop(){
	die();
}

function sanitizeString($var) {    
	if (get_magic_quotes_gpc())

		$var = stripsloashes($var);   
	$var = htmlentities($var);    
	$var = strip_tags($var); 

	if (strlen($var) > 400 ) {
		stop("Charachter break fatal error"); 
	}
	$var = addslashes($var);
	return $var; 
}


function go_to($var){

	echo("<script type=\"text/javascript\">
		window.location.replace(\"$var\");
		</script>");
	stop();
}

function redirect_back() {
	echo("<script type=\"text/javascript\">
		window.history.go(-1);
		</script>");
	stop();
}

function reload() {
	echo("<script type=\"text/javascript\">
		location.reload();
		</script>");
}

function check_if_empty($var) {
	if (empty($var)) {
		alert("$var input left blank.");
		redirect_back();
		stop();
	}
}


function alert($var) {
	echo("<script type=\"text/javascript\">
		alert(\"$var\");
		</script>");
}

function logout() {
	session_destroy();
}

function post_check($var){
	if (!isset($_POST[$var])) {
		alert("$var input left blank.");
		redirect_back();
	}
	$var = sanitizeString($_POST[$var]);
	check_if_empty($var);
	return $var;
}

function get_check($var){
	if (!isset($_GET[$var])) {
		alert("$var input left blank.");
		redirect_back();
	}
	$var = sanitizeString($_GET[$var]);
	check_if_empty($var);
	return $var;
}

function confirm_match($var,$var2) {
	if ($var === $var2) {
		//check
	} else {
		alert("Password do not match");
		redirect_back();
	}
}

function check_login_email(){

	if (isset($_SESSION['email'])) {
		$email = $_SESSION['email'];
		$name = $_SESSION['name'];
		$number = $_SESSION['number'];
		# code...
	} else {
		$email =  'none';
		$name = 'none';
		$number = 'none';

	}

		// $location = $_SERVER['DOCUMENT_ROOT'] . "/login page.php";
		// alert("Please login to continue");
		// go_to($location);

	$session_details = array($email, $name, $number);
	return ($session_details);	
}

function check_if_exists($varconn,$dbname,$table,$row_title,$info){

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row > 0) {

		alert("The $info credential already exist");
		redirect_back();
		stop();

	}
}

function insert_info($varconn,$dbname,$table,$row_title,$info){
	
	$query = "INSERT INTO `$table` (`$row_title`) VALUES ('$info');";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// stop("$query");

}


function update_info($varconn,$dbname,$table,$row_title,$identifier_row,$info,$identifier_info){
	
	$query = "UPDATE `$table` SET `$row_title` = '$info' WHERE `$table`.`$identifier_row` = '$identifier_info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// stop("$query");
}

function pair_for_login($varconn,$table,$row_title,$info,$security_key,$security_key_info) {

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";
	
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
	
	//echo "$query";
	// stop();

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert("No account is registerd to this email");
		redirect_back();
	}

	$email_verified = return_info($varconn,'users','email_verified',$row_title,$info);
	if ($email_verified == null) {
		alert('Please verify your email to login.');
		redirect_back();
	}

	$account_status = "";
	$security_key = "";
	
	while ($row = mysqli_fetch_assoc($result)) {
		$account_status = $row['account_status'];
		$security_key = $row['password'];
	}
	
	if ($account_status == 'not active') {
		alert('Account not active');
		redirect_back();
	}

	if (password_verify($security_key_info, $security_key)){
		$security_key = $security_key_info;
	}
	
	if ($security_key !== $security_key_info ){
		alert("Password incorrect");
		redirect_back();
		stop();
	}

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));


	while ($row = mysqli_fetch_assoc($result))
	{ 
		$email = $_SESSION['email'] = $row['email'];
		$name = $_SESSION['name'] = $row['name'];
		$number = $_SESSION['number'] = $row['number'];
	}

	$date = "Date " . date("Y-m-d @ h:i:s a");

	update_info($varconn,'','users','last_login','email',$date,$email);

	alert("You have been logged in");

	// https://github.com/alecshelembe

}

function return_info($varconn,$table,$row_title,$identifier_row,$identifier_info){
	
	$query = "SELECT `$row_title` FROM `$table` WHERE `$table`.`$identifier_row` = '$identifier_info';";
	
	$result = mysqli_query($varconn, $query);
	
	// echo("$query");
	// stop();
	while ($row = mysqli_fetch_assoc($result)) {
		$value = $row["$row_title"];

	}

	return $value;
}


function remove($varconn,$dbname,$table,$row_title,$info){

	$query = "DELETE FROM `$table` WHERE `$table`.`$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

}

function show_products_images($varconn,$dbname,$table,$status){

	$query = "SELECT `image` FROM `$table` WHERE `status` = '$status';";

	$result = mysqli_query($varconn, $query);
	
	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert('Nothing here.');
		redirect_back();
	} else {

		while ($row = mysqli_fetch_assoc($result)) {

			$row = $row["image"];

			echo "
			<td>
			<div class='product_image' style='background-image:url(\"product images/$row\");'>
			</div>
			</td>
			";

		}

	}
}

function show_products_id($varconn,$dbname,$table,$status){

	$query = "SELECT `id` FROM `$table` WHERE `status` = '$status';";

	$result = mysqli_query($varconn, $query);
	
	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert('Nothing here.');
		redirect_back();
	} else {

		while ($row = mysqli_fetch_assoc($result)) {

			$row = $row["id"];

			echo "
			<td class='grey small'>

			<input type='text' value=\"https://intown-lubrication.000webhostapp.com/store-page.php?id=$row\" id=\"$row\" style='position:absolute;left:-1000px;top:-1000px;'>
			<a onclick='copy($row)'>copy link</a>

			<input type='button' onclick='add_to_cart(\"$row\")' value='Add to cart'>
			</td>
			";

		}

	}
}

function show_products($varconn,$dbname,$table,$status){

	$query = "SELECT * FROM `$table` WHERE `status` = '$status';";

	$result = mysqli_query($varconn, $query);
	
	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert('Nothing here.');
		redirect_back();
	} else {

		while ($row = mysqli_fetch_assoc($result)) {

			$name = $row['name'];
			$email = $row['email'];
			$description = $row['description'];
			$price = $row['price'];
			$id = $row['id'];
			$store = $row['store'];
			$image = $row['image'];

			echo "
			<table class='product_table design'>
			<tr>
				<td>

			<table class='table_one'>
			<tr>
				<td class='center'><img src='product images/$image'>
				</td>
			</tr>
			</table>

			<table class='table_two'>
				<tr class='name'><td>$name</td></tr>
				<tr class='price'><td>R $price</td></tr>
				<tr class='description'><td>$description</td></tr>
				<tr><td class='grey small'>
				<input type='text' value=\"https://intown-lubrication.000webhostapp.com/store-page.php?id=$id\" id=\"$id\" style='position:absolute;left:-1000px;top:-1000px;'>
				<a onclick='copy($id)'>(copy link) </a>
				<a onclick='window.location.href=\"https://intown-lubrication.000webhostapp.com/store-page.php?id=$id\";'>Open</a>
				</td></tr></table>
				</td></tr></table>";
			echo "<div style='clear: both;'></div>";
		}
	}
}

function show_one_product($varconn,$dbname,$table,$status,$id){

	$query = "SELECT * FROM `$table` WHERE `status` = '$status' and `id` = '$id';";
	
	// echo"$query"; 
	// stop();

	$result = mysqli_query($varconn, $query);

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert('Nothing here.');
		redirect_back();
	} else {


		while ($row = mysqli_fetch_assoc($result)) {
			$name = $row['name'];
			$email = $row['email'];
			$description = $row['description'];
			$price = $row['price'];
			$id = $row['id'];
			$store = $row['store'];
			$image = $row['image'];

		}
		echo "
		<table class='product_table design'>
			<tr>
				<td>

			<table class='table_one'>
			<tr>
				<td class='center'><img src='product images/$image'>
				</td>
			</tr>
			</table>

			<table class='table_two'>
				<tr class='name'><td>$name</td></tr>
				<tr class='price'><td>R $price</td></tr>
				<tr class='description'><td>$description</td></tr>
				<tr><td class='grey small'>
				<input type='text' value=\"https://intown-lubrication.000webhostapp.com/store-page.php?id=$id\" id=\"$id\" style='position:absolute;left:-1000px;top:-1000px;'>
				<a onclick='copy($id)'>(copy link) </a>
				</td></tr></table>
				</td></tr></table>
				<br>
				<br>
				<br>
				";
	}
}

function checkout($varconn,$dbname,$table,$status,$id){

	$query = "SELECT * FROM `$table` WHERE `status` = '$status' and `id` = '$id';";
	
	// echo"$query"; 
	// stop();

	$result = mysqli_query($varconn, $query);

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		alert('Nothing here.');
		redirect_back();
	} else {


		while ($row = mysqli_fetch_assoc($result)) {
			$name = $row['name'];
			$email = $row['email'];
			$description = $row['description'];
			$price = $row['price'];
			$id = $row['id'];
			$store = $row['store'];
			$image = $row['image'];

		}
		echo "
		<center>
		<table border='0' class='product_table one_product'>
		<tr>
		</tr>
		<tr>
		<td><img src='product images/$image'></td>
		</tr>
		<tr class='product_name'><td>$name</td></tr>
		<td class='grey small'>
		<input type='text' value=\"https://intown-lubrication.000webhostapp.com/store%20page.php?id=$id\" id=\"$id\" style='position:absolute;left:-1000px;top:-1000px;'>
		<a onclick='copy($id)' class='grey small'>copy link</a>
		</td>
		<tr class='product_price'><td>R $price</td></tr>
		<tr>
		<td>
		<label for='Quantity'>Quantity?</label>
		<select name='Quantity' onclick='calculate_price($price * (this.value))'>
		<option value='1'>1</option>
		<option value='2'>2</option>
		<option value='3'>3</option>
		<option value='4'>4</option>
		<option value='6'>6</option>
		<option value='8'>8</option>
		<option value='10'>10</option>
		</select>
		</td>
		</tr>
		</table>
		</center>
		";
	}
}

function image_process($varconn,$dir,$image,$file_type,$file_size,$file_tem_loc){


	if( is_dir($dir) === false )
	{
		mkdir($dir);
	}
	switch($file_type)
	{
		case 'image/jpeg':  $ext = 'jpg';   break;
		case 'image/gif':   $ext = 'gif';   break;
		case 'image/png':   $ext = 'png';   break;
		case 'image/tiff':  $ext = 'tiff';  break;	
		default:       
		alert("$file_type is not a valid image file $image unallowed");
		redirect_back();
	} 

	if ($ext)
	{	

		$file_store = "$dir/$image";

		move_uploaded_file($file_tem_loc, $file_store);

		return "$image";

	}
	else
	{
		alert("Something went wrong with the upload. Try a different one.");
		redirect_back();

	}

}

function send_email($sender_email,$reciever_email,$reciever_name,$subject,$body){
	////////////////////////////////////////////////////////////////

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = "$sender_email";                     //SMTP username
    $mail->Password   = '1!Kingproteas1!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom("$sender_email", 'Noreply');
    $mail->addAddress("$reciever_email");     //Add a recipient
    $mail->addAddress("$sender_email");               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "$subject";
    $mail->Body    = "$body";
    $mail->AltBody = "$body";

    $mail->send();
    alert("We sent you an email, please see your inbox");
} catch (Exception $e) {
	alert("Oops. Something went wrong. You might not recieve an email");
}

	///////////////////////////////////////////////////////////////
}
