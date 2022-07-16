<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Secret page</title>
    <style>
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
    }

?>
</body>
</html>