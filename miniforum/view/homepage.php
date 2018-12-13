<?php
ob_start(); //commence à conserver en mémoire tampon (buffer) ce qui va suivre
?>
<br>
<?= $message ?>
<br>
<a href="index.php?action=createsubject" class="btn btn-default">Ajouter un nouveau sujet</a>
<br>
<br>

<table class="table table-striped">
    <tr>
        <th>Sujet</th>
        <th>Question</th>
        <th>Date</th>
        <th>Auteur</th>
    </tr>
    <?php
    $memberManager = new MemberManager;
    while ($sujet = $sujets->fetch()) {
        ?>

        <tr>
            <td><a href="index.php?action=displaysubject&id=<?= $sujet['id'] ?>"><?= $sujet['title'] ?></a></td>
            <td><?= $sujet['question'] ?></td>
            <td><?= $sujet['date'] ?></td>
            <td><?= $memberManager->get_member_by_id($sujet['id_member'])['name'].' '.$memberManager->get_member_by_id($sujet['id_member'])['firstname'] ?></td>
        </tr>

        <?php
    }
    ?>

</table>
<?php
$content = ob_get_clean();
$title = 'Page d\'accueil';
include('template.php');
?>

