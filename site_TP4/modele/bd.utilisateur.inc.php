<?php

include_once "bd.inc.php";

function addUtilisateur($mailU, $mdpU, $pseudoU){
    $result = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare('INSERT INTO utilisateur(mailU,mdpU,pseudoU)
                             VALUE (:mail,:mdp,:pseudo)');
        $req->bindParam(':mail',$mailU);
        $req->bindParam(':mdp',$mdpU);
        $req->bindParam(':pseudo',$pseudoU);
        $result = $req->execute();
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}

function getUtilisateurs() {
    $resultat = [];

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * from utilisateur");
        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
        /* while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        } */
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function banUtilisateur($mailU,$etat){
    $resultat = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE utilisateur SET utilisateur.etat = :etat WHERE mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindParam(':etat',$etat);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
   return $resultat;
}

function getUtilisateurByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU('mathieu.capliez@gmail.com') : \n";
    print_r(getUtilisateurByMailU("mathieu.capliez@gmail.com"));


}
