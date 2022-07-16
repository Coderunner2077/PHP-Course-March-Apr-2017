<?php header('Content-type: text/html; charset=iso-8859-1'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Cr�er des images en PHP</title>
</head>
<body>
<pre>
PHP, � la base, a �t� cr��e pour r�aliser des pages Web. Mais au fur et � mesure, on s'est rendu compte qu'il serait dommage de se
limiter � cela. On a donc pr�vu de pouvoir lui ajouter des extensions. Ainsi, en rajoutant certains fichiers (DLL sous Windows), PHP
peut se mettre � g�n�rer des images, ou m�me des PDF ! 

Dans ce chapitre, je parlerai de l'extension sp�cialis�e dans la g�n�ration d'images : la biblioth�que GD.

<h2>
I./ Activer la biblioth�que
</h2>
J'aurai tout d'abord, un petit probl�me � r�gler : la biblioth�que GD est livr�e avec PHP, mais elle n'est pas activ�e. La
proc�dure � suivre est la m�me que pour activer PDO (cf les bdd).

Les h�bergeurs gratuits, g�n�ralement, d�sactivent GD parce que �a consomme beaucoup de ressources du processeur.

Si des dizaines de sites se mettent � g�n�rer des images en m�me temps, �a risquerait de faire ramer toute la machine et donc de
ralentir tous les autres sites.

Sinon, y a s�rement quelques uns qui acceptent la biblio GD. Ou alors ==> se tourner vers les h�bergeurs payants, on peut en trouver
des pas chers qui acceptent la biblioth�que GD. 

<h2>
II./ Les bases de cr�ation d'image
</h2>

Voici le plan que je vais suivre pour cr�er une image :

	-	je vais d�couvrir ce qu'est un header
	-	ensuite, cr�er l'image de base
	-	voir comment on affiche l'image correctement
	
1.) Le header

Il y a deux fa�ons de g�n�rer une image en PHP : 

	-	Soit je fais en sorte que mon script PHP renvoie une image (au lieu d'une page Web, comme on en avait l'habitude). 
	-	Soit je demande � PHP d'enregistrer l'image dans un fichier.
	
	
Dans les deux cas, j'utiliserai exactement les m�mes fonctions.

Je vais commencer par la 1re fa�on de g�n�rer l'image, ie je vais faire en sorte que mon script "renvoie" une image au lieu d'une
page Web.

Pour que le navigateur sache que c'est une image et non pas une page HTML qu'il doit afficher, il va falloir envoyer ce qu'on appelle
un header. Gr�ce � la fonction header, je vais "dire" au navigateur que je suis en train d'envoyer une image : 

Les deux types d'images les plus courants sur le Web sont le JPG et le PNG. Le 1er est � privil�gier uniquement s'il s'agit de 
photos. Le second est �galement en quelque sorte le "rempla�ant" du format "GIF".

Voici le code PHP qu'il faut mettre pour "annoncer" au navigateur que je vais envoyer une image PNG :

&lt;?php header('Content-type: image/png'); ?&gt;

Attention : cette fonction doit �tre appel�e avant toute balise HTML.

2.) Cr�er l'image de base

Il faut savoir qu'il y a deux fa�ons de cr�er une image : soit je cr�e une nouvelle image vide, soit je charge une image qui
existe d�j� et qui servira de fond pour ma nouvelle image.

a./ A partir d'une image vide

On va commencer par cr�er une image vide.

Pour cr�er une image vide en PHP, on utilise la fonction imagecreate().

Cette fonction est simple. Elle prend deux param�tres : la largeur et la hauteur de l'image que je souhaite cr�er. Elle renvoie une
information que je dois mettre dans une variable (par exemple, $image). Ce qui donne :

&lt;?php
	header('Content-type: image/png');
	$image = imagecreate(200, 50);
?&gt;

$image ne contient ni un nombre, ni du texte. Cette variable contient une "image".

