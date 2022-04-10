<?php include_once("header.php"); ?>
<body class="animate__animated animate__fadeIn">
	<header>
		<input type="checkbox" id="menu" hidden>
		<nav>
			<li><a href="#"><img src="imgs/DiskiNine9.png"></a></li>
			<label for="menu"><p>Menu</p></label>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="programmes.php">Programmes</a></li>
				<li><a href="impact.php">Impact</a></li>
				<li><a href="#">Gallery</a></li>
				<li><a href="#">Join Us</a></li>
				<li><a href="#">Connections</a></li>
				<li><a href="contact us.php">Contact Us</a></li>
				<li><a href="#"><button>Donate Now</button></a></li>
			</ul>
		</nav>
	</header>
	<section>
		<div class="box">
			<form action="message.php" method="post">
				E-mail: <input type="text"  class="text" name="email"><br>
				Name: <input type="text"  class="text" name="name"><br>
				Surname: <input type="text"  class="text" name="surname"><br>
				Number: <input type="text"  class="text" name="number"><br>
				Message: <input type="text"  class="text" name="message"><br>
				<input type="submit" class="confirm" name="done" value="Send Message">	
			</form>
		</div>

		<?php include_once("footer.php"); ?>
