<?php
include_once "$racine/modele/bd.utilisateur.inc.php";

$mailU = filter_input(INPUT_GET, 'mailU', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

$utilisateurs = getUtilisateurs();
var_dump($action);
if ($mailU && $action == "ban") {
    $result = banUtilisateur($mailU, true);
}else if($mailU && $action == "unban") {
    $result = banUtilisateur($mailU, 0);
}

header("location: ".$_SERVER["HTTP_REFERER"]);