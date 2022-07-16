<?php
header('Content-type: text/html; charset=utf8');

if(isset($_POST['login']) && isset($_POST['pass']) && trim(htmlspecialchars($_POST['pass']))){
	//$_POST['login'] = htmlspecialchars($_POST['login']);
	$pass_crypt = crypt($_POST['pass']);
	echo '<p>Ligne à copier/coller dans le .htpasswd : ' . $_POST['login'] . ':' . $pass_crypt .'</p>';
} else {
	?>
	<p>Entrez le login et le mot de passe à crypter : </p>
	<form method="post">
	<p>
	<label for="login">Login</label> : <input type="text" name="login" id="login" /><br />
	<label for="pass">Mot de passe</label> : <input type="password" name="pass" id="pass" /><br /><br />
	<input type="submit" value="Crypter !" />
	</p>
	</form>
	<?php 
}