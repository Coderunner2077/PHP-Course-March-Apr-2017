<?php
/*
 *                                                          Tableaux
 *
 * Les index des tableaux sont appelés les "clés", en PHP.
 * Il existe deux types de tableaux : tableaux numérotés et tableaux associatifs
 *
 * TABLEAUX NUMEROTES :
 */
//pour créer un tableau numéroté, on utilise généralement la fonction array() :

$prenoms = array('cyril', 'benoit', 'françois', 'jean');

//On peut aussi créer manuellement le tableau, case par case :

$names[0] = 'George';
$names[1] = 'Clooney';
$names[2] = 'Jean';
$names[3] = 'Dujardin';

//On alors, en laissant le PHP déduire automatiquement les numéros des cases correspondnates :

$colors[] = 'Green'; //créera $colors[0]
$colors[] = 'Blue'; //etc.
$colors[] = 'Red';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Afficher un tableau numéroté

for($i = 0; $i < 3;$i++)
    echo 'colors['. $i .'] = ' .$colors[$i] . '<br />';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//LES TABLEAUX ASSOCIATIFS

//Je crée mon tableau associatif :
$employee = array(
    'nom' => 'Bedos',
    'prenom' => 'Francis',
    'adresse' => '34 Rue Pierre',
    'ville' => 'Paris');

//Donc, on écrit une flèche pour dire "associé à"

//Il est aussi possible de créer le tableau case par case :
$coordonnees['nom'] = 'Caesar';
$coordonnees['prenom'] = 'Jules';
$coordonnees['adresse'] = 'Rue de Rome';
$coordonnees['ville'] = 'Rome';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Afficher un tableau associatif

// Avec la boucle foreach : foreach(array as variable)

foreach($employee as $element)
    echo $element . '<br />';

//On peut assu récupérer la clé de l'élémént avec foreach : foreach($array as $key => $variable)
foreach($employee as $cle => $element)
    echo 'employee['. $cle .'] => '.$element .'<br />';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Afficher rapidement un array (pour les phases de déboggage généralement)
//Avec la fonction print_r : mais il ne faudra pas placer la fonction entre les balises <pre></pre> pour qu'on puisse sauter
//les lignes

echo '<pre>';
print_r($coordonnees);
echo '</pre>';

//la fonction print_r ne renvoyant pas de code HTML comme <br />, les balises <pre></pre> permettent d'avoir un affichage
// correct

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Rechercher dans un tableau

//Vérifier si une clé existe
if(array_key_exists('nom', $coordonnees))
    echo '<b>array_key_exists() renvoye true si la clé passée en 1er paramètre est présente dans le tableau passé en 2nd
 param</b>';

//Vérifier si une valeur existe
if(in_array('Caesar', $coordonnees))
    echo '<strong><br />in_array() vérifie si une valeur (1er param) existe dans le tableau (2nd param)</strong>';

//Obtenir la clé d'une valeur
$position = array_search('Jules', $coordonnees);
echo '<br />"Jules" se trouve à la position : '. $position;
$pos = array_search('Gedorge', $names); //renvoie NULL si la valeur n'est pas trouvée
if(!$pos)
    echo '<br />Gedorge ne se trouve pas dans le tableau '. $names;