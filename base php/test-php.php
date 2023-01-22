<?php
session_start();

$array = [
    "user1"=>[
        "nom"=>"Pitz",
        "prenom"=>"Michaël",
    ],
    "user2"=>[
        "nom"=>"Sandron",
        "prenom"=>"Pierre",
    ],
    "user3"=>[
        "nom"=>"Palmisano",
        "prenom"=>"André",
    ],
];

foreach($array as $clef => $item){
    echo "<p>$clef se nomme {$item['nom']} {$item['prenom']}</p>
";
}

$i="hiohih";

if($i == 0){
    echo "i est égal à 0";
}elseif($i == 1){
    echo "i est égal à 1";
}elseif($i == 2){
    echo "i est égal à 2";
}else{
    echo "i n'est pas une valeur attendue";
}
echo "<hr>";
// switch
switch($i){
    case 0:
        echo "i est égal à 0";
        break;
    case 1:
        echo "i est égal à 1";
        break;
    case 2:
        echo "i est égal à 2";
        break;
    default:
        echo "i n'est pas une valeur attendue";
}
echo "<hr>";
// Années-mois-jour heures:minutes:secondes 
echo date("Y-m-d H:i:s");
echo "<hr>";
// le temps il y a 2 semaines à la seconde près
echo date("Y-m-d H:i:s",(time()-(60*60*24*7*2)));
echo "<hr>";
// conversion d'une date en secondes 
$temps_sec =  strtotime("10 September 2000");
echo date("Y-m-d H:i:s", $temps_sec);
echo "<hr>";
echo date("Y-m-d H:i:s",strtotime("+1 day"))." Vérifiez vos mail avant cette date<br>";

if (!isset($_SESSION['premierevisite'])) {
    $_SESSION['premierevisite']=time();
}

echo "<hr>";
echo "Première visite de la page => ".date("Y-m-d H:i:s",$_SESSION['premierevisite']);
echo "<hr>";
echo time()-$_SESSION['premierevisite']." temps en secondes depuis la première visite";