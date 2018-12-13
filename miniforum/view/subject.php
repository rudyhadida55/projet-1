<?php
$title = 'Sujet : '.$subject['title'];
ob_start();
$memberManager = new MemberManager;
?>

    <h2>Lecture du sujet : <?= $subject['title'] ?></h2>
    <br>

<?php
if ($_SESSION['id'] == $subject['id_member']) {
    echo '<a href="index.php?action=createsubject&id_subject='.$subject['id'].'">Modifier le sujet</a>';
}
?>

<br>

    <a href="index.php?action=home">Revenir à la liste des sujets</a>
    <br>
    <br>
<?= $message ?>

    <div class="row">
        <div class="col-md-12">
            <div class="post">
                <div class="post-info">
                    Posté par <img class="img_user" src="public/img/<?= $subject['id_member'] ?>/<?= $memberManager->get_member_by_id($subject['id_member'])['profil_pic'] ?>"><strong><?= $memberManager->get_member_by_id($subject['id_member'])['name'].' '.$memberManager->get_member_by_id($subject['id_member'])['firstname'] ?></strong>
                    &nbsp;&nbsp;<br>
                    <small><?= $subject['date'] ?></small>
                </div>
                <div>
                    <?= $subject['question'] ?>
                </div>
            </div>
            <?php
            while ($answer = $answers->fetch()) {
                ?>
                <div class="post-answer">
                    <div class="post-answer-info">
                        Posté par <img class="img_user" src="public/img/<?= $answer['id_member'] ?>/<?= $memberManager->get_member_by_id($answer['id_member'])['profil_pic'] ?>"> <strong><?= $memberManager->get_member_by_id($answer['id_member'])['name'].' '.$memberManager->get_member_by_id($answer['id_member'])['firstname'] ?></strong>
                        <?php
                        if ($_SESSION['id'] == $answer['id_member']) {
                            /*echo '<form action="index.php?action=displaysubject&id='.$subject['id'].'" method="POST">
                                    <input type="hidden" name="id_answer" value="'.$answer['id'].'">
                                    <button type="submit" name="delete">Supprimer</button>
                                  </form>';
                            */
                            echo '<a href="index.php?action=deleteanswer&id_subject='.$subject['id'].'&id_answer='.$answer['id'].'">Supprimer</a>';
                            echo ' - <a href="index.php?action=displayformanswer&id_subject='.$subject['id'].'&id_answer='.$answer['id'].'">Modifier</a>';
                        }
                        ?>

                        <br>
                        <small><?= $answer['date'] ?></small>
                    </div>
                    <div>
                        <?= $answer['comment'] ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <br><br>
            <form method="POST" class="form-horizontal" action="index.php?action=displaysubject&id=<?= $subject['id'] ?>">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Répondre</legend>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="reponse">Réponse</label>
                        <div class="col-md-4">

                            <textarea class="form-control" id="reponse" name="reponse"></textarea>
                        </div>
                    </div>

                    <!-- Button (Double) -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="button1id"></label>
                        <div class="col-md-8">
                            <button type="input" name="validate_answer" class="btn btn-success">Valider</button>
                            <button type="input" name="cancel_answer" class="btn btn-danger">Annuler</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>
    </div>
<?php
$content = ob_get_clean();
include ('template.php');