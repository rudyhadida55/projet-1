<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 21/11/2018
 * Time: 17:27
 */

ob_start();
?>
    <div class="row">
        <?= $message ?>
    </div>

    <form class="form-horizontal" action="index.php?action=myaccount" method="POST" enctype="multipart/form-data">
        <fieldset>

            <!-- Form Name -->
            <legend>Mon compte</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="nom">Nom</label>
                <div class="col-md-4">
                    <input value="<?= $member['name'] ?>" id="nom" name="nom" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prenom">Prenom</label>
                <div class="col-md-4">
                    <input value="<?= $member['firstname'] ?>" id="prenom" name="prenom" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="login">Login</label>
                <div class="col-md-4">
                    <input value="<?= $member['login'] ?>" id="login" name="login" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Mot de passe</label>
                <div class="col-md-4">
                    <input value="<?= $member['password'] ?>" id="password" name="password" type="password" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="image">Charger une image</label>
                <div class="col-md-4">
                    <input id="image" name="image" class="input-file" type="file">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="valider"></label>
                <div class="col-md-4">
                    <button id="valider" name="valider" class="btn btn-primary">Valider</button>
                </div>
            </div>

        </fieldset>
    </form>

<?php

$content = ob_get_clean();
$title = 'Mon compte';

include('template.php');