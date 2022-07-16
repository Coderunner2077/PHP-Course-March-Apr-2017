<?php
//La fonction isset() teste si une variable existe
if(isset($_GET['nom']) AND isset($_GET['prenom']) AND isset($_GET['repeter'])) { // On vérifie si tous les params existent
    $_GET['repeter'] = (int) $_GET['repeter']; // On transtype pour être sûr que ce soit bien un nombre
    if($_GET['repeter'] > 0 AND $_GET['repeter'] <= 100)
        for($i = 0; $i < $_GET['repeter']; $i++)
            echo '<strong>Bonjour '. $_GET['nom'] .' ' .$_GET['prenom'] .' !</strong><br />';
    else
        echo 'Entrez un nombre entre 1 et 100 !';
}
else
    echo 'Entrez votre nom, prénom et le nombre de répétitions (entre 1 et 100)';

// Remarque : en PHP, lors du transtypage d'une chaîne de caractères ou même d'un booléen true en int, ça
// donne 0.
