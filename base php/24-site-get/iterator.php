<?php
// utilisation de l'itérateur
class Compteur implements Iterator{

    // où on mettra notre tableau
    public array $position;

    public function __construct(array $datas)
    {
        $this->setPosition($datas);
    }
    #[\ReturnTypeWillChange]
 public function rewind(): void {

        $this->position = 0;
    }
    #[\ReturnTypeWillChange]
    public function current() {

    }
    #[\ReturnTypeWillChange]
    public function key() {
        return $this->position;
    }
    #[\ReturnTypeWillChange]
    public function next(){
        $this->position;
    }
    #[\ReturnTypeWillChange]
    public function valid(){
        return isset($this->position);
    }


    /**
     * Get the value of position
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @return  self
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
};

$tab = ['un','deux','trois'];

var_dump($tab);

$obj1 = new Compteur($tab);

$obj1->next();

var_dump($obj1);