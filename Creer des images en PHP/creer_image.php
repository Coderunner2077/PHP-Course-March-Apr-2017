<?php header('Content-type: text/html; charset=iso-8859-1'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Créer des images en PHP</title>
</head>
<body>
<pre>
PHP, à la base, a été créée pour réaliser des pages Web. Mais au fur et à mesure, on s'est rendu compte qu'il serait dommage de se
limiter à cela. On a donc prévu de pouvoir lui ajouter des extensions. Ainsi, en rajoutant certains fichiers (DLL sous Windows), PHP
peut se mettre à générer des images, ou même des PDF ! 

Dans ce chapitre, je parlerai de l'extension spécialisée dans la génération d'images : la bibliothèque GD.

<h2>
I./ Activer la bibliothèque
</h2>
J'aurai tout d'abord, un petit problème à régler : la bibliothèque GD est livrée avec PHP, mais elle n'est pas activée. La
procédure à suivre est la même que pour activer PDO (cf les bdd).

Les hébergeurs gratuits, généralement, désactivent GD parce que ça consomme beaucoup de ressources du processeur.

Si des dizaines de sites se mettent à générer des images en même temps, ça risquerait de faire ramer toute la machine et donc de
ralentir tous les autres sites.

Sinon, y a sûrement quelques uns qui acceptent la biblio GD. Ou alors ==> se tourner vers les hébergeurs payants, on peut en trouver
des pas chers qui acceptent la bibliothèque GD. 

<h2>
II./ Les bases de création d'image
</h2>

Voici le plan que je vais suivre pour créer une image :

	-	je vais découvrir ce qu'est un header
	-	ensuite, créer l'image de base
	-	voir comment on affiche l'image correctement
	
1.) Le header

Il y a deux façons de générer une image en PHP : 

	-	Soit je fais en sorte que mon script PHP renvoie une image (au lieu d'une page Web, comme on en avait l'habitude). 
	-	Soit je demande à PHP d'enregistrer l'image dans un fichier.
	
	
Dans les deux cas, j'utiliserai exactement les mêmes fonctions.

Je vais commencer par la 1re façon de générer l'image, ie je vais faire en sorte que mon script "renvoie" une image au lieu d'une
page Web.

Pour que le navigateur sache que c'est une image et non pas une page HTML qu'il doit afficher, il va falloir envoyer ce qu'on appelle
un header. Grâce à la fonction header, je vais "dire" au navigateur que je suis en train d'envoyer une image : 

Les deux types d'images les plus courants sur le Web sont le JPG et le PNG. Le 1er est à privilégier uniquement s'il s'agit de 
photos. Le second est également en quelque sorte le "remplaçant" du format "GIF".

Voici le code PHP qu'il faut mettre pour "annoncer" au navigateur que je vais envoyer une image PNG :

&lt;?php header('Content-type: image/png'); ?&gt;

Attention : cette fonction doit être appelée avant toute balise HTML.

2.) Créer l'image de base

Il faut savoir qu'il y a deux façons de créer une image : soit je crée une nouvelle image vide, soit je charge une image qui
existe déjà et qui servira de fond pour ma nouvelle image.

a./ A partir d'une image vide

On va commencer par créer une image vide.

Pour créer une image vide en PHP, on utilise la fonction imagecreate().

Cette fonction est simple. Elle prend deux paramètres : la largeur et la hauteur de l'image que je souhaite créer. Elle renvoie une
information que je dois mettre dans une variable (par exemple, $image). Ce qui donne :

&lt;?php
	header('Content-type: image/png');
	$image = imagecreate(200, 50);
?&gt;

$image ne contient ni un nombre, ni du texte. Cette variable contient une "image".

Note : on dit que $image est une "ressource". Une ressource est une variable un peu spéciale qui contient toutes les informations 
sur un objet. Ici, il s'agit d'une image, mais il pourrait très bien s'agir d'un PDF ou même d'un fichier ouvert avec fopen().

b./ A partir d'une image existante

Maintenant, l'autre possibilité : créer une image à partir d'une image déjà existante. Cette fois, il y a deux fonctions à connaître.
Laquelle choisir ? Ca dépend du format de l'image que je veux charger :

	-	imagecreatefromjpeg() : pour le format JPEG
	-	imagecreatefrompng() : pour le format PNG
	
