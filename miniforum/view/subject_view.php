<?php
ob_start();
?>



<?= ($edition)? '<a href="index.php?action=displaysubject&id='.$_GET['id_subject'].'">Annuler et revenir au sujet</a>':''; ?>

    <form class="form-horizontal" method="POST" action="index.php?action=home">
        <fieldset>

            <!-- Form Name -->
            <legend><?= ($edition)?'Modifier le ':'Créer un nouveau ' ?> sujet</legend>

            <?php
            /*
                if ($edition == true) {
                    echo 'Modifier un sujet';
                } else {
                    echo 'Créer un nouveau sujet';
                }
            */
            ?>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="title">Titre du sujet</label>
                <div class="col-md-4">
                    <input value="<?= $subject['title'] ?>" id="title" name="title" type="text" placeholder="Entrez le titre de votre sujet" class="form-control input-md" required="">
                    <input type="hidden" value="<?= $subject['id'] ?>" name="id_subject">
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="question">Votre question</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="question" name="question"><?= $subject['question'] ?></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="addsubject"></label>
                <div class="col-md-4">
                    <button id="<?= $action ?>" name="<?= $action ?>" class="btn btn-primary">
                        <?= ($edition)?'Modifier ':'Créer ' ?>le sujet
                    </button>
                </div>
            </div>

        </fieldset>
    </form>

<?php
$content = ob_get_clean();
$title = 'Créer un sujet';
require ('template.php');
?>