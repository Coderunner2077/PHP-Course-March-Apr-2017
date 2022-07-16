<?php
    if(isset($_POST['pseudo']) AND isset($_POST['message']) AND trim($_POST['message']) != '') {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $message = htmlspecialchars($_POST['message']);

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('INSERT INTO mini_ch(pseudo, message, date_creation) VALUES(:pseudo, :message, NOW())');
        $req->execute(array('pseudo' => $pseudo, 'message' => $message));
        $req->closeCursor();
    }
    header('Location: formulaire_tp_ch.php');
    ?>