<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 13/11/2018
 * Time: 16:17
 */
session_start();
require('controller/forumController.php');
try {
    if (!isset($_SESSION['is_connect'])) {
        $_SESSION['is_connect'] = false;
    }
    if (!$_SESSION['is_connect']) {
        if (isset($_POST['connection'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $memberManager = new MemberManager;
            $memberManager->user_connect($login, $password);
        } else {
            if ('index.php?action=displaylogin' != basename($_SERVER['REQUEST_URI'])) {
                header('location: index.php?action=displaylogin');
            }
        }
    } else if (isset($_GET['deconnexion'])) {
        session_destroy();
        $_SESSION['is_connect'] = false;
        if ('index.php?action=displaylogin' != basename($_SERVER['REQUEST_URI'])) {
            header('location: index.php?action=displaylogin');
        }
    }
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            listsubject();
        } else if ($_GET['action'] == 'displaysubject') {
            displaysubject();
        } else if ($_GET['action'] == 'createsubject') {
            displayFormSubject();
        } else if ($_GET['action'] == 'displaylogin') {
            displaylogin();
        } else if ($_GET['action'] == 'deleteanswer') {
            deleteanswer();
        } else if ($_GET['action'] == 'displayformanswer') {
            displayformanswer();
        } else if ($_GET['action'] == 'login') {
            login();
        } else if ($_GET['action'] == 'myaccount') {
            myacount();
        }
    } else {
        listsubject();
    }
} catch(Exception $e)
{
    $messageErreur = $e->getMessage();
    require('view/error.php');
}