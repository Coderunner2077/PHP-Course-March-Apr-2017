<?php
/*Voici les types de variables en php :

    -   string
    -   int
    -   float
    -   bool

Sinon, on peut affecter la valeur NULL à une variable, et cette dernière n'aura pas de type du coup.

Voici comment on déclare une variable : */
$un_mot = 'un string';
$un_mot2 = "string entre guillemets";
$un_int = 10;
$un_float = 4.334;
$un_bool = false;
$incognito = NULL;

/* Donc, pas besoin de spécifier explicitement le type. Comme en JavaScript apparemment.

Voici la différence entre les apostrphoses et les guillemets : */
echo "Voici une variable : $un_mot2, et même pas besoin de mettre des plus comme en Java ou JavaScript pour concaténer";
echo '<br />Concaténer une variable : ' . $un_mot . ', avec des chaînes de caractères entourées d\'apostrophes...';

/* Le code est plus lisible avec les apostrophes, puisqu'on met sépare les différents éléments à l'aide des points. C'est
cette méthode là qui est privilégiés par les développeurs PHP chevronnés.
Moreover, this method is little bit more time-efficient, as PHP doesn't need to look for the variable in the string.

Otherwise, same basic numerical operations as in other languages.
*/