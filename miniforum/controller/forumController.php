<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 13/11/2018
 * Time: 16:25
 */
/*
 * Gere le chargement automatique des classes à la volées (quand on en a besoin)
 *
 */
function loadClass($class) {
    require('model/'. $class .'.php');
}
spl_autoload_register('loadClass');
function listsubject() {
    /*
     $sujets = array(
         array('Title' => 'Premier sujet', 'Auteur' => 'Adrien'),
         array('Title' => 'Deuxieme sujet', 'Auteur' => 'Martin'),
         array('Title' => 'Troisieme sujet', 'Auteur' => 'Martin'),
     );
     */
    //je créer un objet $subjectManager qui est une instance de la classe SubjectManager
    $subjectManager = new SubjectManager;
    $message ='';
    if (isset($_POST['addsubject'])) {
        $affectedLines = $subjectManager->addSubject($_POST['title'], nl2br($_POST['question']));
        if ($affectedLines == false) {
            throw new Exception('Impossible d\'ajouter le sujet');
        } else {
            $message = '<div class="alert alert-success">Votre sujet a été publiée avec succes</div>';
        }
    }
    if (isset($_POST['editsubject'])) {
        $affectedLines = $subjectManager->editSubject($_POST['title'], nl2br($_POST['question']), $_POST['id_subject']);
        if ($affectedLines == false) {
            throw new Exception('Impossible de mettre à jour le sujet');
        } else {
            $message = '<div class="alert alert-success">Votre sujet a été modifié avec succes</div>';
        }
    }
    /* Je peux à présent utiliser les fonctions public de cette objet, nottamment getSubjects()
     * qui me retourne la requete SQL de tous les sujets de la base de donnée
     */
    $sujets = $subjectManager->getSubjects();
    include('view/homepage.php');
}
function displaysubject() {
    $message = '';
    if (isset($_GET['message'])) {
        $message = '<div class="alert alert-success">Votre réponse a été supprimée avec succes</div>';
    }
    if (isset($_GET['id'])) {
        $subjectManager = new SubjectManager;
        $subject = $subjectManager->get_subject_by_id($_GET['id']);
        if (empty($subject)) {
            throw new Exception('Ce sujet n\'existe pas');
        } else {
            $answerManager = new AnswerManager;
            if (isset($_POST['modifyanswer'])) {
                $answer = $answerManager->getAnswerById($_GET['id_answer']);
                if ($answer['id_member']  != $_SESSION['id']) {
                    throw new Exception('Vous n\'avez pas le droit de modifier ce commentaire');
                } else {
                    $affectedLines = $answerManager->modif_answer($_GET['id_answer'], $_POST['answer']);
                    if ($affectedLines == false) {
                        throw new Exception('Impossible de modifier la réponse');
                    } else {
                        $message = '<div class="alert alert-success">Votre réponse a été modifiée avec succes</div>';
                    }
                }
            }
            if (isset($_POST['validate_answer'])) {
                $affectedLines = $answerManager->addAnswer(nl2br($_POST['reponse']), $_GET['id'], $_SESSION['id']);
                if ($affectedLines == false) {
                    throw new Exception('Impossible d\'ajouter la réponse');
                } else {
                    $message = '<div class="alert alert-success">Votre réponse a été publiée avec succes</div>';
                }
            }
            $answers = $answerManager->getAnswerByIdSubject($_GET['id']);
        }
    } else {
        throw new Exception('Aucun id de sujet dans l\'url');
    }
    include('view/subject.php');
}
function displayFormSubject() {
    if (isset($_GET['id_subject'])) {
        $edition = 1;
        $action = 'editsubject';
        $subjectManager = new SubjectManager;
        $subject = $subjectManager->get_subject_by_id($_GET['id_subject']);
        if (!empty($subject)) {
            if ($subject['id_member'] != $_SESSION['id']) {
                throw new Exception('Vous ne pouvez pas modifier ce sujet car ce n\'est pas le votre');
            }
        } else {
            throw new Exception('Ce sujet n\'existe pas');
        }
    } else {
        $edition = 0;
        $action = 'addsubject';
        $subject = array('id' =>'', 'title'=>'', 'date'=>'', 'question' => '', 'id_member' => '');
    }
    include ('view/subject_view.php');
}
function deleteanswer() {
    $answerManager = new AnswerManager();
    $affectedLines = $answerManager->supp_answer($_GET['id_answer']);
    if ($affectedLines == false) {
        throw new Exception('Impossible de supprimer cette reponse');
    } else {
        header('Location:index.php?action=displaysubject&id='.$_GET['id_subject'].'&message');
    }
}
function displaylogin() {
    $message = '';
    include('view/login.php');
}
function displayformanswer() {
    if (isset($_GET['id_subject']) && isset($_GET['id_answer'])) {
        $answerManager = new AnswerManager;
        $answer = $answerManager->getAnswerById($_GET['id_answer']);
        if ($answer['id_member'] != $_SESSION['id']) {
            throw new Exception('Vous n\'avez pas le droit de modifier ce commentaire');
        }
        $id_subject = $_GET['id_subject'];
    } else {
        throw new Exception('Impossible d\'afficher ce commentaire');
    }
    include ('view/answer_view.php');
}
function login() {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $memberManager = new MemberManager;
        if ($memberManager->user_connect($_POST['login'], $_POST['password'])) {
            header('Location:index.php?action=home');
        } else {
            $message = '
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">Mauvais login ou mot de passe</div>
                </div>
            </div>';
            include('view/login.php');
        }
    } else {
        $message = '
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">Veuillez renseigner un login et un mot de passe</div>
                </div>
            </div>';
        include('view/login.php');
    }
}

function myacount() {
    $message = "";
    $memberManager = new MemberManager;
    $ligne_ajout = false;
    if (isset($_POST['valider'])) {

        $nom = (isset($_POST['nom'])? $_POST['nom'] : '');
        $prenom = (isset($_POST['prenom'])? $_POST['prenom'] : '');
        $login = (isset($_POST['login'])? $_POST['login'] : '');
        $password = (isset($_POST['password'])? $_POST['password'] : '');

        // Let's test if the file has been sent and there is no error
        if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0) {
            // Let's test if the file is not too big
            if ($_FILES['image']['size'] <= 1000000000000)
            {
                // Let's test if the extension is allowed
                $fileinfo = pathinfo($_FILES['image']['name']);
                $authorised_extensions = $fileinfo['extension'];
                $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                if (in_array($authorised_extensions, $extensions_autorisees))
                {
                    // We can validate the file and store it permanently
                    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . basename($_FILES['image']['name']));
                    $ligne_ajout = $memberManager->edit_member($nom, $prenom, $login, $password, $_FILES['image']['name'],  $_SESSION['id']);
                }
            }
        } else {
            $ligne_ajout = $memberManager->edit_member($nom, $prenom, $login, $password, $_FILES['image']['name'],  $_SESSION['id']);
        }

        if ($ligne_ajout == false) {
            throw new Exception('Impossible d\'uploader le document');
        } else {
            $message = '<div class="alert alert-success col-md-12" role="alert">Le profil a bien été mis à jour</div>';
        }

    }

    $member = $memberManager->get_member_by_id($_SESSION['id']);

    include('view/myacount.php');
}