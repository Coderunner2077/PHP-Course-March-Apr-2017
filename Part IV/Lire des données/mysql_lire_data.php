<pre>
    PHP propose plusieurs moyens de se connecter à une base de données MySQL :

        -   L'extension mysql_ : ce sont des fonctions qui permettent d'accéder à une base de données MySQL et donc de
                communiquer avec MySQL. Leur nom commence toujours par mysql_. Toutefois, ces fonctions sont vielles
                et on recommande de ne plus les utiliser aujourd'hui
        -   L'extension mysqli_ : ce sont des fonctions améliorées d'accès à MySQL. Elles proposent plus de fonctionnalités
                et sont plus à jour
        -   L'extension PDO : c'est un outil complet qui permet d'accéder à n'importe quel type de base de données. On peut
                donc l'utiliser pour se connecter aussi bien à MySQL que PostgreSQL ou Oracle

    Ce sont toutes des extensions car PHP est très modulaire. On peut très facilement ajouter ou supprimer des éléments
    à PHP, car tout le monde n'a pas forcément besoin de toutes les fonctionnalités.
    Je vais opter pour la méthode PDO, car c'est désormais la méthode d'accès la plus utilisée. D'autre part, le plus gros
    avantage de PDO est que je peux l'utiliser de la même manière pour me connecter à n'importe quel autre type de base de
    données (PostgreSQL, Oracle...).

    Pour activer PDO, je dois vérifier dans le fichier de configuration de PHP (qui s'appelle généralement php.ini) s'il
    y a un point-virgule devant "extension=php_pdo_mysql.dll" et l'enlever le cas échéant.
    Dans la foulée, je peux aussi vérifier si la ligne "display_error" est à "on".

    ------------------------------------------------------------------------------------------------------------------------------
    Se connecter à MySQL avec PDO

    Maintenant que je suis certain que PDO est activé, je peux me connecter à MySQL. Je vais avoir besoin de quatre
    renseignements :

        -   le nom de l'hôte : c'est l'adresse que l'ordinateur où MySQL est installé (comme une adresse IP). Le plus
                souvent, MySQL est installé sur le même ordinateur que PHP : dans ce cas, je mets la valeur localhost
                (qui signifie "sur le même ordinateur"). Néanmoins, il est possible que mon hébergeur web m'indique une
                autre valeur à renseigner (qui ressemblerait à ceci : "sql.hebergeur.com"). Dans ce cas, il faudra
                modifier cette valeur lorsque j'enverra mon site sur le web
        -   la base : c'est le nom de la base de données à laquelle je souhaite me connecter. Dans mon cas, la base
                de données (que j'ai créée via phpMyAdmin) s'appelle mybdd
        -   le login : il permet de m'identifier. Je dois me renseigner auprès de mon hébergeur pour le connaître. Le plus
                souvent (chez un hébergeur gratuit), c'est le même login que j'utilise pour le FTP
        -   le mot de passe : il y a des chances pour que le mot de passe soit le même que celui que j'utilise pour
                accéder  au FTP. Se renseigner auprès de mon hébergeur. S'il n'y a pas de mot de passe, on met une
                chaîne vide pour le 3e paramètre.

    Pour l'instant, le nom de l'hôte sera loclhost. Mon login est root, mon mot de passe est root. Voici donc comment
    on doit faire pour se connecter à MySQL via PDO sur la base mybdd :

    $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root');

    PDO est ce qu'on appelle une extension orientée objet. $bdd est donc un objet qui représente la connexion à la base
    de données.

    Note : le premier paramètre (qui commence par mysql) s'appelle le DSN, pour Data Source Name. C'est généralement le
    seul qui change en fonction du type de base de données auquel on se connecte.

    --------------------------------------------------------------------------------------------------------------------
    Tester la présence d'erreurs

    Si j'ai bien tout renseigné en mettant les bonnes informations (nom de l'hote, login, mot de passe). Rien ne devrait
    s'afficher à l'écran. Toutefois, s'il y a une erreur, PHP risque d'afficher toute la ligne qui pose l'erreur, ce qui
    inclut le mot de passe.
    C'est pourquoi, pour éviter que les visiteurs puissent voir mon mot de passe (en cas d'erreur lorsque mon site est
    mis en ligne), il est préférable de traiter l'erreur.
    En cas d'erreur, PDO renvoie ce qu'on appelle une exception qui permet de capturer l'erreur. Il faut donc tout
    simplement capturer l'exception avec le bloc try et catch.

    Illustration :

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root');
    } catch (Excetpion $e) {
        die('Erreur : ' . $e->getMessage());
    }


    --------------------------------------------------------------------------------------------------------------------
    Effectuer une requête SQL

    Voici comment on procède :

    $reponse = $bdd->query('SELECT * FROM jeux_video');

    Ici, $reponse contient quelque chose d'inexploitable. MySQL me renvoie bcp d'informations qu'il faut organiser.
    La solution est d'extraire cette réponse ligne par ligne, ie entrée par entrée (entry by entry, ie row by row).
    Pour récupérer une enrée, on prend la réponse de MySQL et on y exécute fetch(), ce qui renvoie la ligne suivante :

    $donnees = $reponse->fetch();

    Note : fetch en angais signifie "va chercher".

    $donnees est un tableau qui contient champ par champ les valeurs de la 1re ligne en l'occurence. On fait une boucle
    pour parcourir toutes les entrées, sachant que fetch() renvoie false lorsqu'on arrive au bout.

    Réf plus bas.

    Note : closeCursor() provoque la "fermeture du curseur d'analyse des résultats". Je dois effectuer cet appel à
    closeCursor() chaque fois que j'ai fini de traîter le retour d'une requête, afin d'éviter d'avoir des problèmes
    à la requête suivante. Cela veut dire qu'on a terminé le travail sur la requête.

    Note2 : la connexion à la base de données n'a besoin d'être faite qu'une seule fois, au début de la page, tandis qu'il
    faut fermer les résultats des recherche avec closeCursor() après avoir traîté chaque requête.

    --------------------------------------------------------------------------------------------------------------------
    --------------------------------------------------------------------------------------------------------------------
    CRITERES DE SELECTION
    LIMIT

    LIMIT me permet de ne sélectionner qu'une partie des résultats (par exemple, les 20 premiers). C'est très utile lorsqu'il
    y a bcp de résultats et que je souhaite les paginer (ie afficher une quantité limitée par page).

    A la fin de la requête, il faut ajouter le mot-clé LIMIT suivi de deux nombres séparés par une virgule. Par exemple ;

    SELECT * FROM jeux_video LIMIT 0, 20

    Ces deux nombres ont un sens bien précis :

        -   On indique tout d'abord à partir de quelle entrée on commence à lire la table. "O" correspond à la 1re entrée.
                Attention : cela n'a rien à voir avec le champ ID
        -   Ensuite, le 2e nombre indique combien d'entrées on doit sélectionner. Ici j'ai mis "20", on prendra donc 20
                entrées.

    Sinon, on peut faire une requête un peu plus compliquée aussi :

    SELECT nom, possesseur, console, prix, FROM jeux_video WHERE console='XBOX' OR console='PS2' ORDER BY prix LIMIT 0,10

    Attention : Il faut utiliser les mot-clés dans cet ordre-là : WHERE, puis ORDER BY, puis LIMIT. Sinon, MySQL ne
    comprendra pas ma requête.

    --------------------------------------------------------------------------------------------------------------------
    --------------------------------------------------------------------------------------------------------------------
    CONSTRUIRE DES REQUÊTES EN FONCTION DE VARIABLES
    La mauvaise pratique à bannir : concaténer une variable dans une requête

    Je pourrai être tenté de concaténer la variable dans la requête, comme ceci :

    $reponse = $bdd->query('SELECT nom FROM jeux_video WHERE possesseur=\'' . $_GET['possesseur'] . '\'');

    Note : il est nécessaire d'entourer la chaîne de caractères d'apostrophes, d'où la présence d'antislashs pour
    insérer les apostrophes : \'.

    Bien que cela fonction, c'est l'illustration parfaite de ce qu'il ne faut pas faire et que pourtant beaucoup de
    sites font encore. En effet, si la variable $_GET['possesseur'] a été modifiée par un visiteur (et je sais à quel
    point il ne faut pas faire confiance à l'utilisateur !), il y a un gros risque de faille de sécurité qu'on appelle
    injection SQL. Un visiteur pourrait s'amuser à insérer une requête SQL  au milieu de la mienne  et potentiellement lire
    tout le contenu de ma base de données, comme par exemple les mots de passe de mes utilisateurs.

    Lien vers le sujet des injections SQL : https://fr.wikipedia.org/wiki/Injection_SQL

    Je vais utiliser un autre moyen plus sûr d'adapter mes requêtes en fonction des variables : les requêtes prépararées.

    --------------------------------------------------------------------------------------------------------------------
    Les requêtes préparées

    Le système des requêtes préparées a l'avantage d'être plus sûr mais aussi plus rapide pour la base de données si la
    requête est exécutée pluieurs fois. Et c'est ce qui est préconisé d'utiliser si je veux adapter une requête en fonction
    d'une ou plusieurs variables.

    ---------------------------------------------------------
    Avec des marqueurs "?"

    Dans un 1er temps, je vais préparer la requête sans sa partie variable, que l'on représentera avec un marqueur sous
    forme de point d'interrogation :

    $req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ?');

    La requête est alors prête, sans sa partie variable. Maintenant, je vais exécuter la requête en appelant execute() et
    en lui transmettant la liste des paramètres :

    $req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ?');
    $req->execute(array($_GET['possesseur']));

    La requête est alors exécutée à l'aide des paramètres que l'on a indiqués sous forme d'array.

    S'il y a plusieurs marqueurs, il faut indiquer les paramètres dans le bon ordre :

    $req = $bdd->prepare('SELECT nom FROM jeux_video WHERE possesseur = ? AND prix <= ?');
    $req->execute(array($_GET['possesseur'], $_GET['prix_max']));

    Le contenu de ces variable aura été automatiquement sécurisé pour prévenir les risques d'injection SQL.

    Réf plus bas

    Note : bien que la requête soit "sécurisée" (ce qui élimine les risque d'injection SQL), il faudrait quand même
    vérifier que $_GET['prix_max'] ne pose pas un problème sur le plan de la logique (est-ce bien un nombre, un nombre
    raisonnable, etc.).

    ---------------------------------------------------------
    Avec des marqueurs nominatifs

    Si la requête contient bcp de parties variables, il peut être plus pratique de nommer les marqueurs plutôt que
    d'utiliser des points d'interrogation.

    Voici comment on s'y prendrait :

    $req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = :possesseur AND prix <= :prixmax');
    $req->execute(array('possesseur' => $_GET['possesseur'], 'prixmax' => $_GET['prix_max']));

    Ainsi, les points d'interrogation ont été remplacés par des marqueurs nominatifs :possesseur et :prixmax (ils
    commencent par ':').

    Cette fois-ci, ces marqueurs sont remplacés par les variables à l'aide d'un array associatif. Quand il y a bcp de
    paramètres, cela permet parfois d'avoir plus de clarté. De plus, contrairement aux points d'interrogation, je ne
    suis plus obligé d'envoyer les variables dans le même ordre que la requête.

    --------------------------------------------------------------------------------------------------------------------
    TRAQUER LES ERREURS

    Lorsqu'une requête plante, bien souvent PHP me dira qu'il y a une erreur à la ligne du fetch, du genre :

    Fatal error: Call to a member function fetch() on a non-object in C:\wamp\www\tests\index.php on line 13

    Ce qui n'est pas vraiment précis, d'autant plus que le plus souvent, l'erreur est due au contenu de la requête SQL
    quelques lignes plus haut.

    Pour afficher des détails sur l'erreur, il faut activer l'affichage des erreurs lors de la connexion à la base de
    données via PDO. En effet, PDO prend un quatrième argument facultatif permettant d'activer l'affichage des erreurs
    qui seront beaucoup plus claires. Voici comment on procède :

    $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


    --------------------------------------------------------------------------------------------------------------------
    --------------------------------------------------------------------------------------------------------------------
    EN RESUME :

    Pour dialoguer avec MySQL depuis PHP, on fait appel à l'extension PDO de PHP.
    Avant de dialoguer avec MySQl, il faut s'y connecter. On a besoin de l'adresse IP de la machine où se trouve
    MySQL, du nom de la base de données ainsi que d'un login et d'un mot de passe.
    Il faut faire une boucle en PHP pour récupérer ligne par ligne les données renvoyées par MySQL.
    Pour construire une requête en fonction de la valeur d'une variable, on passe par un système de requête préparée
    qui permet d'éviter les dangereuses failles d'injection SQL.

    </pre>
<?php
    try {
        // On se connecte à MySQL
        $bdd = new PDO("mysql:host=localhost;dbname=mybdd;charset=utf8", "root", "root",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch(Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }

    // Si tout va bien, on peut continuer
    // On récupère tout le contenu de la table jeux_video
    $reponse = $bdd->query('SELECT * FROM jeux_video');
    // On affiche chaque entrée une à une
    while($donnees = $reponse->fetch()) {
        ?>
        <p>
            <strong>Jeu</strong> : <?php echo $donnees['nom']; ?><br/>
            Possesseur : <?php echo $donnees['possesseur']; ?>;<br/>
            Prix : <?php echo $donnees['prix']; ?> EUR;<br/>
            Plateforme : <?php echo $donnees['console']; ?>; <br/>
            Mode multijouers : <?php echo $donnees['nbre_joueurs_max']; ?> jouer(s);<br/>
            Commentaire : <em><?php echo $donnees['commentaires'] ?>.</em>
        </p>
        <?php
    }
    $reponse->closeCursor();    // Termine le traitement de la requête.

    $req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = ? AND prix <= ? ORDER BY prix');
    $req->execute(array($_GET['possesseur'], $_GET['prix_max']));

    echo 'Affichage des jeux par prix : <br /><ul>';
    while($donnees = $req->fetch()) {
        echo '<li>' . $donnees['nom'] . ' (prix: ' . $donnees['prix'] . ' EUR)</li>';
    }
    echo '</ul>';

    $req->closeCursor();

    $req = $bdd->prepare('SELECT nom, nbre_joueurs_max FROM jeux_video WHERE console = :console AND '
            . 'nbre_joueurs_max <= :nb_joueurs');
    $req->execute(array('console' => $_GET['console'], 'nb_joueurs' => $_GET['nb_players']));

    echo 'Affichage des jeux par nombre de joueurs possibles (pour ' . htmlspecialchars($_GET['console']) . ') : <br />';
    echo '<ul>';
    while($donnees = $req->fetch())
        echo '<li>' . $donnees['nom'] . ' : ' . $donnees['nbre_joueurs_max'] . ' joueur' . (($donnees['nbre_joueurs_max'] > 1) ?
            's' : '') . '</li>';

    echo '</ul>';

    $req->closeCursor();
?>