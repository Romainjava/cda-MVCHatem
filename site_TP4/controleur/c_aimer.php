<?php 
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
$action = filter_input(INPUT_GET, 'action');
$mailU = getMailULoggedOn();

$unResto = getRestoByIdR($idR);

$lesTypesCuisine = getTypesCuisineByIdR($idR);
$lesPhotos = getPhotosByIdR($idR);
$noteMoy = round(getNoteMoyenneByIdR($idR), 0);

$aimer = getAimerById($mailU, $idR);
$critiques = getCritiquerByIdR($idR);

if($mailU && $idR){
    if($action = "aimer"){      
        delAimer($idR);
    }else if($action = "notaimer"){
        addAimer($mailU,$idR);
    }
}
include "$racine/vue/vueDetailResto.php";
header("location: ".$_SERVER["HTTP_REFERER"]);