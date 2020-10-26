<?php


namespace App\Model;



class ClavierCrypte
{
    private $nbrCharByNum;
    public function __construct()
    {
        $this->nbrCharByNum = 10;
    }

    private function getNbrCharByNum()
    {
        return $this->nbrCharByNum;
    }

    private function setNbrCharByNum($nbrCharByNum)
    {
        if($nbrCharByNum>0)
            $this->nbrCharByNum = $nbrCharByNum;
        else
            $this->nbrCharByNum = 1;
    }

    public function createTabCorrespondance(){
        $tabCorrespondance=self::createCodedTab();// tableau des variables possibles
        shuffle($tabCorrespondance);// on melange le tableau (juste les correspondances chiffres-chaine) (on sait jamais ^^)

        return $tabCorrespondance;
    }
    private static function createCodedTab () {
        $tabCorrespondance=Array();
        $nbrChar= (new ClavierCrypte)->getNbrCharByNum();
        for ($i = 0; $i < 10; $i++){
            array_push ($tabCorrespondance, self::izrand($nbrChar,false));
        }

        return $tabCorrespondance;
    }
    private static function izrand($length = 32, $fullNumeric = false) {
        // https://stackoverflow.com/questions/31441050/using-chr-rand-to-generate-a-random-character-a-z (izrand v2)
        $random_string = "";
        while(strlen($random_string)<$length && $length > 0) {
            if($fullNumeric === false) {
                $randnum = mt_rand(0,61);
                $random_string .= ($randnum < 10) ?
                    chr($randnum+48) : ($randnum < 36 ?
                        chr($randnum+55) : chr($randnum+61));
            } else {
                $randnum = mt_rand(0,9);
                $random_string .= chr($randnum+48);
            }
        }
        return $random_string;
    }

    public function mdpConvertedFromTabCorrespondance($mdpCodeFromPost){
        $tableau = $_SESSION["tab"];// on recupère le tableau mélangé
        //unset($_SESSION['tab']);// on supprime le tableau

        // on recupère les correspondances
        $tabCorrespondanceInverse = array(
            $tableau[0] => "0",
            $tableau[1] => "1",
            $tableau[2] => "2",
            $tableau[3] => "3",
            $tableau[4] => "4",
            $tableau[5] => "5",
            $tableau[6] => "6",
            $tableau[7] => "7",
            $tableau[8] => "8",
            $tableau[9] => "9"
        );

        $mdpReel = "";

        for ($i=0; $i<strlen($mdpCodeFromPost); $i++){
            $combinaisonLettre='';
            for ($j = 0; $j < $this->nbrCharByNum; $j++){
                $combinaisonLettre.=$mdpCodeFromPost[$i+$j];
            }
            $mdpReel.= self::convert($combinaisonLettre, $tabCorrespondanceInverse);// on converti chaque lettre en chiffre
            $i+=$this->nbrCharByNum-1;
        }
        //echo 'mdpReel '.$mdpReel.'<br>';
        return $mdpReel;
    }

    private static function convert ( $lettre, $tabCorrespondanceInverse ) {
        $lettre = strtr("$lettre", $tabCorrespondanceInverse);//on remplace les carractères grace aux pairs de la table

        return $lettre;
    }



}