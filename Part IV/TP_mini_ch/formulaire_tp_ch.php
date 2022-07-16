<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>TP mini-ch</title>
    <style>
        #messages {
            width: 700px;
            height: 300px;
            border: 1px solid black;
            word-wrap: break-word;
        }

        #mess {
            margin-top: 10px;
            width: 180px;
            height: 100px;
            display: flex;
            align-items: flex-start;
        }
        #messages span {
            font-weight: bold;
            text-decoration: underline;
            font-size: large;
            display:block;
            text-align: center;
        }

        #divInput {
            width: 150px;
        }

        form {
            padding: 10px 10px 0 10px;
            width: 300px;
            height: 165px;
            margin: 10px;
            border: 1px dotted black;
        }

        #pseudo {
            width: 100px;
            margin-down: 10px;
        }

        textarea {
            width: 100px;
        }

        label {
            width: 70px;
            margin-down: 10px;
            display: inline-block;
        }

    </style>
</head>
<body>
    <form method="post" action="minichat_post.php">
        <label for="pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" /><br />
        <div id="mess"><label for="message">Message : </label><textarea name="message" id="message" rows="4"></textarea></div>
        <div id="divInput"><input type="submit" value="Envoyer" /></div>
    </form>
    <div id="messages"><h3>Messages postés par moi-même pour faire un exercice</h3>
    <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=mybdd;charset=utf8', 'root', 'root',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $reponse = $bdd->query('SELECT pseudo, message, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') as date_ '
        		.'FROM mini_ch ORDER BY mini_ID DESC LIMIT 0, 10');

        while($donnees = $reponse->fetch())
            echo '<div>[' . $donnees['date_'] . '] <strong>' . $donnees['pseudo'] . ' : </strong>' . $donnees['message'] . '</div>';

        $reponse->closeCursor();
    ?>
    </div>
</body>
</html>