<?php

include_once "bd.inc.php";

function getCritiquerByIdR($idR)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM `critiquer` WHERE idR =:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $resultat;
}

function getNoteMoyenneByIdR($idR)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($resultat["avg(note)"] != NULL) {
        return $resultat["avg(note)"];
    } else {
        return 0;
    }
}

function isNoteByIdRAndMailU($idR, $mailU)
{
    $resultat = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT 1 FROM `critiquer` WHERE idR =:idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        $resultat = $req->fetchColumn();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $resultat;
}


function getNoteByIdRAndMailU($idR, $mailU)
{
    $resultat = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT note FROM `critiquer` WHERE idR =:idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        $resultat = $req->fetchColumn();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $resultat;
}

function getCommentByIdRAndMailU($idR, $mailU)
{
    $resultat = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT commentaire FROM `critiquer` WHERE idR =:idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        $resultat = $req->fetchColumn();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $resultat;
}

function addCommentaire($mailU, $idR, $commentaire)
{
    $result = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO critiquer(idR,mailU,commentaire)
                                VALUES (:idR,:mailU,:commentaire)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
         $result =$req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}

function updateCommentaire($mailU, $idR, $commentaire)
{
    $result = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE critiquer SET commentaire = :commentaire WHERE idR = :idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $result =$req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}

function addNote($mailU, $idR, $note)
{
    $result = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO critiquer(idR,mailU,note)
                                VALUES (:idR,:mailU,:note)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':note', $note, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
         $result =$req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}

function updateNote($mailU, $idR, $note)
{
    $result = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE critiquer SET note = :note WHERE idR = :idR AND mailU = :mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':note', $note, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $result =$req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}



if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getNoteMoyenneByIdR(1) \n";
    print_r(getNoteMoyenneByIdR(1));
}
