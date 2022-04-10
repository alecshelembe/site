<?php  
include_once($_SERVER['DOCUMENT_ROOT'] . "/header-page.php");

if (isset($_POST['register'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	// $number = post_check("number");
	// $number = sanitizeString($number);
	$password = post_check("password");
	$password = sanitizeString($password);
	// $name = post_check("name");
	// $name = sanitizeString($name);
	$confirm_password = post_check("confirm_password");
	$confirm_password = sanitizeString($confirm_password);

	confirm_match($password,$confirm_password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	// $active = "";
	check_if_exists($conn,$dbname,'users','email',$email);
	$verification_code = rand(1000,9999);
	insert_info($conn,$dbname,'users','email',$email);
	update_info($conn,$dbname,'users','name','email',$name,$email);
	// update_info($conn,$dbname,'users','number','email',$number,$email);
	update_info($conn,$dbname,'users','last_email_verification_code','email',$verification_code,$email);
	// update_info($conn,$dbname,'users','verificated','email','no',$email);
	// update_info($conn,$dbname,'users','email','email',$email,$email);
	update_info($conn,$dbname,'users','password','email',$password,$email);
	alert('Account created sucessfully you may login');

	///////////////////////////////////////////////////////////////

	// send_email('kpautoreplyservice@gmail.com',"$email","$name",'Kingproteas registratioin',"Thank you for registering to Kingproteas. Click here to verify your account. Your verification code is $verification_code <a href='https://cunning-quota.000webhostapp.com/verification-page.php'>Verify me</a>");

	///////////////////////////////////////////////////////////////
	redirect_back();
}


if (isset($_POST['login'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	$password = post_check("password");
	$password = sanitizeString($password);
	pair_for_login($conn,'users',"email",$email,"password",$password);
	redirect_back();

}

if (isset($_POST['logout'])) {
	logout();
	$location = "https://cunning-quota.000webhostapp.com/index.php";
	alert("You have logged out");
	go_to($location);
}

if (isset($_POST['forgot_password'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	$last_email_verification_code = return_info($conn,'users','last_email_verification_code','email',$email);
	send_email('kpautoreplyservice@gmail.com',"$email","Client",'Kingproteas password reset',"Did you forget your password? Click here to reset your password. Your reset code is $last_email_verification_code <a href='https://cunning-quota.000webhostapp.com/reset-password.php'>Reset password</a>");
	alert('Follow the instructions sent to your email address to log in');
	$location = "https://cunning-quota.000webhostapp.com/reset-password.php";
	go_to($location);
	
}

if (isset($_POST['reset_password'])) {
	$email = post_check("email");
	$email = sanitizeString($email);
	$code = post_check("code");
	$code = sanitizeString($code);
	$password = post_check("password");
	$password = sanitizeString($password);
	$confirm_password = post_check("confirm_password");
	$confirm_password = sanitizeString($confirm_password);
	confirm_match($password,$confirm_password);
	$last_email_verification_code = return_info($conn,'users','last_email_verification_code','email',$email);

	if ($last_email_verification_code == $code) {
	$password = password_hash($password, PASSWORD_DEFAULT);
	update_info($conn,$dbname,'users','password','email',$password,$email);
	} else{
		alert("Code's do not match");
		redirect_back();
	}
	send_email('kpautoreplyservice@gmail.com',"$email","Client",'Kingproteas password reset',"Your password was reset sucessfully. <a href='https://cunning-quota.000webhostapp.com/'>Kingproteas</a>");
	alert('Password reset you may now login.');
	$location = "https://cunning-quota.000webhostapp.com/";
	go_to($location);
}

if (isset($_POST['verify_me'])) {
	$date = "Email verified on " . date("Y-m-d @ h:i:s a");
	$email = post_check("email");
	$email = sanitizeString($email);
	$code = post_check("code");
	$code = sanitizeString($code);
	$last_email_verification_code = return_info($conn,'users','last_email_verification_code','email',$email);

	if ($last_email_verification_code == $code) {
	update_info($conn,$dbname,'users','email_verified','email',$date,$email);
	} else{
		alert("Code's do not match");
		redirect_back();
	}

	alert("Thank you. Your email has been verified.");
	$location = "https://cunning-quota.000webhostapp.com/";
	go_to($location);
}

if (isset($_POST['new_product'])) {
	$session_details = check_login_email();

	if ($session_details[0] == 'none') {
		$location = "https://cunning-quota.000webhostapp.com/index.php";
		go_to($location);
	} 

	$id = rand(1000,9999);

	$name = post_check("name");
	$name = sanitizeString($name);
	$price = post_check("price");
	$price = sanitizeString($price);
	$description = post_check("description");
	$description = sanitizeString($description);
	$store = post_check("store");
	$store = sanitizeString($store);

	if (!is_numeric($price)) {
		alert('Price must only contain numbers');
		redirect_back();
	}

	$original_file_name = $_FILES['image']['name'];
	$file_type = $_FILES['image']['type'];
	$image = sanitizeString($original_file_name);
	$file_type = sanitizeString($file_type);
	$file_size = $_FILES['image']['size']; 	
	$file_tem_loc = $_FILES['image']['tmp_name'];


	$image = "$name $id";

	check_if_exists($conn,$dbname,"products",'id',$id);

	$dir = "product images";

	$image = image_process($conn,$dir,$image,$file_type,$file_size,$file_tem_loc);

	insert_info($conn,$dbname,'products','id',$id);
	update_info($conn,$dbname,'products','email','id',$session_details[0],$id);
	update_info($conn,$dbname,'products','name','id',$name,$id);
	update_info($conn,$dbname,'products','store','id',$store,$id);
	update_info($conn,$dbname,'products','price','id',$price,$id);
	update_info($conn,$dbname,'products','description','id',$description,$id);
	update_info($conn,$dbname,'products','image','id',$image,$id);

	alert("Upload sucessful.");

	send_email('kpautoreplyservice@gmail.com',"$session_details[0]","$session_details[1]",'New upload',"New upload. product name: \"$name\" <br> price: \"$price\" <br> description: \"$description\"<br> created on
		<a href='https://cunning-quota.000webhostapp.com/index.php'>Kingproteas</a>
		");

	$location ="https://cunning-quota.000webhostapp.com/store-page.php";
	go_to($location);
}

alert('Please return and try again');
$location = "https://cunning-quota.000webhostapp.com/index.php";
go_to($location);
?>