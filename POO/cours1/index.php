<?php

class Personnage {
    public $hp; // $hp -> property != variable
    public $mp;
    public $nom;
    public $level;
    public $force;

    // function seBattre() -> method != function
    function seBattre($adversaire) {
        echo $this->nom . " attaque " . $adversaire->nom . " <br> ";
        if (mt_rand(0,1) == 1) {
            $adversaire->hp = $adversaire->hp - $this->force;
        } else {
            echo $this->nom . " a raté son attaque sur " . $adversaire->nom . " <br> ";
        }

        if ($adversaire->hp > 0 && $this->hp > 0) {
            $adversaire->seBattre($this);
        }
    }
}

$personnage1 = new Personnage();

$personnage1->nom = "LeRoiAdib";
$personnage1->hp = 120;
$personnage1->mp = 100;
$personnage1->force = 40;
$personnage1->level = 10;
 
$personnage2 = new Personnage();

$personnage2->nom = "bricetant";
$personnage2->hp = 100;
$personnage2->mp = 120;
$personnage2->force = 50;
$personnage2->level = 10;
 
var_dump($personnage1);
var_dump($personnage2);
 
$personnage1->seBattre($personnage2);
 
var_dump($personnage1);
var_dump($personnage2);

?>