<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 13/11/2018
 * Time: 16:29
 */
class AnswerManager extends Manager
{
    public function getAnswerByIdSubject($id_subject) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('SELECT * FROM answer WHERE id_subject = ?');
        $requete->execute(array($id_subject));
        return $requete;
    }
    public function addAnswer($answer, $id_subject, $id_member) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('INSERT INTO `answer`(`date`, `comment`, `id_subject`, `id_member`) 
                                VALUES (NOW(),?,?,?)');
        $requete->execute(array($answer, $id_subject, $id_member));
        return $requete;
    }
    public function supp_answer($id_answer) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('DELETE FROM `answer` WHERE `id` = ?');
        $requete->execute(array($id_answer));
        return $requete;
    }
    public function getAnswerById($id_answer) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('SELECT * FROM answer WHERE id = ?');
        $requete->execute(array($id_answer));
        return $requete->fetch();
    }
    public function modif_answer($id_answer, $comment) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('UPDATE `answer` SET `comment`=? WHERE id = ?');
        $requete->execute(array($comment, $id_answer));
        return $requete;
    }
}