Note : on dit que $image est une "ressource". Une ressource est une variable un peu sp�ciale qui contient toutes les informations 
sur un objet. Ici, il s'agit d'une image, mais il pourrait tr�s bien s'agir d'un PDF ou m�me d'un fichier ouvert avec fopen().

b./ A partir d'une image existante

Maintenant, l'autre possibilit� : cr�er une image � partir d'une image d�j� existante. Cette fois, il y a deux fonctions � conna�tre.
Laquelle choisir ? Ca d�pend du format de l'image que je veux charger :

	-	imagecreatefromjpeg() : pour le format JPEG
	-	imagecreatefrompng() : pour le format PNG
	
Pour cr�er une nouvelle image � partir d'une image existante, disons au format JPEG, je dois donc utiliser la fonction
imagecreatefromjpeg(). Ca me donnerait le code suivant : 

&lt;?php
	header('Content-type: image/jpeg');
	$image = imagecreatefromjpeg('couchersoleil.jpg');
?&gt;

Voil�, je sais cr�er une nouvelle image. Je vais maintenant voir comment afficher l'image que je viens de cr�er.

3.) Quand on a termin� : on affiche l'image

Une fois l'image charg�e, je peux m'amuser � y �crire du texte, � dessiner des cercles, des carr�s, etc. (� voir plus loin).

Pour dire � PHP que l'on souhaite afficher l'image, il existe encore le choix entre deux fonctions, selon le format de l'image :

	-	imagejpeg() : pour le format JPEG
	-	imagepng() : pour le format PNG

Ces deux fonctions s'utilisent de la m�me mani�re : j'ai juste besoin d'indiquer l'image que je veux afficher.

Comme dit plus haut, il y a deux fa�ons d'afficher les images en PHP : je peux les afficher directement apr�s les avoir 
cr��es, ou les enregistrer sur le disque pour pouvoir les r�-afficher plus tard, sans avoir � refaire tous les calculs.

4.) Afficher directement l'image

C'est la m�thode que l'on va utiliser dans  ce chapitre. Quand la page PHP est ex�cu�e, elle m'affiche l'image que je lui ai
demand� de cr�er. 

Alor, voici le code complet que j'utilise pour cr�er une nouvelle image PNG de taille 200x50 et l'afficher directement : 

&lt;?php
	header('Content-type: image/png');	// On indique qu'on va envoyer une image PNG
	$image = imagecreate(200, 50);	// on cr�e une nouvelle image
	// Ici, on peut modifier cette image �ventuellement
	imagepng($image);	// et enfin, on demande � afficher l'image
?&gt;

Ensuite, afin d'int�grer cette image dans la page html avec tout ce que l'on veut autour, on utilise une technique tr�s simple :

&lt;image src="image.php" /&gt; <!-- en supposant que l'adresse URL de la page PHP est "image.php" -->

En effet, <strong>on demande � afficher la page PHP comme une image</strong>. Et c'est logique, �tand donn� que la page PHP
que l'on vient de cr�er EST une image (puisqu'on a modifi� le header). On peut donc afficher l'image que l'on vient de cr�er 
depuis n'importe quelle page de mon site en utilisant simplement la balise  &lt;img /&gt;.

Le gros avantage de cette technique, c'est que l'image affich�e pourra changer � chaque fois !

5.) Enregistrer l'image sur le disque 

Si, au lieu d'afficher directement l'image, je pr�f�re l'enregistrer sur le disque, alors il faut ajouter un param�tre � la fonction
imagepng() : le nom de l'image et �ventuellement son dossier. Par contre, dans ce cas, mon script PHP ne va plus renvoyer une
image (il va juste en enregistrer une sur le disque). Attention, je ne fais alors plus appel � la fonction header() dont on n'a
plus besoin dans ce cas de figure. Ce qui donne : 

&lt;?php
	$image = imagecreate(200, 50);
	// modifs �ventuels
	imagepng($image, 'images/monimage.png');
?&gt;

Cette fois, l'image a �t� enregistr�e sur le disque avec le nom "monimage.png". Pour l'afficher depuis une autre page Web, je ferai
comme ceci : 

&lt;img src="images/monimage.png" /&gt;

