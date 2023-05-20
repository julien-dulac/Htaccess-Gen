<?php session_start(); ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>hash Generator</title>
</head>
<body>
<main>

    <h1>Générateur htaccess</h1>

    <div class="form">
        <form id="gen" action="hashGenerator.php" method="post">
            <label for="pseudo">Nom d'utilisateur</label>
            <input type="text" name="pseudo">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="pwd">
            <label for="verif">Vérification mot de passe</label>
            <input type="text" name="verif" id="verif">
            <input class="btn" type="submit" value="Générer" class="submit">
    </div>

    <div id="msg" class="error"> <?php if(isset($_SESSION['error'])){ ?> <?= htmlspecialchars($_SESSION['error']) ?><?php } ?></div>

    <div class="line">
        <?php if (isset($_SESSION['hash'])) {
            echo '<span id="tocopy">' . $_SESSION['hash'] . '</span>';
            unset($_SESSION['hash']);
            echo ' <button class="copie" data-target="#tocopy">Copier dans le presse-papier</button>';
        } ?>
    </div>
</main>
</body>
<script>
    let pwd = document.getElementById('pwd');
    let verif = document.getElementById('verif');
    let error = document.getElementById('msg');
    let gen = document.getElementById('gen');

    pwd.addEventListener('change', verifPassword);

    verif.addEventListener('change', verifPassword);

    gen.addEventListener('submit', function(){
        onSubmit(event);
    });

    function verifPassword(){
        console.log('test');
        if(pwd.value !== verif.value){
            error.innerHTML = 'Les mots de passe ne correspondent pas';
            error.style.color = 'red';
            error.style.fontWeight = 'bold';
        }else{
            error.innerHTML = 'Les mots de passe correspondent';
            error.style.color = '#34C759';
            error.style.fontWeight = 'bold';
        }
    }

    function onSubmit(event){
        if(pwd.value !== verif.value){
            event.preventDefault();
            pwd.focus();
        }

    }
    let btn = document.querySelector(".copie");

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

        // Fin de l'opération
        selection = window.getSelection();
        if (typeof selection.removeRange === 'function') {
            selection.removeRange(range);
        } else if (typeof selection.removeAllRanges === 'function') {
            selection.removeAllRanges();
        }

    }


</script>
</html>

