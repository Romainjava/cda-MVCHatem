<?php

function controleurPrincipal($action){
    $lesActions = array();
    $lesActions["defaut"] = "listeRestos.php";
    $lesActions["liste"] = "listeRestos.php";
    $lesActions["detail"] = "detailResto.php";
    $lesActions["recherche"] = "rechercheResto.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "monProfil.php";
    $lesActions['cgu'] = "cgu.php";
    $lesActions['inscription'] = "inscription.php";
    $lesActions['ban'] = "c_gestionUtilisateur.php";
    $lesActions['unban'] = "c_gestionUtilisateur.php";
    $lesActions['aimer'] = "c_aimer.php";
    $lesActions['notaimer'] = "c_aimer.php";
    $lesActions['noter'] = "c_note.php";
    $lesActions['commenter'] = "c_note.php";
    // ici on rediriger vers le bon controler
    
    if (array_key_exists ( $action , $lesActions )){
        return $lesActions[$action];
    }
    else{
        return $lesActions["defaut"];
    }

}

?>