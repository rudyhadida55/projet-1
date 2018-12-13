<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 13/11/2018
 * Time: 16:29
 */
class SubjectManager extends Manager
{
    public function getSubjects() {
        $bdd = $this->dbConnect();
        return $bdd->query('SELECT * FROM subject');
    }
    public function get_subject_by_id($id) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('SELECT * FROM subject WHERE id = ?');
        $requete->execute(array($id));
        return $requete->fetch();
    }
    public function addSubject($title, $question) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('INSERT INTO `subject`(`title`, `date`, `question`, `id_member`) 
                                VALUES (?,NOW(),?,?)');
        $requete->execute(array($title, $question, $_SESSION['id']));
        return $requete;
    }


    public function editSubject($title, $question, $id) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('UPDATE `subject` SET `title`=?,`question`=? WHERE id = ?');
        $requete->execute(array($title, $question, $id));
        return $requete;
    }
}
