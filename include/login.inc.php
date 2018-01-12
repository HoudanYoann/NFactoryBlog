<?php
if(isset($_POST["formulaire"])) {
    $tabErreur = array();
    $mail = $_POST['mail'];
    $mdp = $_POST['mdp'];
    if($_POST["mail"] == "")
        array_push($tabErreur, "Veuillez saisir votre e-mail");
    if($_POST["mdp"] == "")
        array_push($tabErreur, "Veuillez saisir un mot de passe");
    if(count($tabErreur) != 0) {
        $message = "<ul>";
        for($i = 0 ; $i < count($tabErreur) ; $i++) {
            $message .= "<li>" . $tabErreur[$i] . "</li>";
        }
        $message .= "</ul>";
        echo($message);
        include("./include/formlogin.php");
    }
    else {
        $connexion = mysqli_connect("localhost", "root", "", "nfactoryblog");
        if (!$connexion) {
            die("Erreur MySQL " . mysqli_connect_errno() . " : " . mysqli_connect_error());
        }
        else {
            $requete = "INSERT INTO t_users (ID_USER, USERNAME, USERFNAME,
                        USERMAIL, USERPASSWORD, USERDATEINS, T_ROLES_ID_ROLE)
                        VALUES ('$mail', SHA1('$mdp');";
            mysqli_query($connexion, $requete);
            mysqli_close($connexion);
        }
    }
}
else {
    echo("Je viens d'ailleurs");
    include("./include/formlogin.php");
}