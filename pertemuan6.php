  <?php
	$username = "user";
	$password = "user123";

	if ($username == "admin" && $password == "qwerty") {
		echo "Username dan password sesuai, hak akses diberikan";
		echo "<script>alert('Username dan password sesuai, hak akses diberikan')</script>";
		#
	} else if ($username != "admin" && $password == "qwerty") {
		echo "Username tidak sesuai, password sesuai!";
		echo "<script>alert('Username tidak sesuai, password sesuai!')</script>";
		#
	} else if ($username == "admin" && $password != "qwerty") {
		echo "Username sesuai, password tidak sesuai";
		echo "<script>alert('Username sesuai, password tidak sesuai')</script>";
		#
	} else {
		echo "Username dan Password tidak sesuai!";
		echo "<script>alert('Username dan Password tidak sesuai!')</script>";
	}
	?>