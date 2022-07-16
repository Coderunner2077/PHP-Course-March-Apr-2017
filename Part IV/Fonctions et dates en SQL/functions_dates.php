<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Fonctions et dates en SQL</title>
</head>
<body>
<pre>

    PARTIE 1 : LES FONCTIONS
    Les fonctions SQL classées en deux catégories :

        -   Les fonctions scaires : elles agissent sur chaque entrée
        -   Les fonctions d'agrégat : lorsque j'utilise ce genre de fonctions, des calculs sont faits sur l'ensemble de la
                table pour retourner UNE seule valeur. Par exemple, calculer la moyenne des prix retourne le prix moyen

    Attention : bien que cela fonctionne avec MySQL, il est préférable de donner un autre nom au champ que "date". En effet,
    c'est un mot-clé du langage SQL, ce qui peut provoquer des erreurs avec d'autres systèmes de bases de données comme
    Oracle.

    I./ Les fonctions scalaires

    UPPER() et LOWER() sont également des fonctions du MySQL (tout comme pour SQL Server apparemment).

    idem pour LENGTH() (donc pas que dans Oracle).

    II./ Les fonctions d'agrégat

    Il ne faut pas mélanger la fonction d'agrégat avec d'autres champs. En effet, je ne dois pas récupérer d'autres champs
    de la table quand j'utilise une fonction d'agrégat, car celle-ci retourne une seule valeur qui ne peut donc pas être
    juxtaposée à une multitude d'entrées.

    III./ GROUP BY et HAVING : le groupement des données

    On utilise la clause GROUP BY en combinaison d'une fonction d'agrégat (comme AVG par ex) pour obtenir des informations
    intéressantes sur des groupes de données.

    Par exemple :

    SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console

    Ici, on récupère la liste des différentes consoles et le prix moyen des jeux de chaque plateforme.

    SELECT SUM(prix) AS valeur_totale, possesseur FROM jeux_vide GROUP BY possesseur

    HAVING permet de filtrer les données regroupées. En effet, HAVING est un peu l'équivalent de WHERE, mais il agit sur les
    données une fois qu'elles ont été regroupées. C'est donc une façon de filtrer les données à la fin des opérations.

    Par exemple :

    SELECT AVG(prix) AS prix_moyen, console FROM jeux_video GROUP BY console HAVING prix_moyen <= 10

    HAVING ne dois s'utiliser que sur le résultat d'une fonction d'agrégat. La différence avec WHERE, c'est que celui-ci
    agit en premier, avant le regroupement des données, tandis que HAVING agin en second, après le regroupement des données.

    On peut même combiner les deux :

    SELECT AVG(prix) AS prix_moyen, console FROM jeux_video WHERE possesseur = 'Patrick' OR possesseur = 'Michel'
    GROUP BY console, HAVING prix_moyen <= 10

    PARTIE 2 : DATES

    I./ Les champs de type date

    Les différentes types de date :

        -   DATE => AAAA-MM-JJ
        -   TIME => HH:MM:SS
        -   DATETIME => AAA-MM-JJ HH:MM:SS
        -   TIMESTAMP => stocke le nombre de secondes passées depuis le 01/01/1970 à 00h00min00s
        -   YEAR => AA ou AAAA

    II./ Les fonctions de gestion des dates

    Pour voir la liste complète : https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html
    1.) Extraction of date/time part
    DAY(), MONTH(), YEAR() : permettent d'extraire, respectivement, le jour, le mois ou l'année

    Exemple :

    SELECT pseudo, message, DAY(postedDate) AS jour FROM minich

    HOUR(), MINUTE(), SECOND() : extraire les heures, minutes, secondes

    De la même façon, avec ces fonctions, il est possible d'extraire les heures, minutes et secondes d'un champ de type
    DATETIME ou TIME.

    2.) DATE_FORMAT : formater une date

    Avec les fonctions que l'on vient de découvrir à l'instant, on pourrait extraire tous les éléments de la date, comme
    ceci :

    SELECT pseudo, message, DAY(postedDate) AS jour, MONTH(postedDate), YEAR(postedDate), HOUR(postedDate), MINUTE(postedDate),
    SECOND(postedDate) FROM minich

    Mais il y a plus simple. DATE_FORMAT me permet d'adapter directement la date au format que je préfère. Il faut dire que
    le format par défaut de MySQL (AAAA-MM-JJ HH:MM:SS) n'est pas très courant en France.

    Voici comment on pourrait l'utiliser :

    SELECT pseudo, message, DATE_FORMAT(postedDate, '%d/%m/%Y %Hh%imin%ssec') AS date FROM minich

    Les symboles %d, %m, %Y, %H, %i, %s sont remplacés respectivement par jour, mois, année, heure, minutes et secondes. Les
    autres symboles et lettres sont affichés tels quels.
    Il exsite bcp d'autres symboles pour extraire par exemple le nom du jour (en anglais), le numéro du jour dans l'année,
    etc. Liste des symboles dispo ici : https://dev.mysql.com/doc/refman/5.7/en/date-and-time-functions.html#function_date-format

    3.) DATE_ADD et DATE_SUB : ajouter et soustraire des dates

    Exemple :

    SELECT pseudo, message, DATE_ADD(postedDate, INTERVAL 15 DAY) AS date_expiration FROM minich

    Je peux remplacer DAY ici par MONTH, YEAR, HOUR, MINUTE, SECOND, etc. Par conséquent, si je souhaite indiquer que les
    messages expirent dans deux mois :

    SELECT pseudo, message, DATE_ADD(postedDate, INTERVAL 2 MONTH) AS date_expiration FROM minich





</pre>
</body>
</html>