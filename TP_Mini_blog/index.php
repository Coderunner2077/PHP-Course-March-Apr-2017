<?php header('Content-type: text/html; charset=iso-8859-1'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css" />
<title>TP blog et commentaires</title>
</head>
<body>
<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

if(!isset($_GET['page'])) {
	$result = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'le %d/%m/%Y à %Hh%imin%ss\') '
			.'creation_date FROM billets ORDER BY id DESC LIMIT 0, 5');
}
else {
	
	$page = htmlspecialchars($_GET['page']);
	
	$index = ($page == 1 || is_nan($page)) ? 0 : (($page - 1) * 5);
	$result = $bdd->query('SELECT COUNT(*) AS nb_billets FROM billets');
	$nb_billets = $result->fetch();
	echo $nb_billets['nb_billets'];
	$nb_to_show = $nb_billets['nb_billets'] - $index;
	$nb_to_show = ($nb_to_show > 5 || is_nan($nb_to_show)) ? 5 : $nb_to_show;
	$result->closeCursor();
	$result = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'le %d/%m/%Y à %Hh%imin%ss\') '
			.'creation_date FROM billets ORDER BY id DESC LIMIT ' . $index . ', '. $nb_to_show);
	//$result->execute(array('index' => $index, 'nb_to_show' => $nb_to_show)); ==> ERREUR, est-ce QUE pour remplacer des colonnes ??
	
}
$page = isset($page) ? $page : 1;
echo '<h1>Mon super blog ! </h1><p>Derniers billets du blog : </p><br />';
while($billets = $result->fetch()) {
	echo '<h3>' . $billets['titre'] . ' ' . $billets['creation_date'] .'</h3>';
	echo '<div class="news"><p>' . $billets['contenu'] . '<p><br /><a href="commentaires.php?id_billet=' . $billets['id'] . '">'
		. 'Commentaires</a></div><br />';	
}
$result->closeCursor();
$result = $bdd->query('SELECT COUNT(*) nb_billets FROM billets');
$nb_billets = $result->fetch();
if($nb_billets['nb_billets'] > 5) {
	$billets_showed = 0;
	echo '<div class="index_pages">';
	while($billets_showed <= $nb_billets['nb_billets']) {
		$billets_showed += 5;
		if($page == ($billets_showed / 5))
			echo $page;
		else
			echo '<a href=\'index.php?page=' . ($billets_showed / 5) . '\'> '  . ($billets_showed / 5) 
			. ' </a>';
	}
	
	echo '</div>';
}
$result->closeCursor();

?>

<form action="traitement_blog.php" method="post">
	<fieldset>
	<legend>Nouveau billet</legend>
	<label for="titreBillet">Titre du billet</label> : <input type="text" name="titreBillet" id="titreBillet" /><br /><br />
	<label for="contenuBillet">Contenu du billet</label> : <textarea name="contenuBillet" id="contenuBillet"></textarea><br />
	<input type="submit" value="Envoyer" />
	</fieldset>
</form>
</body>
</html>