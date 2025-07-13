<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire PHP - Exemple simple</title>
</head>
<body>

<h2>Formulaire d'inscription</h2>

<form method="POST" action="">
    <!-- Champ texte -->
    Nom : <input type="text" name="nom" required><br><br>

    <!-- Champ mot de passe -->
    Mot de passe : <input type="password" name="mdp" required><br><br>

    <!-- Combo box (select) -->
    Sexe :
    <select name="sexe">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Autre">Autre</option>
    </select><br><br>

    <!-- Radio buttons -->
    Abonnement :
    <input type="radio" name="abonnement" value="mensuel">Mensuel
    <input type="radio" name="abonnement" value="annuel">Annuel<br><br>

    <!-- Checkbox -->
    Centres d'intérêt :<br>
    <input type="checkbox" name="interets[]" value="Musique"> Musique<br>
    <input type="checkbox" name="interets[]" value="Sport"> Sport<br>
    <input type="checkbox" name="interets[]" value="Lecture"> Lecture<br><br>

    <!-- Textarea -->
    Commentaires :<br>
    <textarea name="commentaire" rows="4" cols="40"></textarea><br><br>

    <input type="submit" value="Envoyer"> 
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Données reçues :</h3>";

    echo "Nom : " . htmlspecialchars($_POST['nom']) . "<br>";
    echo "Mot de passe : " . htmlspecialchars($_POST['mdp']) . "<br>";
    echo "Sexe : " . htmlspecialchars($_POST['sexe']) . "<br>";
    echo "Abonnement : " . (isset($_POST['abonnement']) ? htmlspecialchars($_POST['abonnement']) : "Aucun") . "<br>";

    echo "Centres d'intérêt : ";
    if (!empty($_POST['interets'])) {
        echo implode(', ', array_map('htmlspecialchars', $_POST['interets']));
    } else {
        echo "Aucun";
    }
    echo "<br>";

    echo "Commentaire : " . nl2br(htmlspecialchars($_POST['commentaire'])) . "<br>";
}
?>

</body>
</html>


<form action="" method="POST">
    <input type="text" name="">
</form>