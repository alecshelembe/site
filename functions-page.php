<?php
session_start();

$dbsevername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "finetrade";

// sever
// $dbsevername = "localhost";
// $dbusername = "finetrad_shelemz";
// $dbpassword = "RD9i-fo^kgr=";
// $dbname = "finetrad_wp990";

// $store_email = 'alecshelembe@gmail.com';
// $store_name = 'finetrades';
// $TnC_link = "https://finetrades.co.za/software-agreement.pdf";
// $domain = 'https://' . $_SERVER['HTTP_HOST'];


$conn = mysqli_connect($dbsevername, $dbusername, $dbpassword);

mysqli_select_db($conn, $dbname);


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;


// require_once $_SERVER['DOCUMENT_ROOT'] . "/PHPMailer/src/PHPMailer.php";
// require_once $_SERVER['DOCUMENT_ROOT'] . "/PHPMailer/src/SMTP.php";
// require_once $_SERVER['DOCUMENT_ROOT'] . "/PHPMailer/src/Exception.php";

function stop()
{
	die();
}

function alert($var)
{
	echo ("<script type=\"text/javascript\">
	alert(\"$var\");
	</script>");
}

function go_to($var){

	echo("<p style='display:none'><script type=\"text/javascript\">
		window.location.replace(\"$var\");
		</script></p>");
	stop();
}

function redirect_back()
{
	echo ("<script type=\"text/javascript\">
	window.history.go(-1);
	</script>");
	stop();
}

function reload()
{
	echo ("<script type=\"text/javascript\">
	location.reload();
	</script>");
}

function check_if_empty($var)
{
	if (empty($var)) {
		alert("$var input left blank.");
		redirect_back();
	}
}

function check_if_empty_same_page($var, $name)
{
	if (empty($var)) {
		echo ("$name input left blank.");
		stop();
	}
}

function sanitizeString($var)
{
	// $var = stripsloashes($var);   
	// $var = htmlentities($var);  
	$var = trim(htmlspecialchars($var));

	
	if (strlen($var) > 10000) {
		alert("Character break 10000");
		redirect_back();
	}

	// // $var = strip_tags($var); 

	// if (strlen($var) > 10000 ) {
	// 	alert("Charachter break fatal error"); 
	// 	redirect_back();
	// }
	// // $var = addslashes($var);
	return $var;
}

function get_number($var)
{
	// $number = preg_replace('/\D+/', '', "$var");
	return $var;
}

function post_check_same_page($var)
{

	$value = $_POST[$var];

	sanitizeString($value);

	if ($value == null) {
		echo ("$var input left blank.");
		stop();
	}

	return $value;
}

function get_check_same_page($var)
{

	$value = $_GET[$var];

	sanitizeString($value);

	if ($value == null) {
		echo ("$var input left blank.");
		stop();
	}

	return $value;
}

function time_redirect($var, $time)
{

	echo ("<script type=\"text/javascript\">
	setTimeout(function () {
		window.location.href = '$var';
		}, $time); 
		</script>");
}

function post_check($var)
{

	// if (!isset($_POST[$var])) {
	// 	alert("$var input left blank.");
	// 	redirect_back();
	// }

	$value = $_POST[$var];

	sanitizeString($value);

	if ($value == null) {
		echo ("$var input left blank.");
		stop();
	}

	return $value;
}

function get_check($var)
{
	$value = $_GET[$var];

	sanitizeString($value);

	if ($value == null) {
		echo ("$var input left blank.");
		stop();
	}

	return $value;
}

function sign_out()
{
	session_destroy();
}


function confirm_match_same_page($var, $var2)
{
	if ($var === $var2) {
		//check
	} else {
		echo ("Passwords do not match");
        stop();
	}
}

function get_ip()
{

	//whether ip is from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}
	//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	//whether ip is from remote address
	else {
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	return $ip_address;
}

function check_login_email()
{

	if (isset($_SESSION['email'])) {
		$email = $_SESSION['email'];
		$name = $_SESSION['name'];
		$number = $_SESSION['number'];
		$account_status = $_SESSION['account_status'];
		# code...
	} else {
		$email =  'none';
		$name = 'none';
		$number = 'none';
		$account_status = 'none';
	}

	$session_details = array($email, $name, $number);
	return ($session_details);
}


function get_device()
{
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function check_if_exists($varconn, $dbname, $table, $row_title, $info,$message)
{

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row > 0) {

		echo ("$info$message");
		// redirect_back();
		stop();
	}
}

function check_must_exist($varconn, $dbname, $table, $row_title, $info)
{

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row == 0) {

		echo ("The $info credential does not exist");
		// redirect_back();
		stop();
	}
}

function check_if_exists_same_page($varconn, $dbname, $table, $row_title, $info,$message)
{

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row > 0) {
		echo ("$info$message");
		stop();
	}
}


function check_if_not_exists_same_page($varconn, $dbname, $table, $row_title, $info,$message)
{

	$query = "SELECT `$row_title` FROM `$table` WHERE `$row_title` = '$info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("$info$message");
		stop();
	}
}


function insert_info($varconn, $dbname, $table, $row_title, $info)
{

	$query = "INSERT INTO `$table` (`$row_title`) VALUES ('$info');";

	$result = mysqli_query($varconn, $query);

	// stop("$query");

}

function pair_for_login($varconn, $table, $row_title, $info, $security_key, $security_key_info)
{

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// echo "$query";
	// stop();

	$row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("No account is registerd to $info");
		stop();
	}

	// $verified = return_info($varconn,'users','verified',$row_title,$info);

	// if ($verified == 'no') {
	// 	alert('Please verify your email.');
	// 	$location = "https://kingwebsites.co.za/verification-page.php";
	// 	go_to($location);
	// }

	$account_statues = "";
	$security_key = "";

	while ($row = mysqli_fetch_assoc($result)) {
		$account_statues = $row['account_statues'];
		$security_key = $row['password'];
	}

	if ($account_statues == 'no') {
		echo ('Account not active please contact administrator');
		stop();
	}

	// returning true carring on...
	if (password_verify($security_key_info, $security_key)) {
		// echo 'Password is valid!';
	} else {
		echo ("Password Incorrect");
		stop();
	}

	$query = "SELECT * FROM `$table` WHERE `$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));


	while ($row = mysqli_fetch_assoc($result)) {
		$email = $_SESSION['email'] = $row['email'];
		$name = $_SESSION['name'] = $row['name'];
		$number = $_SESSION['number'] = $row['number'];
		$id = $_SESSION['id'] = $row['id'];
	}

	
	// https://github.com/alecshelembe

}


function select_all($varconn, $dbname, $table, $row_title)
{

	$query = "SELECT `$row_title` FROM `$table`;";

	// echo("$query");
	
	$result = mysqli_query($varconn, $query);

	$items = array();
      
	while ($row = mysqli_fetch_assoc($result)) {
		$value = $row[$row_title];
		array_push($items,$value);
	}
	
	return $items;


}

function update_info($varconn, $dbname, $table, $row_title, $identifier_row, $info, $identifier_info)
{

	$query = "UPDATE `$table` SET `$row_title` = '$info' WHERE `$table`.`$identifier_row` = '$identifier_info';";

	// echo"$query"; 
	// stop("$query");

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

	// stop("$query");
}

function return_info($varconn, $table, $row_title, $identifier_row, $identifier_info)
{

	$query = "SELECT `$row_title` FROM `$table` WHERE `$table`.`$identifier_row` = '$identifier_info';";

	$result = mysqli_query($varconn, $query);

	// echo("$query");
	// stop();
	while ($row = mysqli_fetch_assoc($result)) {
		$value = $row["$row_title"];
	}

	return $value;
}

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}


function image_process($varconn,$dir,$image,$file_type,$file_size,$file_tem_loc){

    if (is_dir($dir) === false){
        mkdir($dir);
    }
	switch($file_type)
	{
        case 'image/jpeg':  $ext = 'jpg';   break;
		case 'image/gif':   $ext = 'gif';   break;
		case 'image/png':   $ext = 'png';   break;
		case 'image/tiff':  $ext = 'tiff';  break;	
		case 'image/jfif':  $ext = 'jfif';  break;	
		default:       
		alert("The image with file type $file_type is not allowed. The system will proceed.");
		$ext = null;
		break;
		// redirect_back();
	} 

	if($file_size > 2097152 ){
		alert('This image is too large, please choose one less than 2 MB. The system will proceed.');
	}
    
	if ($ext){	
        $image = "$image".'.'."$ext";
		$file_store = "$dir/$image";
		move_uploaded_file($file_tem_loc, $file_store);
		return "$image";
    } else {
		alert("Something went wrong with the upload. Try a different one.");
		// redirect_back();
    }

}

function remove($varconn, $dbname, $table, $row_title, $info)
{

	$query = "DELETE FROM `$table` WHERE `$table`.`$row_title` = '$info';";

	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));
}

function show_one_product($varconn, $dbname, $table, $status, $id)
{
	include($_SERVER['DOCUMENT_ROOT'] . "/loops/show-one-product.php");
}

function send_email($sender_email, $reciever_email, $reciever_name, $subject, $body)
{
	////////////////////////////////////////////////////////////////

	//Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'mail.finetrades.co.za';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = "$sender_email";                     //SMTP username
		$mail->Password   = '';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//TCP port to connect to, use 587 for `PHPMailer::ENCRYPTION_STARTTLS` above

		//Recipients
		$mail->setFrom("$sender_email", 'Noreply');
		$mail->addAddress("$reciever_email");     //Add a recipient
		// $mail->addAddress("$sender_email");               //Name is optional
		// $mail->addReplyTo('admin@finetrades.co.za', "$reciever_name");
		// $mail->addBCC('noreply@finetrades.co.za');
		$mail->addCC('admin@finetrades.co.za');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//Add attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = "$subject";
		$mail->Body    = "$body";
		$mail->AltBody = "$body";

		$mail->send();

	} catch (Exception $e) {
		// echo"$e";
		alert("Oops. Something went wrong with sending you the email. Please contact support");
		stop();
	}

	///////////////////////////////////////////////////////////////
}

