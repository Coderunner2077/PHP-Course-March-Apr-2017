<pre>
    Pour ajouter, modifier et supprimer des données dans ma base de données, j'utiliserai respectivement INSERT, UPDATE
    et DELETE.
    Pour les tros cas, la méthode ne sera plus query(), mais exec(), sauf lorsque je ferai une requête préparée, où ce
    sera encore un prepare() suivi d'un execute().

    Par exemple, pour insérer une entrée :

    INSERT INTO jeux_video VALUES('', 'Battlefield 42', 'Patrick', 'PC', 45, 50, '2nde Guerre Mondiale')

    Note : vu que je n'indique pas les noms des champs, il est impératif de lister les valeurs de tous les champs sans
    exception. Je dois aussi spécifier au moins une chaîne vide pour la clé primaire qui s'auto-incrémente.

    Note2 : les nombres n'ont pas besoin d'être entourés d'apostrophes

    Note3 : exec() renvoie le nombre de lignes modifiées

</pre>

<?php
    $nom = 'Halo 3';
    $possesseur = 'Bernard';
    $console = 'Xbox 360';
    $prix = 29;
    $nbre_joueurs_max = 16;
    $commentaires = 'Best game in the wholish worldish !';
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $bdd->exec('INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) '
            . 'VALUES(\'Battlefield 42\', \'Patrick\', \'PC\', 45, 50, \'2nde Guerre Mondiale\')');

    echo 'L\'ajout a bien été effectué';

    echo  '<br />Insertion des données variables grâce à une requête préparée';
    $req = $bdd->prepare('INSERT INTO jeux_video(nom, possesseur, console, prix, nbre_joueurs_max, commentaires) '
            . 'VALUES(:nom, :possesseur, :console, :prix, :nbre_joueurs_max, :commentaires)');
    $req->execute(array(
        'nom' => $nom,
        'possesseur' => $possesseur,
        'console' => $console,
        'prix' => $prix,
        'nbre_joueurs_max' => $nbre_joueurs_max,
        'commentaires' => $commentaires
    ));

    echo '<br />L\ajout a rencontré un franc succès';

    $req->closeCursor();

    // UPDATE
    $bdd->exec('UPDATE jeux_video SET nbre_joueurs_max=36 WHERE nom = \'Battlefield 43\'');

    // Dans le WHERE pour UPDATE, on met le plus souvet l'ID ou le nom

    echo '<br /> Ou encore, si le possesseur a changé...';
    $nb_lignes_modifiees = $bdd->exec('UPDATE jeux_video SET possesseur=\'Florient\' WHERE possesseur=\'Michel\'');

    echo '<br />Nombre de lignes modifiées : ' . $nb_lignes_modifiees;

    // POur mettre à jour avec la requête préparée :

    $req = $bdd->prepare('UPDATE jeux_video SET prix= :prix, nbre_joueurs_max = :nbre_joueurs_max');
    $lines_changed = $req->execute(array(
        'prix' => $prix,
        'nbre_joueurs_max' => $nbre_joueurs_max
    ));

    $req->closeCursor();
    echo '<br />J\'ai modifiée : ' . $lines_changed;

    $nb = $bdd->exec('DELETE FROM jeux_video WHERE nom=\'Battlefield 42\' OR nom=\'Halo 3\'');

    echo '<br />Nombre de lignes supprimées : ' . $nb;