Cette technique a l'avantage de ne pas n�cessiter de recalculer l'image � chaque fois (mon serveur aura moins de travail), mais
le d�faut c'est qu'une fois qu'elle est enregistr�e, l'image ne change plus.

Il est grand temps d'apporter un peu de d�cor � tout cela.

<h2>
III./ Texte et couleur
</h2>
Je vais maintenant apprendre � manipuler les couleurs, �crire du texte. Il s'agira d'abord de voir ce qu'il est possible de 
faire avec la biblioth�que GD, mais on verra plus loin qu'on peut faire bien plus.

1.) Manipuler les couleurs

Pour d�finir une couleur en PHP, on doit utiliser la fonction imagecolorallocate(). 

On lui donne quatre param�tres : 

	l'image sur laquelle on travaille, la quantit� de rouge, la quantit� de vert, et la quantit� de bleu.
	
Cette fonction me renvoie la couleur dans une variable. Gr�ce � cette fonction, on va pouvoir cr�er des "variables-couleur" qui
serviront � indiquer ensuite la couleur.

Voici quelques exemples de cr�ation de couleur : 

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

Une chose tr�s importante � noter : la 1re fois que je fais appel � la fonction imagecolorallocate(), cette couleur devient la
couleur de fond de mon image.
Donc, ce code doit cr�er une image... toute orange ! 

Note : si j'avais voulu que le fond soit par exemple blanc et non orange, il aurait fallu placer $blanc en premier.

Voil�, tout pour les couleurs (??!).

2.) Ecrire du texte

Pour �crire du texte sur cette magnifique image orange, on doit utiliser la fonction imagestring(). Cette fonction prend bcp de
param�tres. Elle s'utilise comme ceci :

&lt;?php
imagestring($image, $police, $x, $y, $texte_a_ecrire, $couleur);
?&gt;

Note : Il existe aussi la fonction imagestringup() qui fonctionne exactement de la m�me mani�re, sauf qu'elle �crit le texte
verticalement et non horizontalement.

Voici le d�tail des param�tres : 

	-	$image : la variable qui contient l'image
	-	$police : c'est la police de caract�res que l'on veut utiliser. Je dois mettre un nombre de 1 � 5; 1 = petit, 5 = grand. Il
					est aussi possible d'utiliser une police de caract�res personnalis�e, mais il faut avoir les polices dans un
					format sp�cial (trop long � expliquer, on va se contenter des polices par d�faut)
	-	$x et $y : ce sont les coordonn�es auxquelles je souhaite placer mon texte sur l'image, sachant que le point de coordonn�es
					(0, 0) repr�sente le coin sup�rieur gauche de mon image
	-	$text_a_ecrire : le texte que je souhaite �crire
	-	$couleur : c'est une couleur comme celles que j'ai cr��es plus haut
	
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

Le r�le de la fonction ImageSetPixel() : dessiner un pixel aux coordonn�es (x,y).

On proc�de comme suit : 

ImageSetPixel($image, $x, $y, $couleur);

2.) ImageLine 

Cette fonction sert � dessiner une ligne entre deux points de coordonn�es (x1, y1) et (x2, y2) :

ImageLine($image, $x1, $y1, $x2, $y2, $couleur);

3.) ImageEllipse 

==>

ImageEllipse($image, $x, $y, $largeur, $hauteur, $couleur);

Cette fonction dessine une ellipse dont le centre est aux coordonn�es (x,y), de largeur $largeur et de hauteur $hauteur).

4.) ImageRectangle

==>

ImageRectangle($image, $x1, $y1, $x2, $y2, $couleur);

La fonction ImageRectagle() dessine un rectangle, dont le coin en haut � gauche est aux coordonn�es $(x_1,y_1)$ et celui en bas
� droite $(x_2,y_2)$.

5.) ImagePolygon

==>

ImagePoligon($image, $array_points, $nombre_de_points, $couleur);

Cette fonction dessine un polygone ayant un nombre de points �gal � $nombre_de_points (par exemple, un triangle ==> 3 points). 
L'array $array_points contient les coordonn�es de tous les points du polygone dans l'ordre : 