Pour créer une nouvelle image à partir d'une image existante, disons au format JPEG, je dois donc utiliser la fonction
imagecreatefromjpeg(). Ca me donnerait le code suivant : 

&lt;?php
	header('Content-type: image/jpeg');
	$image = imagecreatefromjpeg('couchersoleil.jpg');
?&gt;

Voilà, je sais créer une nouvelle image. Je vais maintenant voir comment afficher l'image que je viens de créer.

3.) Quand on a terminé : on affiche l'image

Une fois l'image chargée, je peux m'amuser à y écrire du texte, à dessiner des cercles, des carrés, etc. (à voir plus loin).

Pour dire à PHP que l'on souhaite afficher l'image, il existe encore le choix entre deux fonctions, selon le format de l'image :

	-	imagejpeg() : pour le format JPEG
	-	imagepng() : pour le format PNG

Ces deux fonctions s'utilisent de la même manière : j'ai juste besoin d'indiquer l'image que je veux afficher.

Comme dit plus haut, il y a deux façons d'afficher les images en PHP : je peux les afficher directement après les avoir 
créées, ou les enregistrer sur le disque pour pouvoir les ré-afficher plus tard, sans avoir à refaire tous les calculs.

4.) Afficher directement l'image

C'est la méthode que l'on va utiliser dans  ce chapitre. Quand la page PHP est exécuée, elle m'affiche l'image que je lui ai
demandé de créer. 

Alor, voici le code complet que j'utilise pour créer une nouvelle image PNG de taille 200x50 et l'afficher directement : 

&lt;?php
	header('Content-type: image/png');	// On indique qu'on va envoyer une image PNG
	$image = imagecreate(200, 50);	// on crée une nouvelle image
	// Ici, on peut modifier cette image éventuellement
	imagepng($image);	// et enfin, on demande à afficher l'image
?&gt;

Ensuite, afin d'intégrer cette image dans la page html avec tout ce que l'on veut autour, on utilise une technique très simple :

&lt;image src="image.php" /&gt; <!-- en supposant que l'adresse URL de la page PHP est "image.php" -->

En effet, <strong>on demande à afficher la page PHP comme une image</strong>. Et c'est logique, étand donné que la page PHP
que l'on vient de créer EST une image (puisqu'on a modifié le header). On peut donc afficher l'image que l'on vient de créer 
depuis n'importe quelle page de mon site en utilisant simplement la balise  &lt;img /&gt;.

Le gros avantage de cette technique, c'est que l'image affichée pourra changer à chaque fois !

5.) Enregistrer l'image sur le disque 

Si, au lieu d'afficher directement l'image, je préfère l'enregistrer sur le disque, alors il faut ajouter un paramètre à la fonction
imagepng() : le nom de l'image et éventuellement son dossier. Par contre, dans ce cas, mon script PHP ne va plus renvoyer une
image (il va juste en enregistrer une sur le disque). Attention, je ne fais alors plus appel à la fonction header() dont on n'a
plus besoin dans ce cas de figure. Ce qui donne : 

&lt;?php
	$image = imagecreate(200, 50);
	// modifs éventuels
	imagepng($image, 'images/monimage.png');
?&gt;

Cette fois, l'image a été enregistrée sur le disque avec le nom "monimage.png". Pour l'afficher depuis une autre page Web, je ferai
comme ceci : 

&lt;img src="images/monimage.png" /&gt;

Cette technique a l'avantage de ne pas nécessiter de recalculer l'image à chaque fois (mon serveur aura moins de travail), mais
le défaut c'est qu'une fois qu'elle est enregistrée, l'image ne change plus.

Il est grand temps d'apporter un peu de décor à tout cela.

<h2>
III./ Texte et couleur
</h2>
Je vais maintenant apprendre à manipuler les couleurs, écrire du texte. Il s'agira d'abord de voir ce qu'il est possible de 
faire avec la bibliothèque GD, mais on verra plus loin qu'on peut faire bien plus.

1.) Manipuler les couleurs

