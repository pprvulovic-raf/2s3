<?php
require_once "db.php";

class Skill{
    public $id;
    public $naziv;
    public $opis;

    public function __construct($params = null){
        if(isset($params['id'])){
            global $pdo;

            //ucitavanje podataka iz tabele i punimo default vrednosti
            $this->id = $params['id'];
            $upit = $pdo->prepare("select * from skills where id=?");
            $upit->execute([$this->id]);
            $u = $upit->fetch();
            $this->naziv = $u['naziv'];
            $this->opis = $u['opis'];
        }
        else{
            //imamo novi objekat koji jos n postoji u bazi, jer nema id
            $this->id = null;
            if(isset($params['naziv'])){
                $this->naziv = $params['naziv'];
            }
            if(isset($params['opis'])){
                $this->opis = $params['opis'];
            }
        }
    }

    public function save(){
        global $pdo;

        if($this->id==null){
            //nema id, radimo insert
            $upit = $pdo->prepare("insert into skills (naziv,opis) values (?,?) ");
            $upit->execute([ $this->naziv, $this->opis ]);
            $this->id = $pdo->lastInsertId();
        }
        else{
            //ima id, radimo update
            $upit = $pdo->prepare("update skills set naziv=?, opis=? where id=? ");
            $upit->execute([ $this->naziv, $this->opis, $this->id ]);
        }
    }

    public static function getAllIDs(){
        global $pdo;
        $res = $pdo->query("select id from skills")->fetchAll();
        $ids = [];
        foreach($res as $red){
            $ids[] = $red['id'];
        }
        return $ids;
    }
}