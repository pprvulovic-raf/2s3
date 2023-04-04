<?php

class Covek{
    private $ime;
    private $starost;

    public function __construct(){
        $this->ime = '';
        $this->starost = 1;
    }
    public function getIme(){
        return $this->ime;
    }
    public function setIme($novoIme){
        if($novoIme == "djole"){
            echo "E ne moze da se zovem djole <br>";
        } else {
            $this->ime = $novoIme;
        }
    }
    public function rodjendan(){
        echo "uraa ~<:) <br>";
        $this->starost++;
    }

    public function pozdrav(){
        return "Zdravo ja sam " . $this->ime . " i imam " . $this->starost . " godina <br>";
    }
}


$pera = new Covek();
$pera->setime("djole");
$pera->setime("Petar");
echo $pera->pozdrav();
$pera->rodjendan();
echo $pera->pozdrav();
