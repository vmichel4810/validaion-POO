<?php

class Archer extends Character
{
    public $weakPoint = false;
    public $costArrow= 0;
    public $arrowStock = 4;


    public function turn($target){
        $rand = rand(1, 2);
        var_dump($rand);
        if($this->arrowStock == 0){
            $status = $this->dagger($target);
        }elseif($this->arrowStock > 0 && $this->weakPoint){
            $status = $this->weakPointArrow($target);
        }elseif($this->costArrow == 0 && $rand == 1){
            $status = $this->weakPointCharged($target);
        }elseif($this->arrowStock > 0 && $rand == 2){
            $status = $this->arrow($target);
        }
        return $status;
    }


    public function arrow($target){
        $this->arrowStock -= 1;
        $target->setHealthPoints($this->damage);
        $status = "$this->name lance une flèche à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
    public function weakPointCharged($target){
        if($this->weakPoint == false){
            $this->costArrow = rand(15, 30)/10;
            $this->weakPoint = true;
            $status = "$this->name multipliera ça prochaine attaque !";
        }    
            return $status;
    }

    public function weakPointArrow($target){
        if($this->weakPoint){
            $this->arrowStock -= 1;
            // $target->setHealthPoints($this->damage * $this->costArrow);
            $target->setHealthPoints(10);
            $this->weakPoint = false;
            $this->costArrow = 0;
            $status = "$this->name lance une flèche dans le Point Faible de $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
            
        }
        return $status ;
    } 

    public function dagger($target){
        
        $damage = 5;
        $target->setHealthPoints($damage);
        $status = "$this->name lance une attaque à la dague sur $target->name il reste $target->healtPoints points de vie à $target->name";
        return $status;
    } 



}