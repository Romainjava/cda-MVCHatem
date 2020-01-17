<?php
ini_set('display_errors', 1);

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once 'modele/bd.aimer.inc.php';
include_once "$racine/modele/authentification.inc.php";

include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";

$idR = filter_input(INPUT_GET, 'idR');
$mailU = getMailULoggedOn();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$critique = isNoteByIdRAndMailU($idR, $mailU); // Si la ligne existe ?
$result = 0;

if ($action == "noter") {
    $note = filter_input(INPUT_GET, 'note', FILTER_VALIDATE_INT);
    if ($note) {
        if (!$critique) {
            $result = addNote($mailU, $idR, $note);
        } else {
            $result = updateNote($mailU, $idR, $note);
        }
    }
} else if ($action == "commenter") {
    $commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_STRING);
    if ($commentaire) {
        if (!$critique) {
            $result = addCommentaire($mailU, $idR, $commentaire);
        } else {
            $result = updateCommentaire($mailU, $idR, $commentaire);
        }
    }
}



header("location: index.php?action=detail&idR=".$idR. "&success=".(int)$result);
