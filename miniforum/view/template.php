<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet"/>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><a href="index.php">Forum</a></h1>
        </div>

        <div class="col-md-6">
            <ul class="nav navbar-nav">
                <li class="dropdown" style="min-width: 200px;">
                    <a href="index.php?action=myaccount" class="dropdown-toggle dropdown-toggle-user ripple" data-toggle="dropdown">
                        <?= $_SESSION['name'].' '.$_SESSION['firstname'] ?>&nbsp;&nbsp;&nbsp;
                        <span class="avatar thumb-xs2">
                       <?php
                       if (isset($_SESSION['profil_pic'])) {
                           echo '<img style="width: 50px;border-radius: 100px;" class="rounded-circle" src="uploads/'.$_SESSION['profil_pic'].'">';
                       }
                       ?>
                           </span>
                    </a>
                </li>
                <li><a href="index.php?deconnexion"><span><span class="align-middle">Se deconnecter</span></span></a></li>
            </ul>
        </div>
    </div>

    <?= $content ?>
</div>
</body>
</html>


