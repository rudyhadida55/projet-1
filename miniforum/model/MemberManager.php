<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 14/11/2018
 * Time: 15:23
 */
class MemberManager extends Manager
{
    /*
     * Fonction qui retourne l'utilisateur qui match avec le login et password donné en paramètre
     * Si aucun member ne correspond dans la bdd, alors retourne vide/NULL
     * */
    private function _checkConnexion($login, $password) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('SELECT * FROM member WHERE 
                            login = ? AND password = ?');
        $requete->execute(array($login, $password));
        return $requete->fetch();
    }
    /*
     * Fonction qui retourne Vrai ou Faux selon si un utilisateur a été trouvé par son login et password
     * Conserve en mémoire des variables de sessions en cas de succès
     * */
    public function user_connect($login, $password) {
        $user = $this->_checkConnexion($login, $password);
        if (!empty($user)) {
            $_SESSION['name'] = $user['name'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $user['id'];
            $_SESSION['profil_pic'] = $user['profil_pic'];
            $_SESSION['is_connect'] = true;
            return true;
        } else {
            $_SESSION['is_connect'] = false;
            return false;
        }
    }
    public function get_member_by_id($id_member) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('SELECT * FROM member where id = ?');
        $requete->execute(array($id_member));
        return $requete->fetch();
    }


    function edit_member($nom, $prenom, $login, $password, $image, $id) {
        $bdd = $this->dbConnect();
        $requete = $bdd->prepare('UPDATE `member` SET `name`=?,`firstname`=?,`login`=?,`password`=?,`profil_pic`=? WHERE id = ?');
        $requete->execute(array($nom, $prenom, $login, $password, $image, $id));
        return $requete;
    }
}