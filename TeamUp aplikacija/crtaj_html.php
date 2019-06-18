<?php

function crtaj_header()
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf8">
		<title>Login</title>
	</head>
	<body>
		<h1>Welcome to the TeamUp website!</h1>
		<br>
	<?php
}


function crtaj_footer()
{
	?>
	</body>
	</html>
	<?php
}


function crtaj_formaZaLogin( $errorMsg = '' )
{
	crtaj_header();
	?>

	<div style="font-size: 25px;">

	<form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
		Username:
		<input type="text" name="username" style="height: 25px; font-size: 20px;"/>
		<br>
		<br>
		Password:
		<input type="password" name="password" style="height: 25px; font-size: 20px;"/>
		<br>
		<br>
		<button type="submit" style="font-size: 20px;">Login!</button>
	</form>

	<p>
		If you don't have an account, you can create it <a href="novi.php">here</a>.
	</p>
	</div>

	<?php
	if( $errorMsg !== '' )
		echo '<p>Greška: ' . $errorMsg . '</p>';

	crtaj_footer();
}


function crtaj_formaZaNovogKorisnika( $errorMsg = '' )
{
	crtaj_header();
	?>

	<div style="font-size: 25px;">

	<form method="post" action="<?php echo htmlentities( $_SERVER["PHP_SELF"] ); ?>">
		Choose a username:
		<input type="text" name="username" style="height: 25px; font-size: 20px;"/>
		<br>
		<br>
		Choose a password:
		<input type="password" name="password" style="height: 25px; font-size: 20px;"/>
		<br>
		<br>
		Your e-mail adress:
		<input type="text" name="email" style="height: 25px; font-size: 20px;"/>
		<br>
		<br>
		<button type="submit" style="font-size: 20px;">Create an account!</button>
	</form>

	<p>
		Go back to the <a href="teamup.php">login site</a>.
	</p>

	</div>

	<?php
	if( $errorMsg !== '' )
		echo '<p>Greška: ' . $errorMsg . '</p>';

	crtaj_footer();
}


function crtaj_zahvalaNaPrijavi( $errorMsg = '' )
{
	crtaj_header();
	?>

	<div style="font-size: 25px;">

	<p>
		Thank you for creating an account. To end the registration, click on the link in the e-mail you recieved from us.
	</p>

	<p>
		Go back to the <a href="teamup.php">login site</a>.
	</p>

	</div>


	<?php
	crtaj_footer();
}


function crtaj_zahvalaNaRegistraciji( $errorMsg = '' )
{
	crtaj_header();
	?>

	<div style="font-size: 25px;">

	<p>
		Your account was successfully created.<br />
		You can login <a href="teamup.php">here</a>.
	</p>

	</div>

	<?php
	crtaj_footer();
}

?>