Pour définir une couleur en PHP, on doit utiliser la fonction imagecolorallocate(). 

On lui donne quatre paramètres : 

	l'image sur laquelle on travaille, la quantité de rouge, la quantité de vert, et la quantité de bleu.
	
Cette fonction me renvoie la couleur dans une variable. Grâce à cette fonction, on va pouvoir créer des "variables-couleur" qui
serviront à indiquer ensuite la couleur.

Voici quelques exemples de création de couleur : 

&lt;?php
	header('Content-type: image/png');
	$image = imagecreate(200, 50);
	
	$orange = imagecolorallocate($image, 255, 128, 0);
	$bleu = imagecolorallocate($image, 0, 0, 255);
	$bleuclair = imagecolorallocate($image, 156, 227, 254);
	$noir = imagecolorallocate($image, 0, 0, 0);
	$blanc = imagecolorallocate($image, 255, 255, 255);
	
	imagepng($image);
?&gt;

Une chose très importante à noter : la 1re fois que je fais appel à la fonction imagecolorallocate(), cette couleur devient la
couleur de fond de mon image.
Donc, ce code doit créer une image... toute orange ! 

Note : si j'avais voulu que le fond soit par exemple blanc et non orange, il aurait fallu placer $blanc en premier.

Voilà, tout pour les couleurs (??!).

2.) Ecrire du texte

Pour écrire du texte sur cette magnifique image orange, on doit utiliser la fonction imagestring(). Cette fonction prend bcp de
paramètres. Elle s'utilise comme ceci :

&lt;?php
imagestring($image, $police, $x, $y, $texte_a_ecrire, $couleur);
?&gt;

Note : Il existe aussi la fonction imagestringup() qui fonctionne exactement de la même manière, sauf qu'elle écrit le texte
verticalement et non horizontalement.

Voici le détail des paramètres : 

	-	$image : la variable qui contient l'image
	-	$police : c'est la police de caractères que l'on veut utiliser. Je dois mettre un nombre de 1 à 5; 1 = petit, 5 = grand. Il
					est aussi possible d'utiliser une police de caractères personnalisée, mais il faut avoir les polices dans un
					format spécial (trop long à expliquer, on va se contenter des polices par défaut)
	-	$x et $y : ce sont les coordonnées auxquelles je souhaite placer mon texte sur l'image, sachant que le point de coordonnées
					(0, 0) représente le coin supérieur gauche de mon image
	-	$text_a_ecrire : le texte que je souhaite écrire
	-	$couleur : c'est une couleur comme celles que j'ai créées plus haut
	
VOici un exemple de ce qu'on peut faire :

&lt;?php
header('Content-type: image/png');
$image = imagecreate(200, 50);

$orange = imagecolorallocate($image, 255, 128, 0);
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 4, 35, 15, 'Hello the world !', $blanc);

imagepng($image);

?&gt;
			
<h2>	
IV./ Dessiner une forme
</h2>
1.) ImageSetPixel

Le rôle de la fonction ImageSetPixel() : dessiner un pixel aux coordonnées (x,y).

On procède comme suit : 

ImageSetPixel($image, $x, $y, $couleur);

2.) ImageLine 

Cette fonction sert à dessiner une ligne entre deux points de coordonnées (x1, y1) et (x2, y2) :

ImageLine($image, $x1, $y1, $x2, $y2, $couleur);

3.) ImageEllipse 

==>

ImageEllipse($image, $x, $y, $largeur, $hauteur, $couleur);

Cette fonction dessine une ellipse dont le centre est aux coordonnées (x,y), de largeur $largeur et de hauteur $hauteur).

4.) ImageRectangle

==>

ImageRectangle($image, $x1, $y1, $x2, $y2, $couleur);

La fonction ImageRectagle() dessine un rectangle, dont le coin en haut à gauche est aux coordonnées $(x_1,y_1)$ et celui en bas
à droite $(x_2,y_2)$.

5.) ImagePolygon

==>

ImagePoligon($image, $array_points, $nombre_de_points, $couleur);

Cette fonction dessine un polygone ayant un nombre de points égal à $nombre_de_points (par exemple, un triangle ==> 3 points). 
L'array $array_points contient les coordonnées de tous les points du polygone dans l'ordre : 