$x_1$, $y_1, $x_2$, $y_2$, $x_3$, $y_3$, $x_4$, $y_4$, etc.

Exemple : 

$points = array(10, 40, 120, 50, 160, 160);


ImagePolygon($image, $points, 3, $noir);  // Pour dessiner un triangle

<h2>
V./ Des fonctions encore plus puissantes
</h2>
Il y a d'autres fonctions qui permetent de r�aliser des op�rations autrement plus complexes.

Je vais apprendre � : 

	-	Rendre une image transparente
	-	m�langer deux images
	-	redimensionner une image, pour cr�er une miniature par exemple
	
1.) Rendre une image transparente

Tout d'abord, il faut savor que seul le PNG peut �tre rendu transparent. En effet, un des gros d�fauts du JPEG est qu'il ne 
supporte pas la transparence. Je vais donc ici travailler sur un PNG.

Pour rendre une image transparente, il suffit d'utiliser la fonction : 

&lt;?php
imagecolortransparent($image, $couleur);
?&gt;

Le second param�tre est la couleur que l'on veut rendre transparente.

Je vais reprendre l'exemple de l'image o� j'avais �crit "Hello the world !" sur un vieux fond orange, et je vais y rajouter
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

2.) M�langer deux images

La fonction imagecopymerge() permet de "fusionner" deux images, le principe �tant de jouer sur un effet de transparence.

Je vais ici fusionner un logo avec une image affichant un coucher de soleil. 

Voici comment on proc�de : 

&lt;?php

header('Content-type: image/jpeg');	// L'image que je vais cr�er est un jpeg

// On charge d'abord les images
$source = imagecreatefrompng("logo.png");	// Le logo est la source
$destination = imagecreatefromjpeg('couchersoleil.jpg'); 	// La photo est la destination 

// Les fonctions imagex et imagey renvoient la largeur et la hauteur d'une image
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
$largeur_destnation = imagesx($destination);
$hauteur_destination = imagesy($destination);

// On veut placer le logo en bas � droite, on calcule les coordonn�es o� on doit placer le logo sur la photo 
$destination_x = $largeur_destination - $largeur_source;
$destination_y = $hauteur_destination - $hauteur_source;

// On met le logo (la source) dans l'image de destination (la photo)
imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 60);

// On affiche l'image de destination qui a �t� fusionn�e avec le logo
imagejpeg($destination);

?&gt;

Les param�tres � donner � la fonction sont, dans l'ordre, les suivants : 

	1.L'image de destination : ici, $destination, la photo. C'est l'image qui va �tre modifi�e et dans laquelle je vais mettre le logo
	2.L'image source : ici $source, c'est mon logo. Cette image n'est pas modifi�e
	3.L'abscisse � laquelle je d�sire placer le logo sur la photo
	4.L'odonn�e � laquelle je d�sire placer le logo sur la photo
	5.L'abscisse de la source : en fait, la fonction imagecopymerge permet aussi de ne prendre qu'une partie de l'image source. Pour
				prendre toute l'image on met l'abscisse � 0...
	6.L'odonn�e de la source : ... et l'ordonn�e aussi � 0
	7.La largeur de la source : l� aussi, l'image peut �tre tronqu�e
	8.La hauteur de la source
	9.Le pourcentage d'opacit� : c'est un nombre entre 0 et 100 qui indique la transparence de mon logo sur la photo. Si je
				mets 0, le logo sera invisible (totalement transparent), et si je mets 100, il sera totalement opaque. Un nombre
				autour de 60-70, c'est pas mal.
				
Concr�tement, on peut se servir de ce code pour faire une page copyright.php. Cette page prendra un param�tre : le nom de l'image
� "copyrighter".

Par exemple, si je veux "copyrighter" automatiquement tropiques.jpg, j'afficherai l'image comme ceci :

&lt;img src="copyright.php?image=tropiques.jpg" /&gt;

R�f copyright.php

