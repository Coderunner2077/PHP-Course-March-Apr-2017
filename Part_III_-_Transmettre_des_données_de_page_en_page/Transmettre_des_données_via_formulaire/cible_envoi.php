<?php
//Testons si le fichier a bie été envoyé et s'il n'y a pas eu d'erreur
if(isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0) {
    //Testons si le fichier n'est pas trop gros
    if($_FILES['monfichier']['size'] <= 1000000) {
        //Testons si l'extension est autorisée
        $infofichier = pathinfo($_FILES['monfichier']['name']);
        $extension_upload = $infofichier['extension'];
        $extension_upload = strtolower($extension_upload);  // les caractères sont en majuscules...
        $extensions_autorisees = array('png', 'jpg', 'jpeg', 'gif');
        echo $extension_upload .'<br />';
        if(in_array($extension_upload, $extensions_autorisees)) {
            // On valide le fichier en le stockand définitivement
            move_uploaded_file($_FILES['monfichier']['tmp_name'], ('Transmettre_donnees_via_form/uploads/'. basename($_FILES['monfichier']['name'])));
            echo "L'envoi a bien été effectué !";
        }
        else
            echo 'Erreur d\'enregistrement';

    }
    else
        echo 'Fichier trop grand';
}
else
    echo 'Erreur : ' . $_FILES['monfichier']['error'];