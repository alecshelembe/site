
<!DOCTYPE html>
<html>
<head>
	<title>Social Donars</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<a href="index.html"><h1 id="top">Social Donars</h1></a>
			<a href="index.html"><li class="white">Home page</li></a>
		</ul>
	</nav>

	<center>

			<div class="page">

			<img src="https://image.freepik.com/free-vector/red-blood-drop_23-2147495573.jpg" style="width: 50px;">
			<h1 id="register.html">Welcome to Social Donars</h1>
			<p>Please complete the form below to register</p>
			<button class='button' id="start-camera">Start Camera</button>
		<video id="video" width="320" height="240" autoplay></video>
		<button class='button' id="click-photo">Take Photo</button>
		<canvas id="canvas" width="320" height="240"></canvas>

			<form action="load-page.php" method="GET">
				<input type="text" class="s_sign_up" name="email" placeholder="Email">
				<input type="text" class="s_sign_up" name="name" placeholder="Name">
				<input type="text" class="s_sign_up" name="surname" placeholder="Surname">
				<input type="text" class="s_sign_up" name="number" placeholder="Number">
				<input type="text" class="s_sign_up" name="address" placeholder="Address">
				<input type="text" class="s_sign_up" name="password" placeholder="Password">
				<input type="text" class="s_sign_up" name="confirm_password" placeholder="Confirm Password">
				<label>Male</label><input type="radio" name="gender">
				<label>Female</label><input type="radio" name="gender">
				<h2>Course</h2>
				<select name="course">
					<option value="web">Network</option>
					<option value="Net">Website</option>
				</select>
			  	</ul>
			  	<p>Or upload a picture</p>
				<input type='file' name='img' class='button' accept='image/*'>
				<input type="submit" class="b_button" name="register" value="Register">
			</form>

		</div>

<script type="text/javascript">
	let camera_button = document.querySelector("#start-camera");
let video = document.querySelector("#video");
let click_button = document.querySelector("#click-photo");
let canvas = document.querySelector("#canvas");

camera_button.addEventListener('click', async function() {
   	let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
	video.srcObject = stream;
});

click_button.addEventListener('click', function() {
   	canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
   	let image_data_url = canvas.toDataURL('image/jpeg');

   	// data url of the image
   	console.log(image_data_url);
});
</script>
		<p>&copy; Social Donars</p>
	</body>
</center>
</html>