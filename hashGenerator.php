
<?php
if (isset($_POST['pseudo']) and isset($_POST['password']) and isset($_POST['verif'])) {
    if ($_POST['pseudo'] != '' and $_POST['password'] != '' and $_POST['verif'] != '') {
        $password = $_POST['password'];
        $verif = $_POST['verif'];
        $pseudo = $_POST['pseudo'];

        if ($password === $verif) {
            $password = htmlspecialchars(password_hash($password, PASSWORD_DEFAULT));
            $pseudo = htmlspecialchars($pseudo);
            $hash_line = $pseudo . ':' . $password;
            unset($password, $verif, $pseudo,  $_POST);
        } else {
            $error = 'Les mots de passe ne correspondent pas.';
            unset($password, $verif, $pseudo, $_POST);
        }
    } else {
        $error = 'Le formulaire n\'est pas bon';
        unset($password, $verif, $pseudo, $_POST);
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hashGenerator</title>
</head>
<body>

<h1>Générateur htaccess</h1>

<div class="form">
    <form action="" method="post">
        <label for="pseudo">Nom d'utilisateur</label>
        <input type="text" name="pseudo">
        <label for="password">Mot de passe</label>
        <input type="text" name="password">
        <label for="verif">Vérification mot de passe</label>
        <input type="text" name="verif">
        <input class="btn" type="submit" value="Générer" class="submit">
</div>

<?php
if (isset($error)) {
    echo '<div class="error">' . $error . '</div>';
    unset($error);
}
?>

<div class="line">
    <?php if (isset($hash_line)) {
        echo '<span id="tocopy">' . $hash_line . '</span>';
        unset($hash_line);
        echo ' <button class="btn" data-target="#tocopy">Copier dans le presse-papier</button>';
    } ?>


</div>

</body>
<script>
    let btn = document.querySelector(".btn");

    if (btn) {
        btn.addEventListener('click', docopy);
    }

    function docopy() {

        // Cible de l'élément qui doit être copié
        var target = this.dataset.target;
        var fromElement = document.querySelector(target);
        if (!fromElement) return;

        // Sélection des caractères concernés
        var range = document.createRange();
        var selection = window.getSelection();
        range.selectNode(fromElement);
        selection.removeAllRanges();
        selection.addRange(range);

        try {
            // Exécution de la commande de copie
            var result = document.execCommand('copy');
            if (result) {
                // La copie a réussi
                alert('Copié !');
            }
        } catch (err) {
            // Une erreur est surevnue lors de la tentative de copie
            alert(err);
        }

        // Fin de l'opération
        selection = window.getSelection();
        if (typeof selection.removeRange === 'function') {
            selection.removeRange(range);
        } else if (typeof selection.removeAllRanges === 'function') {
            selection.removeAllRanges();
        }
    }


</script>
  <style>
      h1{
          text-align: center;
      }

      .form{
          margin-left: auto;
          margin-right: auto;
          width: 50%;
      }

      form{
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
      }

      input, label{
          width: 50%;
      }

      input{
          padding-bottom: 10px;
      }

      .submit{
          width: auto;
      }

      .error{
          color: red;
          text-align: center;
      }

      .line{
          padding-top: 20px;
          height: 50px;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          align-items: center;
      }

      .btn{
          width: auto;
          padding-top: 5px;
          margin-top: 20px;
      }

      span{
          font-weight: bold;
      }

  </style>
</html>

