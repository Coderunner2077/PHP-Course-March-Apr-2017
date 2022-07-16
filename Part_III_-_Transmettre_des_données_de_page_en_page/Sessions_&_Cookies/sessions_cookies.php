<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Sessions et Cookies</title>
</head>
<body>
<section>
    <pre>
    I./ LES SESSIONS

    Les sessions constituent un moyen de conserver des variables sur toutes les pages de mon site. Les variables $_GET
    et $_POST sont plutôt faites pour transmettre les informations une seule fois, d'une page à une autre, informations
    qui seront oubliées dès qu'on charge une autre page. C'est pour cela qu'on a inventé les sessions qui permettent de
    transmettre et stocker des variables sur toutes les pages de mon site pendant la durée de la présence d'un visiteur.

    1.) Fonctionnement des sessions

    Voici les trois étapes de fonctionnement des sessions à connaître :

        -   Un visiteur arrive sur mon site. On demande à créer une session pour lui. PHP génère alors un numéro unique.
                Ce numéro est souvent très gros et écrit en hexadécimal, par exemple : a02bbffc6198e6e0cc2715047bc3766f.
                (Ce numéro sert d'identifiant et est appelé "ID de session" (ou PHPSESSID). PHP transmet automatiquement
                cet ID de page en page en utilisant généralement un cookie).
        -   Une fois la session générée, on peut créer une infinité de variables de session pour mes besoins. Par exemple,
                on peut créer une variable $_SESSION['nom'] qui contient le nom du visiteur, $_SESSION['prenom'] qui
                contient le prénom, etc. Le serveur conserve ces variables même lorsque la page PHP a fini d'être générée.
                Cela veut dire que, quelque soit la page de mon site, je pourrai récupérer par exemple le nom et le prénom
                du visiteur via la superglobale $_SESSION !
        -   Lorsque le visiteur se déconnecte de mon site, la session est fermée et PHP "oublie" alors toutes les variables
                de session que j'ai créées. Il est en fait difficile de savoir précisément quand un visiteur quitte mon
                site. En effet, lorsqu'il ferme son navigateur ou va sur un autre site, le mien n'en est pas informé. Soit
                le visiteur clique sur un boutton "Déconnexion" (que j'aurai créé) avant de s'en aller, soit on attend
                quelques minutes d'inactivité pour le déconnecter automatiquement : on parle aussi de timeout. Le plus
                souvent, le visiteur est déconnecté par un timeout.

    Je dois connaître deux fonctions :

        -   sessions_start() : démarre le système de sessions. Si le visiteur vient d'arriver sur le site, alors un numéro
                de session est généré pour lui. Je dois appeler cette fonction au tout début de chacune des pages où
                j'ai besoin des variables de session.
        -   session_destroy() : ferme la session du visiteur. Cette fonction est automatiquement appelée lorsque le visiteur
                ne charge plus de page de mon site pendant plusieurs minutes (c'est le timeout), mais je dois aussi créer une
                page "Déconnexion" si le visiteur souhaite se déconnecter manuellement.

    Attention : il y a un petit piège. Il faut appeler session_start() sur chacune de mes pages AVANT d'écrire le moindre
    code HTML (avant même la balise &lt;!DOCTYPE html&gt;. Si j'oublie de lancer session_start(), je ne pourrai accéder aux
    variables superglobales $_SESSION.

    2.) Exemple d'utilisation des sessions

    Réf exemple1.php

    On peut créer des variables de session n'importe où dans le code (pas seulement au début comme dans l'exemple). La seule
    chose qui importe, c'est que le session_start() soit appelé au tout début de la page.

    Note : je ne m'occupe de rien => ni de transmettre le nom, le prénom ou l'âge du visiteur, ni de transmettre l'ID
    de session. PHP gère tout à ma place.

    Note2 : si je veux détruire manuellement la session du visiteur, je peux faire un lien "Déconnexion" amenant vers une
    page qui fait appel à la fonction session_destroy().

    3.) L'utilité des sessions en pratique

    Concrètement, les sessions peuvent servir dans de nombreux cas sur mon site. Voici quelques exemples :

        -   Imaginons un script qui demande un login et un mot de passe pour qu'un visiteur puisse se "connecter". On peut
                enregistrer ces informations dans des variables de session et se souvenir de l'identifiant du visiteur
                sur toutes les pages du site.
        -   Puisqu'on retient son login et que la variable de session n'est créée que s'il a réussi à s'authentifier, on
                peut l'utiliser pour restreindre certaines pages de mon site à certains visiteurs uniquement. Cela permet
                de créer une zone d'administration sécurisée : si la variable de session login existe, on affiche le
                contenu, sinon on affiche une erreur. On peut donc se servir des sessions pour protéger automatiquement
                plusieurs pages.
        -   On se sert activement des sessions sur les sites de vente en ligne. Cela permet de gérer un "panier" : on
                retient les produits que commande le client quelle que soit la page où il est. Lorsqu'il valide sa
                commande, on récupère ces informations et... on le fait payer.

    Note : si mon site est hébergé chez Free.fr, je devrai créer un dossier appelé "sessions" à la racine de mon FTP pour
    activer les sesions.

    II./ COOKIES

    Travailler avec des cookies revient à peu près à la même chose qu'avec des sessions, à quelques petites différences
    près.

    1.) What is a cookie ?

    Un cookie est un petit fichier que l'on enregistre sur l'ordinateur du visiteur.
    Ce fichier contient du texte et permet de "retenir" des informations sur le visiteur. Par exemple, j'inscris dans
    un cookie le pseudo du visiteur, comme ça, la prochaine fois qu'il viendra sur mon site, je pourrai lire son pseudo
    en allant regarder ce que son cookie contient.

    Parfois, on prend les cookies pour des virus. Ce n'est absolument pas le cas. Ce sont juste de petits fichiers texte qui
    permettent de retenir des informations (souvent à intérêt commercial).

    Chaque cookie stocke généralement une information à la fois. Si je veux stocker le pseudonyme du visiteur et sa
    date de naissance, il est donc recommandé de créer deux cookies.

    Où sont stockés les cookies sur mon disque dur ? ==> Cela dépend de mon navigateur Web. Généralement, on ne touche pas
    directement à ces fichiers, mais on peut afficher à l'intérieur du navigateur la liste des cookies qui sont stockés. On
    peut choisir de les supprimer à tout moment.
    Avec Mozilla : Outils / Options / Vie privée  ==> Supprimer des cookies spécifiques. Résultat : j'obtiens la liste
    et la valeur de tous les cookies stockés.

    Les cookies sont classés par site Web. Chaque site web peut écrire plusieurs cookies. Chacun d'entre eux a un nom et
    une valeur. Je note que comme tout cookie qui se respecte, chacun d'eux a une date d'expiration. Après cette date, ils
    sont automatiquement supprimés par le navigateur.

    Les cookies sont donc des informations temporaires que l'on stocke sur l'ordinateur des visiteurs. La taille est
    limitée à quelques kilo-octets : je ne peux pas stocker beaucoup d'informations à la fois, mais c'est en général
    suffisant.

    2.) Ecrire un cookie

    Comme une variable, un cookie a un nom et une valeur.

    Pour écrire un cookie, on utilise la fonction PHP setcookie().

    On lui donne en général trois paramètres, dans l'ordre suivant :

        -   le nom du cookie
        -   la valeur du cookie
        -   la date d'expiration du cookie, sous forme de timestamp.

    Grande différence avec le timestamp du JavaScript => En PHP, le timestamp est exprimé en secondes et non pas en
    millisecondes.
    Pour obtenir le timestamp actuel, on fait appel à la fonction time().

    Si je veux supprimer le cookie dans un an, il me faudra écrire : time() + 365*24*3600;

    Exemple :

    &lg;?php
        setcookie('name', 'Fillon2017', time() + 365 * 24 * 3600);
    ?&gt;

    3.) Sécuriser son cookie avec le mode httpOnly

    Il est recommandé d'activer l'option httpOnly sur le cookie. Sans rentrer dans les détails, cela rend mon cookie
    inaccessbible en JavaScript sur tous les navigateurs qui supportent cette option (c'est le cas de tous les
    navigateurs récents). Cette option permet de réduire drastiquement les risques de faille XSS sur mon site, au cas
    où j'aurais oublié d'utiliser htmlspecialchars() à un moment.

    Voici la procédure :

    &lt;?php
    setcookies('name', 'Fillon2017', time() + 365 * 24 * 3600, null, null, false, true);
    ?&gt;

    Le dernier paramètre true permet d'activer le mode httpOnly sur le cookie, et donc de le rendre en quelque sorte plus
    sécurisé. Ca ne coûte rien et je diminue le risque qu'un jour l'un de mes visiteurs puisse se faire voler le contenu
    d'un cookie à cause d'une faille XSS.

    Note : les paramètres du milieu sont des paramètres que je n'utiliserai pas, je leur ai donc envoyé null.

    4.) Créer le cookie avant d'écrire du HTML

    Il y a un petit problème avec setcookie()... Comme session_start(), cette fonction ne marche QUE si je l'appelle avant
    tout code HTML (donc avant la balise &lt;!DOCTYPE&gt;).

    Attention : il ne faut jamais placer le moindre code HTML avant d'utiliser setcookie.

    Voyons maintenant comment je ferais pour écrire deux cookies, un qui retient mon pseudo pendant un an, et un autre qui
    retient le nom de mon pays.
    &lt;?php
        setcookie('pseudo', 'Fillon2017', time() + 365*24*3600, null, null, false, true);   // On écrit un cookie
        setcookie('pays', 'France', time() + 365*24*3600, null, null, false, true);     // Un autre cookie
        // et seulement maintenant du code HTML
    ?&gt;
    &lt;!DOCTYPE html&gt;
    &lt;html&gt;
    &lt;head&gt;
        &lt;meta charset="utf-8" /&gt;
        etc.

    Et voilà, les cookies sont écrits !

    5.) Afficher un cookie

    C'est la partie la plus simple. Avant de commencer à travailler sur une page, PHP lit les cookies du client pour
    récupérer toutes les informations qu'ils contiennent. Ces informations sont placées dans la superglobale $_COOKIE,
    sous forme d'array, comme d'habitude.

    De ce fait, si je veux ressortir le pseudo du visiteur que j'avais inscrit dans un cookie, il suffit d'écrire :
    $_COOKIE['pseudo'].

    Ce qui donne un code PHP tout bête pour afficher de nouveau le pseudo du visiteur :

    &lt;p&gt;Hello &lt;?php echo $_COOKIE['pseudo']; ?&gt;, you who are in &lt;?php echo $_COOKIE['pays']; ?&gt;.&gt;

    Le plus grand avantage c'est que les superglobales sont accessibles partout.

    A noter que si le cookie n'existe pas, la variable superglobale correspondante n'existe pas, il faut donc faire un
    isset() pour vérifier si le cookie existe ou non.

    Attention : les cookies viennent du visiteur. Comme toute information qui vient du visiteur, elle n'est pas sûre.
    N'importe quel visiteur peut créer des cookies et envoyer ainsi de fausses informations à mon site. Il faut donc faire
    attention en lisant les cookies du visiteur, et ne jamais avoir une confiance aveugle en leur contenu !

    6.) Modifier un cookie existant

    Comment modifier un cookie déjà existant ? Là encore, c'est très simple : il faut faire appel à setcookie() en
    gardant le même nom de cookie, ce qui "écrasera" l'ancien.

    Par exemple, si j'habite maintenant en Chine, je fais :

    &lt;?php setcookie('pays', 'Chine', time()+365*24*3600, null, null, false, true); ?&gt;

    Note : le temps d'expiration du cookie est remis à zéro pour un an.


    EN RESUMé :

    La superglobale $_SESSION permet de stocker des informations qui seront automatiquement transmises de page en page
    pendant toute la durée de visite d'un internaute sur mon site. Il faut au préalable activer les sessions en appelant
    la fonction session_start().
    La superglobale $_COOKIE représene le contenu de tous les cookies stockés par mon site sur l'ordinateur du visiteur.
    Les cookies sont de petits fichiers que l'on peut écrire sur la machine du visiteur pour retenir par exemple son nom.
    On crée un cookie avec la fonction setcookie().
    </pre>
</section>
</body>
</html>