<img src="copyright.php?image=paysage.jpg" alt="Entre ciel et terre" />

3.) Redimensionner l'image

C'est l'une des fonctionnalit�s les plus int�ressantes de la bibilioth�que GD. Ca permet de faire des miniatures de mes images.

Je peux m'en servir par exemple pour faire une galerie de photos. 

Tout d'abord, je vais enlever le header, car je souhaite enregistrer une miniature d'image.
Pour redimensionner une image, je vais utiliser la fonction imagecopyresampled(). C'est une des fonctions les plus pouss�es car
elle fait bcp de calculs math�matiques pour cr�er une miniature de bonne qualit�. Le r�sultat est bon, mais cela donne �norm�ment
de travail au processeur. 

Note : cette fonction est donc puissante, mais lente. Tellement lente que certains h�bergeurs d�sactivent la fonction pour
�viter que le serveur ne rame. Il serait suicidaire d'aficher directement l'image � chaque chargement d'une page. Je vais ici
cr�er la miniature une fois pour toutes et l'enregistrer dans un fichier.

Je vais donc enregistrer ma miniature dans un fichier (mini_couchersoleil.jpg, par exemple).

La seule chose importante : pour cr�er l'image de la miniature, je n'utiliserai pas imagecreate(), car celle-ci cr�e une image dont
le nombre de couleurs est limit� (256 couleurs maximum). Or, ma miniature contiendra peut-�tre plus de couleurs que l'image 
originale � cause de calculs math�matiques. 

Je vais donc devoir utiliser une autre fonction dont on n'en a pas encore parl� : imagecreatetruecolor(). Elle fonctionne 
exactement de la m�me mani�re que imagecreate mais cette fois, l'image pourra contenir beaucoup plus de couleurs. 

Voici le code que je vais utiliser pour g�n�rer la miniature de couchersoleil.jpg : 

&lt;?php

$source = imagecreatefromjpeg('couchersoleil.jpg');	// La photo est la source
$destination = imagecreatetruecolor(200, 150); 	// On cr�e la miniature vide

$largeur_source = imagex($source);
$hauteur_source = imagey($source);
$largeur_destination = imagex($destnation);
$hauteur_destination = imagey($destination);

// On cr�e la miniature : 

imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);

// On enregistre la miniature sour le nom de "mini_couchersoleil.jpg"
imagejpeg($destination, 'mini_couchersoleil.jpg');

?&gt;

Je pourrai ensuite r�cup�rer l'image avec la balise HTML : 

&lt;img src="mini_couchersoleil.jpg" alt="Coucher de soleil" /&gt;

Voici la liste des param�tres d�taill�s de la fonction imagecopyresampled() :

	1.L'image de destination
	2.L'image source
	3.L'abscisse du point � laquelle je place la miniature sur l'image de destination 
	4.L'ordonn�e du point � laquelle je place la miniature sur l'image de destination
	5.L'abscisse du point de la source
	6.L'ordonn�e du point de la source
	7.La largeur de la miniature 
	8.La hauteur de la miniature
	9.La largeur de la source
	10.La hauteur de la source
	
<img src="copyright.php" alt="miniature" />
En r�sum� : 

PHP permet de faire bien plus que de g�n�rer des pages Web HTML. En utilisant des extensions, comme la biblioth�que GD, on peut par
exemple g�n�rer des images.
Pour qu'une page PHP renvoie une image au lieu d'une page Web, il faut modifier l'en-t�te HTTP � l'aide de la fonction header()
qui indiquera alors au navigateur du visiteur l'arriv�e d'une image.
Il est possible d'enregistrer l'image sur le disque dur si on le souhaite, ce qui �vite d'avoir � la g�n�rer � chaque fois qu'on 
appelle la page PHP.
On peut cr�er des images avec GD � partir d'une image vide ou d'une image d�j� existante. 
GD propose des fonctions d'�criture de texte dans une image et de dessin de formes basiques.
Des fonctions plus avanc�es de GD permettent de fusionner des images ou d'en redimensionner.


	



	
</pre>
</body>
</html>
