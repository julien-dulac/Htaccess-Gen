<?php
session_start();
if (isset($_POST['pseudo']) and isset($_POST['password']) and isset($_POST['verif'])) {
    if ($_POST['pseudo'] != '' and $_POST['password'] != '' and $_POST['verif'] != '') {
        $password = $_POST['password'];
        $verif = $_POST['verif'];
        $pseudo = $_POST['pseudo'];

        if ($password === $verif) {
            $password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
            $pseudo = htmlspecialchars($pseudo);
            $hash_line = $pseudo . ':' . $password;
            $_SESSION['hash'] = $hash_line;
            unset($password, $verif, $pseudo,  $_POST);
        } else {

            $_SESSION['error'] = 'Les mots de passe ne correspondent pas.';
            unset($password, $verif, $pseudo, $_POST);
        }
    } else {
        $_SESSION['error'] = "Le formulaire n'est pas bon";
        unset($password, $verif, $pseudo, $_POST);
    }
    header("location: index.php");
}

