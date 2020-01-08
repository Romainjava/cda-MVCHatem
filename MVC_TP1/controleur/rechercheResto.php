<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";

// creation du menu burger
$menuBurger = array();
$menuBurger[] = array("url" => "./?action=recherche&critere=nom", "label" => "Recherche par nom");
$menuBurger[] = array("url" => "./?action=recherche&critere=adresse", "label" => "Recherche par adresse");

// critere de recherche par defaut
$critere = "nom";
if (isset($_GET["critere"])) {
    $critere = $_GET["critere"];
}
Foo::dump($_POST);
// recuperation des donnees GET, POST, et SESSION
// recherche par nom
if (isset($_POST['nomR'])) {
    $nomR = filter_input(INPUT_POST, "nomR");
} else {
    $nomR = "";
}
// recherche par adresse
if (isset($_POST['villeR'])) {
    $villeR = filter_input(INPUT_POST, "villeR");
} else {
    $villeR = "";
}
if (isset($_POST['cpR'])) {
    $cpR = filter_input(INPUT_POST, "cpR");
} else {
    $cpR = "";
}

if (isset($_POST['voieAdrR'])) {
    $voieAdrR = filter_input(INPUT_POST, "voieAdrR");
} else {
    $voieAdrR = "";
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
// Si on provient du formulaire de recherche : $critere indique le type de recherche à effectuer
if (!empty($_POST)) {
    switch ($critere) {
        case 'nom':
            $listeRestos = getRestosByNomR($nomR);

            break;
        case 'adresse':
            $listeRestos = getRestosByAdresse($voieAdrR, $cpR, $villeR);
            break;
    }
}

    // traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Recherche d'un restaurant";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueRechercheResto.php";
if (!empty($listeRestos)) {
    include "$racine/vue/vueResultRecherche.php";
}
include "$racine/vue/pied.html.php";
