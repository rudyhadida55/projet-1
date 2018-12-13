<?php
ob_start();
?>

<a href="index.php?action=displaysubject&id=<?= $id_subject ?>">Annuler et revenir au sujet</a>

<form class="form-horizontal" method="POST" action="index.php?action=displaysubject&id=<?= $id_subject ?>&id_answer=<?= $answer['id'] ?>">
    <fieldset>

        <!-- Form Name -->
        <legend>Modifier mon commentaire</legend>


        <!-- Textarea -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="question">Votre commentaire</label>
            <div class="col-md-4">
                <textarea class="form-control" id="answer" name="answer"><?= htmlentities($answer['comment']) ?></textarea>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="modifyanswer"></label>
            <div class="col-md-4">
                <button id="modifyanswer" name="modifyanswer" class="btn btn-primary">Mettre à jour</button>
            </div>
        </div>

    </fieldset>
</form>

<?php
$content = ob_get_clean();
$title = 'Créer un sujet';
require ('template.php');
?>