$x_1$, $y_1, $x_2$, $y_2$, $x_3$, $y_3$, $x_4$, $y_4$, etc.

Exemple : 

$points = array(10, 40, 120, 50, 160, 160);


ImagePolygon($image, $points, 3, $noir);  // Pour dessiner un triangle

<h2>
V./ Des fonctions encore plus puissantes
</h2>
Il y a d'autres fonctions qui permetent de réaliser des opérations autrement plus complexes.

Je vais apprendre à : 

	-	Rendre une image transparente
	-	mélanger deux images
	-	redimensionner une image, pour créer une miniature par exemple
	
1.) Rendre une image transparente

Tout d'abord, il faut savor que seul le PNG peut être rendu transparent. En effet, un des gros défauts du JPEG est qu'il ne 
supporte pas la transparence. Je vais donc ici travailler sur un PNG.

Pour rendre une image transparente, il suffit d'utiliser la fonction : 

&lt;?php
imagecolortransparent($image, $couleur);
?&gt;

Le second paramètre est la couleur que l'on veut rendre transparente.

Je vais reprendre l'exemple de l'image où j'avais écrit "Hello the world !" sur un vieux fond orange, et je vais y rajouter
la fonction imagecolortransparent() pour rendre ce fond transparent : 

&lt;?php

header('Content-type: image/png');
$image = imagecreate(200, 50);

$orange = imagecolorallocate($image, 255, 128, 0); // Le fond est orange, car c'est la 1re couleur
$bleu = imagecolorallocate($image, 0, 0, 255);
$bleuclair = imagecolorallocate($image, 156, 227, 254);
$noir = imagecolorallocate($image, 0, 0, 0);
$blanc = imagecolorallocate($image, 255, 255, 255);

imagestring($image, 4, 35, 15, 'Hello the world !', $noir);
imagecolortransparent($image, $orange);		// On rend le fond orange transparent

imagepng($image);

?&gt;

2.) Mélanger deux images

La fonction imagecopymerge() permet de "fusionner" deux images, le principe étant de jouer sur un effet de transparence.

Je vais ici fusionner un logo avec une image affichant un coucher de soleil. 

Voici comment on procède : 

&lt;?php

header('Content-type: image/jpeg');	// L'image que je vais créer est un jpeg

// On charge d'abord les images
$source = imagecreatefrompng("logo.png");	// Le logo est la source
$destination = imagecreatefromjpeg('couchersoleil.jpg'); 	// La photo est la destination 

// Les fonctions imagex et imagey renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destnation = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On veut placer le logo en bas à droite, on calcule les coordonnées où on doit placer le logo sur la photo 
$destination_x = $largeur_destination - $largeur_source;
$destination_y = $hauteur_destination - $hauteur_source;

// On met le logo (la source) dans l'image de destination (la photo)
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 60);

// On affiche l'image de destination qui a été fusionnée avec le logo
imagejpeg($destination);

?&gt;

Les paramètres à donner à la fonction sont, dans l'ordre, les suivants : 

	1.L'image de destination : ici, $destination, la photo. C'est l'image qui va être modifiée et dans laquelle je vais mettre le logo
	2.L'image source : ici $source, c'est mon logo. Cette image n'est pas modifiée
	3.L'abscisse à laquelle je désire placer le logo sur la photo
	4.L'odonnée à laquelle je désire placer le logo sur la photo
	5.L'abscisse de la source : en fait, la fonction imagecopymerge permet aussi de ne prendre qu'une partie de l'image source. Pour
				prendre toute l'image on met l'abscisse à 0...
	6.L'odonnée de la source : ... et l'ordonnée aussi à 0
	7.La largeur de la source : là aussi, l'image peut être tronquée
	8.La hauteur de la source
	9.Le pourcentage d'opacité : c'est un nombre entre 0 et 100 qui indique la transparence de mon logo sur la photo. Si je
				mets 0, le logo sera invisible (totalement transparent), et si je mets 100, il sera totalement opaque. Un nombre
				autour de 60-70, c'est pas mal.
				
Concrètement, on peut se servir de ce code pour faire une page copyright.php. Cette page prendra un paramètre : le nom de l'image
à "copyrighter".

