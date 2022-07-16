<!--
                                                   Ecrire mon premier script php

   Le code php se place dans la balise <\?php ?> (sans anti-slash). Le code en question est :
   echo date('d/m/y h:i:s");

   date est une fonction php permettant de récupérer la date courante de l'ordinateur qui exécute le script PHP, et 'd/m/y h:i:s"
   correspond au format de date que l'on souhaite.
   echo est aussi une fonction php qui elle permet d'afficher quelque chose (si on ne l'avait pas mise, l'emplacement serait resté
   vide au moment de l'affichage sur le navigateur).

   Dans le cas où le fichier ne contient que du code php, il vaut mieux ne pas fermer la balise php. Cela évite les erreur dues
   aux caractères qui seraient ajoutés par erreur après la balise php fermante (?>) dans le cas où l'on tente de changer
   les header HTTP ensuite. Ainsi, ne pas fermer la balise PHP est une bonne pratique à adopter, pour les scripts ne
   contenant que du PHP.

    On peut placer les balises php n'importe où dans le code HTML, même dans une balise meta du header.

    Une instruction se termine par un ";", rien de nouveau.

    Note : il existe une instruction identique à echo appelée print qui fait la même chose (mais qui n'accepte qu'un seul argument);
    Cependant, echo est plus couramment utilisée.


-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Un chiffre aléatoire va être choisi entre 1 et 10 grâce au code PHP :
    <?php echo rand(1, 10); ?>" />
    <title>Ma page web</title>
</head>
<body>
<?php echo '<h1>Hello world !</h1>'; ?>
<?php echo '<strong>Bonjour à tous</strong>';
      echo "Ma deuxième instruction d'affilée;" ?>
<p>Aujourd'hui nous sommes le <?php echo date('d/m/y h:i:s') ?></p>
<p><?php print("Code généré par la <strong>fonction \"print\"</strong>"); ?></p>
</body>
</html>