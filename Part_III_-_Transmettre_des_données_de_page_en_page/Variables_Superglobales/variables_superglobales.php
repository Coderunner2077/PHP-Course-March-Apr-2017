<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Variables superglobales</title>
</head>
<body>
<section>
    Les variables superglobales sont des variables un peu particulières pour trois raisons :

        -   elles sont écrites en majuscules et commencent toutes, à une exception près, par un underscore.
        -   les superglobales sont des array car elles contiennent généralement de nombreuses informations
        -   enfin, ces variables sont automatiquement créées par PHP à chaque fois qu'une page est chargée. Elles existent
                donc sur toutes les pages et sont accessibles partout : au milieu de mon code, au début, dans les fonctions, etc.

    Pour afficher le contenu d'une superglobale et voir ce qu'elle contient, le plus simple est d'utiliser la fonction print_r(),
    puisqu'il s'agit d'un array. Exemple :
    <pre>
    <?php
        print_r($_GET);
    ?>
    </pre>

    Voici les principales variables superglobales existantes :

        -   $_SERVER : ce sont des valeurs renvoyées par le serveur. Elles sont nombreuses et quelques-unes d'entre elles peuvent
                m'être d'une grande utilité. Par exemple, $_SERVER['REMOTE_ADDR'] donne l'adresse IP du client qui a demandé à
                voir la page, ce qui peut être utile pour l'identifier.
        -   $_ENV : ce sont des variables d'environnement toujours données par le serveur. C'est le plus souvent sous des serveurs
                Linux que l'on retrouve des informations dans cette superglobale. Généralement, je ne trouverai rien de bien utile
                là-dedans pour mon site Web.
        -   $_SESSION : on y retrouve les variables de session. Ce sont des variables qui restent stockées sur le serveur le temps
                de la présence d'un visiteur.
        -   $_COOKIE : contient les valeurs des cookies enregistrés sur l'ordinateur du visiteur. Cela me permet de stocker des
                informations sur l'ordinateur du visiteur pendant plusieurs mois, pour se souvenir de son nom par exemple.
        -   $_GET : elle contient les données généralement envoyées en paramètres dans URL.
        -   $_POST : contient les informations qui viennent d'être envoyées par un formulaire.
        -   $_FILES : elle contient la liste des fichiers qui sont envoyés par un formulaire.

    


</section>
</body>
</html>