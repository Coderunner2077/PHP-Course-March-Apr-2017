<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

// On s'amuse à créer quelques variables de session dans $_SESSION
$_SESSION['prenom'] = 'Jean';
$_SESSION['nom'] = 'Dumont';
$_SESSION['age'] = 25;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Exemple de session</title>
</head>
<body>
<p>Hello <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . '. You\'re '. $_SESSION['age'] . ' years old'; ?> </p>
<p>
    <a href="exemple1bis.php">Lien vers ma page exemple1bis.php</a><br />
    <a href="monscript.php">Lien vers monscript.php</a>
</p>
</body>
</html>
