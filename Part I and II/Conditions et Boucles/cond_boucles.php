<?php

/*
 *  Apparemment, pas d'opérateurs === et !== comme en JavaScript. Ouff...
 *  On revient aux ==, != seuls. Avec les autres opérateurs bien sûr (<, >, <=, >=).
 *  Faux ! Ces deux opérateurs existent bel et bien en PHP aussi !!
 */

$faux = false;
if($faux)
    echo 's\affichera pas';
elseif($faux != true)
    echo '"elseif" et non pas "else if" apparemment...';
/*
 * AND et && sont équivalents
 * OR et || sont équivalents
 */
$vrai = true;
if($faux OR $vrai)
    echo '<br />faux ou vrai';
if($vrai AND $faux && $vrai);
else
    echo '<br />le "AND", c\'est plus lisible que l\'opérateur "&&"';

if($vrai)
{
    ?>
    <!-- du code html -->
    <p><strong>Code html, et ouai</strong></p>
    <?php
}
    echo '<br />Donc, de cette manière, on peut placer de gros morceaux de code html entre les accolades d\'une condition';

//Sinon, y a bien le switch et les terniaires.

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Les boucles
/*
 * Boucles while et for(;;), normale.
 * Une chose intéressante, si la boucle se répète pendant plus d'une quinzaine de secondes, le PHP s'arrête automatiquement
 * et affiche un message d'erreur. En effet, le PHP refuse de travailler plus d'une quinzaine de secondes.
 *
 * Là aussi, on peut placer du code html entre les accolades de la boucle comme avec le if vu précédemment
 */
