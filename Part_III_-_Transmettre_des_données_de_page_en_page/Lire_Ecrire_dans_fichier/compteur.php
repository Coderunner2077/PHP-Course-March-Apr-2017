<?php
    $fichier = fopen('compteur.txt', 'r+');
    $compteur = fgets($fichier);
    $compteur++;
    fseek($fichier, 0);
    fputs($fichier, $compteur);
    fclose($fichier);
    echo '<p>Cette page a été vue ' . $compteur . ' fois ! </p>';