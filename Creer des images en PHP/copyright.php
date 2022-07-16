<?php
/*
if(isset($_GET['image'])) {
	$source = imagecreatefrompng('logo.png');
	$destination = imagecreatefromjpeg(htmlspecialchars($_GET['image']));
	
	$destination_x = imagesx($destination) - imagesx($source);
	$destination_y = imagesy($destination) - imagesy($source);
	
	imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, imagesx($source), imagesy($source), 20);
	imagejpeg($destination, 'image_copyrightee.jpg');
} else {
*/
	/*
	$source = imagecreatefromjpeg('couchersoleil.jpg');
	$destination = imagecreatetruecolor(200, 150);
	
	$largeur_s = imagesx($source);
	$hauteur_s = imagesy($source);
	$largeur_d = imagesx($destination);
	$hauteur_d = imagesy($destination);
	
	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);
	imagejpeg($destination, 'mini_paysage.jpg');
	*/
	header('Content-type: image/png');
	$image = imagecreate(301, 201);
	
	
	$noir = imagecolorallocate($image, 0, 0, 0);
	$bleu = imagecolorallocate($image, 0, 0, 255);
	$blanc = imagecolorallocate($image, 255, 255, 255);
	$rouge = imagecolorallocate($image, 255, 0, 0);
	ImagefilledRectangle($image, 0, 0, 100, 200, $bleu);
	ImagefilledRectangle($image, 100, 0, 200, 200, $blanc);
	imagefilledrectangle($image, 200, 0, 300, 200, $rouge);
	imagerectangle($image, 0, 0, 300, 200, $noir);
	imagestring($image, 5, 30, 50, 'Liberté  Egalité   Fraternité', $noir);
	//imagecolortransparent($image, $noir);
	
	imagepng($image);
