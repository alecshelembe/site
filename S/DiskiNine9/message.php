<?php include_once("header.php"); ?>
<body class="animate__animated animate__fadeIn">
	<?php
	include_once("functions.php");

	if (isset($_POST['show_all'])) {
		critical_check("show_all");
		critical_check("user");
		critical_check("security_key");
		$user = sanitizeString($_POST['user']);
		$security_key = sanitizeString($_POST['security_key']);
		$show_all = sanitizeString($_POST['show_all']);
		check_if_empty($user);
		check_if_empty($security_key);
		check_if_empty($show_all);
		if ($user == "DiskiNine9admin" && $security_key =="24681357") {
			$table = "`message`";
			show_all($conn,$table);
			echo "Finished";
		} else {
			wrong();
			exit();
		}
	}

	if (isset($_POST['message'])) {
	critical_check("message");
	critical_check("name");
	critical_check("surname");
	critical_check("email");
	critical_check("number");
	$email_info = sanitizeString($_POST['email']);
	$message_info = sanitizeString($_POST['message']);
	$name_info = sanitizeString($_POST['name']);
	$surname_info = sanitizeString($_POST['surname']);
	$number_info = sanitizeString($_POST['number']);
	check_if_empty($email_info);
	check_if_empty($message_info);
	check_if_empty($name_info);
	check_if_empty($surname_info);
	check_if_empty($number_info);
	$table ="`message`";
	new_message($conn,$table,"message",$message_info,"name",$name_info,"surname",$surname_info,"email",$email_info,"number",$number_info);
	$location = "index.php";
	go_to($location);
	}
	?>
	<script type='text/javascript'>

		window.scrollTo({ left: 0, top: document.body.scrollHeight, behavior: "auto" });

	</script>
</body>
</html>