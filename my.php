<?php
include '_api_/init.php';

if(isset($_POST['submy'])) {
	if(
		!empty($_POST['mail'])
		&&
		!empty($_POST['password'])
	) {
		$mail = htmlentities($_POST['mail']);
		$password = htmlentities($_POST['password']);

		$reqUser = new sql_prep('prepare',
			'SELECT * FROM users WHERE mail_ = ?',
			's',
			[$mail]
		);
		$reqUser=$reqUser->return_data;

		if($reqUser->num_rows == 1) {
			$getUser = $reqUser->fetch_assoc();

			if(password_verify($password, $getUser['password_'])) {
				echo 'login';
				setcookie("user_ID_to_connect", $getUser['ID'], time() + 3600 * 24 * 31, "/", "127.0.0.1", false, true);
		        echo '<script language="Javascript">document.location.replace("/my/");</script>';
			}
		}
	}
}
?>
<form method="post">
	<input type="mail" name="mail" placeholder="Mail">
	<input type="password" name="password" placeholder="Mot de Passe">
	<input type="submit" name="submy">
</form>