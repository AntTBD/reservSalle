<?php


class User
{
    public $id;
    public $pseudo;
    public $mdp;

    public  function setId($id){ $this->id = $id;}
    public function getId(){ return $this->id;}
    public function getPseudo(){ return $this->pseudo;}
    public function setPseudo($pseudo){  $this->pseudo = $pseudo;}
    public function getMdp(){ return $this->mdp;}
    public function setMdp(){ $this->mdp = mdp;}

}