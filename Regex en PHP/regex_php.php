<?php header('Content-type: text/html; charset="utf-8"')?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Les regex en PHP</title>
</head>
<body>
<pre>
Il existe deux types de regex en PHP :

	-	POSIX : c'est un langage d'expression régulière mis en avant par PHP, qui se veut un peu plus simple que PCRE (ça n'en reste 
				pas moins assez complexe). Toutefois, son principal et gros défaut, c'est que ce langage est plus lent que PCRE
	-	PCRE : ces regex sont issues d'un autre langage (le Perl). Considérées comme un peu plus complexes, elles sont surtout 
				bien plus rapides et performantes.
				
Il s'agira ici essentiellement d'étudier PCRE (comme en JavaScript).

Les fonctions du PHP : il existe plusieurs fonctions utilisant le lange "PCRE" et qui commencent tous par preg_ ==>

	-	preg_grep()
	-	preg_split()
	-	preg_quote()
	-	preg_match() : l'équivalent de la méthode test() en JavaScript
	-	preg_match_all()
	-	preg_replace()
	-	preg_replace_callback()
	
La fonction preg_match() renvoie un booléen en fonction du résultat de la recherche. Elle possède deux paramètres : la regex et la 
chaîne dans laquelle on fait la recherche. 

----------------------------------------------------------------------------------------------------------------------------------------
<h2>Principales différences avec les regex de JavaScript</h2>

1.) Délimiteurs

Première différence avec JavaScript, je peux mettre des '#' pour délimiter la regex, et même des guillemets en plus pour la 
placer en argument d'une fonction (contrairement à JavaScript). Ce qui est intéressant et surprenant, c'est que je peux
mettre n'importe quel caractère spécial en tant que délimiteur (donc pas uniquement des '#').

2.) Echapper les metacaractères dans les classes

Trois cas particuliers :

	-	'#' : il sert toujours à indiquer la fin de la regex. Je dois donc l'échapper avec un anti-slash.
	-	"]" : donc pas le '[' apparemment. (Serait-ce pareil en JavaScript ?!)
	-	'-' : à placer au début ou à la fin (rdn).
	
3.) Les options 

i : il est toujours là (option servant à faire ignorer la casse). 

s : sert à faire prendre en compte par le point ('.' signifiant tout caractère sauf le retour à la ligne) le retour à la ligne 
également.

U : sert à signifier que la recherche est "ungreedy". Attention, c'est un 'U' majuscule. Donc pas de '?' après la quantificateur 
comme en JavaScript.

4.) La parenthèses capturantes

Je peux utiliser jusqu'à 99 parenthèses capturantes (et non pas 9) dans une regex. Ca va donc jusqu'à 99. 

Une variable $0 est toujours créée. Elle contient la chaîne trouvée correspondant à la regex.

Par exemple : #(anti)co(nsti)(tu(tion)nelle)ment# 	: la parenthèse N°3 contient "tutionnelle" et la parenthèse $4 cotient "tion".

Note : C'est dans l'ordre dans lequel les parenthèses sont ouvertes qui est important.


5.) Fonction de remplacement

La fonction preg_replace() accepte trois arguments :

	-	la regex, avec éventuellement des parenthèses capturantes
	-	le texte de remplacement, avec éventuellement des $1, $2, etc.
	-	le texte dans lequel on fait la recherche / remplacement

6.) Pas d'option g

Apparemment, les remplacements multiples se font sans qu'il y ait besoin d'un équivalent à une option g (du JavaScript)

----------------------------------------------------------------------------------------------------------------------------------------
Des regex... avec MySQL

MySQL comprend les regex, mais seulement en langage POSIX, et non pas PCRE.

J'ai besoin de retenir ce qui suit pour faire une regex POSIX : 

	-	Il n'y a pas de délimiteurs, ni d'options. Ma regex n'est pas entourée de dièses 
	-	Il n'y a pas de classes abrégées (comme \d, etc.). En revanche, je peux toujours utiliser le point pour dire "n'importe quel
			caractère"
			
Par exemple, supposons que l'on a stocké les IP de mes visiteurs dans une table visiteurs et que je veux les noms de visiteurs dont
l'IP commence par "88.254" : 

SELECT nom FROM visiteurs WHERE ip REGEXP '^88\.254(\.[0-9]{1, 3}){2}$'

Toute la puissance des regex dans une requête MySQL pour faire une recherche très précise... 

Remarque : 

\w n'inclut pas, contrairement à ce que je croyais, les caractères accentués, y compris en JavaScript.
----------------------------------------------------------------------------------------------------------------------------------------
Exercices 

Exo 1 : 
Numéro de téléphone commençant par 0 suivi de 1-6 ou 8 et composé de 10 chiffres pouvant être espacés ou séparés par un tiré,
un point ==> 

<?php 
if(isset($_POST['tel'])) {
	$_POST['tel'] = htmlspecialchars($_POST['tel']);
	if(preg_match('#^0[1-68](?:[-. ]?\d{2}){4}$#', $_POST['tel'])) 
		echo 'C\'est un tél';
	else
		echo 'C\'est pas un tél';
		
}

?>

<form method="post"> 
<label for="tel">Téléphone</label> : <input type="text" name="tel" id="tel" /><br />
<label for="mail">E-mail</label> : <input type="email" name="mail" id="mail" /><br />
<label for="forum">Texte en BBCode</label> : <textarea rows="10" cols="50" name="forum" id="forum"></textarea>
<input type="submit" value="Vérifier" />
</form>

Note : je n'ai pas spécifié l'attribut action dans le formulaire, ce qui a fait que ce dernier a été envoyé sur la même page.


Exo 2 : 
Une adresse e-mail... ==>

<?php if(isset($_POST['mail'])) {
	$_POST['mail'] = htmlspecialchars($_POST['mail']);
	if(preg_match('#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{4,50}\.[a-zA-Z]{2,6}$#', $_POST['mail']))
		echo 'adresse e-mail correct';
	else
		echo 'adresse e-mail incorrect';
			
}?>

Exo 3 : 
Un parser du BBCode...

<?php if(isset($_POST['forum']) AND trim(htmlspecialchars($_POST['forum']))) {
	$text = stripslashes($_POST['forum']);
	$text = htmlspecialchars($text);
	$text = nl2br($text);
	$text = preg_replace('#(?:https?://w{3}\.|https?://|w{3}\.)[\w._?=&/-]+#i', '<a href="$0">$0</a>', $text); // pas BBCode ici...
	$text = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $text);
	$text = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $text);
	$text = preg_replace('#\[color=([a-z]+)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $text);
	$text = preg_replace('#\[u\](.+)\[/u\]#isU', '<span style="text-decoration:underline">$1</span>', $text);
	echo $text;
}?>

Note : la fonction stripslashes() enlève les antislashes qui se seraient ajoutés automatiquement (par exemple : \' ==> ')

Note2 : la fonction nl2br() crée des &lt;br /&gt; pour conserver les retours à la ligne (sans pour autant qu'il y en ait vraiment
besoin ici, apparemment).


Exo 4:
Complément

<?php if(preg_match('/\w/', 'éàùêçè'))
	echo 'Noap : '; ?>

</pre>
</body>
</html>