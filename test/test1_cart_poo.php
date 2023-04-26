<?php
/*class Cart {
    public int $quantity ;
    public float $totalPrice ;

    public function __construct(int $quantity, float $totalPrice)
    {
        $this->quantity=$quantity;
        $this->totalPrice=$totalPrice;
    }
    public function getTotalPrice(): float{
        return $this->totalPrice;
    }
    public function setTotalPrice(float $price): void{
        $this->totalPrice =$price;
    }
    public function pourcentage(float $pourcentage): void {
            $this->totalPrice-=$this->totalPrice*($pourcentage/100);
    }

}

class Voiture{
    public $genre;
    public $marque;
    public int $prix;

    public function __construct($genre, $marque,int $prix ){
        $this->genre =$genre;
        $this->marque =$marque;
        $this->prix =$prix;
    }
    public function getMarque() {
        return $this->marque;
    }
      public function getGenre(){
        return $this->genre;
      }  
      public function setPrice(int $prix): void{
        $this->prix = $prix;
      }
      public function promotion(float $promotion){
        $this->prix -=$this->prix *($promotion/100);
      }
}


class Voiture {
    public $marque;
    public $genre;
    public $prix;
    public $couleur;

    public function __construct($marque,$genre,int $prix,$couleur)
    {
      $this->marque = $marque;
      $this->genre=$genre;
      $this->prix= $prix;
      $this->couleur=$couleur;  
    }public function getPrice(){
        return $this->prix;
    }public function setPrice(int $prix): void{
         $this->prix = $prix;
    }public function setGenre($genre){
        $this->genre= $genre;
    }public function setColore($couleur){
        $this->couleur= $couleur;
    
    }public function solde(float $solde){
        $this->prix -=$this->prix *($solde/100);
    }
        
    
}


class Voiture{
    public $marque;
    public $genre;
    public $couleur;
    public $prix;

    public function __construct($marque, $genre, $couleur, int $prix)
    {
       $this->marque=$marque;
       $this->genre=$genre;
       $this->couleur=$couleur;
       $this->prix=$prix; 
    } function getColore(){
        return $this->couleur;
    }function setPrix(int $prix): void{
        $this->prix=$prix;
    }function solde(float $solde){
        $this->prix-= $this->prix *($solde/100);
    }
}*/

class Voiture {
    public $marque;
    public $genre;
    public $couleur;
    public $prix;

    function __construct($marque,$genre,$couleur,int $prix)
    {
        $this->marque=$marque;
        $this->genre=$genre;
        $this->couleur=$couleur;
        $this->prix=$prix;
    }function getMarque(){
        return $this->marque;
    }function setPrice(int $prix){
        $this->prix=$prix;
    }function promotion (float $promotion):void{
        $this->prix = $this->prix *($promotion/100);
    }
}
    
