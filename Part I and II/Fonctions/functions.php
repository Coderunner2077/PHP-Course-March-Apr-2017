<?php

//                                                  Les fonctions

//Les fonctions prêtes à l'emploi du PHP:
//strlen()
$mot = 'voici';
$length = strlen('voici');
echo $length; //affiche 5

//str_replace() : remplacer une chaîne par une autre

$bam = '<br />Ton tonton tond';
$result = str_replace('tonton', 'daron', $bam);
echo $result;

//str_shuffle() : mélanger aléatoirement les caractères d'une chaîne

$result = str_shuffle('Ton tonton tond');
echo '<br />'. $result;

// strtolower() / strtoupper()
$result = strtolower('TADAM TAMTAM');
echo '<br />'. $result;

$result = strtoupper($result);
echo $result;

//Récupérer une date

$year = date('Y'); // Y en majuscule pour l'année
$month = date('m'); // m pour le mois
$day = date('d'); // d pour le jour du mois
$hour = date('H'); // H en majuscule pour l'heure
$minutes = date('i'); // i pour les minutes
$seconds = date('s'); // s pour les secondes

echo '<br />'. $day .'/'. $month .'/'. $year .' '. $hour .':'. $minutes .':'. $seconds .'<br />';

// Remarque : le fuseau horaire semble ne pas être le bon

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Créer mes propres fonctions

function hello($nom)
{
    echo 'Hello '. $nom .' !<br />';
}

hello('Pierre');
hello('Jean');

//fonction retournant le volume d'un cône
// ==> rayon * rayon * Pi * hauteur *(1/3)
function volumeCone($rayon, $hauteur)
{
    return $rayon * $rayon * 3.141 * $hauteur * (1/3);
}

echo volumeCone(2, 5);

// Remarque : déclaration de fonctions assez similaire à JavaScript