<?php
if(isset($_POST['titreBillet']) AND isset($_POST['contenuBillet']) 
		AND trim(htmlspecialchars($_POST['titreBillet'])) AND trim(htmlspecialchars($_POST['contenuBillet'])) !='') {
			 
			$titreBillet = htmlspecialchars($_POST['titreBillet']);
			$contenuBillet = htmlspecialchars($_POST['contenuBillet']);
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$req = $bdd->prepare('INSERT INTO billets(titre, contenu, date_creation) VALUES(?, ?, NOW())');
	$req->execute(array($titreBillet, $contenuBillet));
	header('Location: index.php');
} 
elseif(isset($_POST['author']) AND isset($_POST['comment'])
				AND isset($_POST['id_billet']) AND trim(htmlspecialchars($_POST['author']))
				AND trim(htmlspecialchars($_POST['comment'])) AND trim(htmlspecialchars($_POST['id_billet']))) {
					
	$author = htmlspecialchars($_POST['author']);
	$comment = htmlspecialchars($_POST['comment']);
	$id_billet = htmlspecialchars($_POST['id_billet']);
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	
	$req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, '
			. ':author, :comment, NOW())');
	$req->execute(array('id_billet' => $id_billet, 'author' => $author, 'comment' => $comment));
	header('Location: commentaires.php?id_billet=' . $id_billet);
}
else {
	isset($_POST['id_billet']) ? header('Location: commentaires.php?id_billet=' . $_POST['id_billet']) : 
		header('Location: index.php');
}

