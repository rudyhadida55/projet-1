<?php
/**
 * Created by PhpStorm.
 * User: arb
 * Date: 13/11/2018
 * Time: 16:23
 */
class Manager
{
    protected function dbConnect()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=miniforum2;charset=utf8', 'root', 'root');
        return $bdd;
    }
}