Par exemple, si je veux "copyrighter" automatiquement tropiques.jpg, j'afficherai l'image comme ceci :

&lt;img src="copyright.php?image=tropiques.jpg" /&gt;

Réf copyright.php

<img src="copyright.php?image=paysage.jpg" alt="Entre ciel et terre" />

3.) Redimensionner l'image

C'est l'une des fonctionnalités les plus intéressantes de la bibiliothèque GD. Ca permet de faire des miniatures de mes images.

Je peux m'en servir par exemple pour faire une galerie de photos. 

Tout d'abord, je vais enlever le header, car je souhaite enregistrer une miniature d'image.
Pour redimensionner une image, je vais utiliser la fonction imagecopyresampled(). C'est une des fonctions les plus poussées car
elle fait bcp de calculs mathématiques pour créer une miniature de bonne qualité. Le résultat est bon, mais cela donne énormément
de travail au processeur. 

Note : cette fonction est donc puissante, mais lente. Tellement lente que certains hébergeurs désactivent la fonction pour
éviter que le serveur ne rame. Il serait suicidaire d'aficher directement l'image à chaque chargement d'une page. Je vais ici
créer la miniature une fois pour toutes et l'enregistrer dans un fichier.

Je vais donc enregistrer ma miniature dans un fichier (mini_couchersoleil.jpg, par exemple).

La seule chose importante : pour créer l'image de la miniature, je n'utiliserai pas imagecreate(), car celle-ci crée une image dont
le nombre de couleurs est limité (256 couleurs maximum). Or, ma miniature contiendra peut-être plus de couleurs que l'image 
originale à cause de calculs mathématiques. 

Je vais donc devoir utiliser une autre fonction dont on n'en a pas encore parlé : imagecreatetruecolor(). Elle fonctionne 
exactement de la même manière que imagecreate mais cette fois, l'image pourra contenir beaucoup plus de couleurs. 

Voici le code que je vais utiliser pour générer la miniature de couchersoleil.jpg : 

&lt;?php

$source = imagecreatefromjpeg('couchersoleil.jpg');	// La photo est la source
$destination = imagecreatetruecolor(200, 150); 	// On crée la miniature vide

$largeur_source = imagex($source);
$hauteur_source = imagey($source);
$largeur_destination = imagex($destnation);
$hauteur_destination = imagey($destination);

// On crée la miniature : 

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

// On enregistre la miniature sour le nom de "mini_couchersoleil.jpg"
imagejpeg($destination, 'mini_couchersoleil.jpg');

?&gt;

Je pourrai ensuite récupérer l'image avec la balise HTML : 

&lt;img src="mini_couchersoleil.jpg" alt="Coucher de soleil" /&gt;

Voici la liste des paramètres détaillés de la fonction imagecopyresampled() :

	1.L'image de destination
	2.L'image source
	3.L'abscisse du point à laquelle je place la miniature sur l'image de destination 
	4.L'ordonnée du point à laquelle je place la miniature sur l'image de destination
	5.L'abscisse du point de la source
	6.L'ordonnée du point de la source
	7.La largeur de la miniature 
	8.La hauteur de la miniature
	9.La largeur de la source
	10.La hauteur de la source
	
<img src="copyright.php" alt="miniature" />
En résumé : 

PHP permet de faire bien plus que de générer des pages Web HTML. En utilisant des extensions, comme la bibliothèque GD, on peut par
exemple générer des images.
Pour qu'une page PHP renvoie une image au lieu d'une page Web, il faut modifier l'en-tête HTTP à l'aide de la fonction header()
qui indiquera alors au navigateur du visiteur l'arrivée d'une image.
Il est possible d'enregistrer l'image sur le disque dur si on le souhaite, ce qui évite d'avoir à la générer à chaque fois qu'on 
appelle la page PHP.
On peut créer des images avec GD à partir d'une image vide ou d'une image déjà existante. 
GD propose des fonctions d'écriture de texte dans une image et de dessin de formes basiques.
Des fonctions plus avancées de GD permettent de fusionner des images ou d'en redimensionner.


	



	
</pre>
</body>
</html>
