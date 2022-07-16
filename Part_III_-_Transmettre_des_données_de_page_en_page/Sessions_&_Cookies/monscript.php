<?php
session_start();
echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . ', ' . $_SESSION['age'] . ' ans.';