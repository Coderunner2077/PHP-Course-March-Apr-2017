<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>TP - page protégée par mot de passe</title>
    <style>
        form {
            position: absolute;
        }
        input[type="text"], input[type="password"] {
            position: absolute;
            left: 110px;
        }
        p {
            color: #ff0000;
            font-size: 3em;
        }
    </style>
</head>
<body>
<?php
if(isset($_POST['login']) AND isset($_POST['psw'])) {
    if($_POST['login'] == 'root' AND $_POST['psw'] == 'kangourou')
        include('secret_page.php');
    elseif($_POST['login'] == '' OR $_POST['psw'] == '')
        echo '<p>Entrez le login et le mot de passe !</p>';
    else
        echo '<p>INVALID LOGIN AND/OR PASSWORD !!!</p>';
} else {
?>

<form method="post" action="formulaire.php">
    <label>LOGIN : </label><input type="text" name="login" />
    <br />
    <label>PASSWORD : </label><input type="password" name="psw" />
    <br />
    <br />
    <input type="submit" value="ACCESS" />
</form>
<?php } ?>
</body>
</html>