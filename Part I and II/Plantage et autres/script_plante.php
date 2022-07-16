
<?php
//                                                     Les erreurs

//Les erreurs les plus courantes :
/*
 * -    Parse error : une erreur de syntaxe (oubli de point-virgule, accolade ou guillemets non fermé...)
 * -    Undefined function : erreur d'orthographe, une extension PHP non activée ou encore fonction non disponible dans la
 *                              version du PHP actuelle
 * -    Wrong parameter count : il manque un ou plusieurs arguments ou bien, il y en a trop
 */

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Traiter les erreurs MySQL
/*
 * Lorsqu'il se produit une erreur SQL, la page affiche le plus souvent l'erreur suivante :
 * Fatal error : Call to a member function fetch() of a non-object
 *
 * Cette erreur survient lorsque je veux afficher les résultats de ma requête, généralement dans la boucle :
 * while($donnees = $reponse->fetch())
 */
//Lorsqu'il y a une requête qui plante, il faut la repérer et ensuite demander d'afficher l'erreur s'il y en a une :

//$reponse = $bdd->query('SELECT nom FROM Customers') or die(print_r($bdd->errorInfo()));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Quelques erreurs plus rares
/*
 * -    "Headers already sent by..."
 * -    "L'image contient des erreurs"
 * -    "Maximum execution time exceeded"
 */

//"Headers already sent by..."
//Ou plus précisément :
//Cannot modify header information - headers already sent by ...
/*
 * Les headers sont des informations d'en-tête qui sont envoyées avant toute chose au navigateur du visiteur. Elles permettent de
 * dire "Ce que tu vas recevoir est une page HTML", ou bien "Ce que tu vas recevoir est une PNG", ou encore "Inscris un
 * cookie".
 * Toutes ces choses là doivent être envoyées avant que le moindre code HTML ne soit envoyé. EN PHP, la fonction qui permet
 * d'envoyer des info de headers s'appelle header().
 *
 * Note : Il y a d'autres fonctions qui envoyent des headers toutes seules. C'est le cas de session_start() et de
 * setcookie().
 *
 * Ce qu'il faut retenir : chacune de ces fonction doit être utilisée au tout début du code PHP, ie il ne faut rien
 * mettre avant, sinon ça provoquera l'erreur "Headers already sent by..."
 *
 * Un exemple de code qui génère l'erreur :
 * <html>
 * <?php session_start(); ?>
 */

// "L'image contient des erreurs"
/*
 * C'est le navigateur qui me donne ce message d'erreur et non pas PHP.
 * Ce message survient lorsque l'on travaille avec la bibliothèque GD. Si j'ai fait une erreur dans mon code (par exemple,
 * une banale "parse error"), cette erreur sera inscrite dans l'image. Du coup, l'image ne sera pas valide et le navigateur
 * ne pourra pas l'afficher.
 *
 * Voici les deux possibilités pour faire apparaître l'erreur :
 *
 *  -   je peux supprimer la ligne suivante dans mon code :
 *          <?php header ("Content-type: image/png"); ?>
 *          ==> L'erreur apparaître à la place du message "L'image contient des erreurs"
 *  -   je peux aussi afficher le code source de l'image (comme si j'allais regarder la source HTML de la page, sauf qu'il
 *          s'agit d'une image)
 */

// Maximum execution time exceeded
/*
 * PHP limite le temps d'exécution d'une page PHP à 30 secondes (et non pas 15 du coup) par défaut. Généralement, seule une
 * boucle infinie peut être à l'origine d'une durée d'exécution aussi excessive.
 * En général, un serveur met moins de 50 millisecondes à charger une page PHP !
 */


