<?php header('Content-type: text/html; charset=iso-8859-1'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="iso-8859-1" />
<link rel="stylesheet" href="style.css" />
<title>Les commentaires</title>
</head>
<body>
<h1>Mon super blog null</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>
<?php
	if(isset($_GET['id_billet'])) {
		$id_billet = htmlspecialchars($_GET['id_billet']);
		try {
			$bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root', 
					array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
		}
		
		$req = $bdd->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, \'le %d/%m/%Y à %Hh%imin%ss\') creation_date FROM'
				.' billets WHERE id=?');
		$req->execute(array($id_billet));
		$billets = $req->fetch();
		
		if($billets) {
			echo '<h3>' . $billets['titre'] . '</h3>';
			echo '<div class="news"><p>' . $billets['contenu'] . '</p></div><br />';
			echo '<h2>Commentaires</h2>';
			$req->closeCursor();
			$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'le %d/%m/%Y à %Hh%imin%ss\')'
					.' commentaire_date FROM commentaires WHERE id_billet=?');
			$req->execute(array($id_billet));
			while($commentaires = $req->fetch()) {
				echo '<div><strong>' . $commentaires['auteur'] . '</strong> ' . $commentaires['commentaire_date'] . '</div>';
				echo '<p>' . $commentaires['commentaire'] . '</p>';
			}
			$req->closeCursor();
			
			?>
			<form method="post" action="traitement_blog.php">
			<fieldset><legend>Laisser un commentraire</legend>
			<input type="hidden" name="id_billet" value="<?php echo $id_billet; ?>" />
			<label for="author">Votre nom</label> : <input type="text" name="author" id="author" /><br /><br />
			<label for="comment">Votre commentaire</label> : <textarea name="comment" id="comment"></textarea><br />
			<input type="submit" value="Envoyer" />
			</fieldset>
			</form>
			<?php 
		}
		
		
	}
?>
</body>
</html>