function send_to_store_email($sender_email, $reciever_email, $reciever_name, $subject, $body)
{
//  nothing happens remove function from code
// A5BNXF]VS]vv
}

function show_products($varconn,$dbname,$table,$row_title,$order_title,$end_num){

	$query = "SELECT `$row_title`,`$order_title` FROM `$table` ORDER BY `$order_title` DESC LIMIT $end_num;";
	// exit($query);
            
	$result = mysqli_query($varconn, $query) or die(mysqli_error($varconn));

    $row = mysqli_num_rows($result);
    if ($row == 0) {
    echo "Nothing here right now";
    } else {

      $i = 1;

	  $a = array();
      
      while ($row = mysqli_fetch_assoc($result)) {

            $value = $row[$row_title];
            // $id = $row['id'];
            // $product_price = $row['product_price'];
            // $product_about = $row['product_about'];
            // $product_other_details = $row['product_other_details'];
            // $image = $row['image'];
            // $image_2 = $row['image_2'];
            // $image_3 = $row['image_3'];
            // $product_cash_pay = $row['product_cash_pay'];
            // $product_list_address = $row['product_list_address'];
            // $product_address_1 = $row['product_address_1'];
            // $product_address_2 = $row['product_address_2'];
            // $product_address_city = $row['product_address_city'];
            // $product_address_state = $row['product_address_state'];
            // $product_zip = $row['product_zip'];
            // $product_individual_or_business_address = $row['product_individual_or_business_address'];
            // $product_require_deposit = $row['product_require_deposit'];
            // $product_deposit_amount = $row['product_deposit_amount'];
            // $product_auto_market = $row['product_auto_market'];
            // $product_market_budget = $row['product_market_budget'];
            // $product_show_whatsapp = $row['product_show_whatsapp'];
            // $product_show_contact = $row['product_show_contact'];
            // $status = $row['status'];
            // $seller_name = $row['seller_name'];
            // $seller_email = $row['seller_email'];
            // $rank = $row['rank'];
            
            // $spec = $id . rand(1, 9);
            // $spec2 = $id . rand(10, 19);
            // $spec3 = $id.rand(20,29);

			$i ++;
            
			array_push($a,$value);
            
        }
		return $a;
    }
}
