<?php


abstract class Vessel
{

    public $nom; // nom du vaiseau
    public $x; // cordonne x du vaisseau 
    public $y;  // cordonne y du vaisseau 
    public $type; // Type du vaisseau (offensif ou soutien)

    public function seDecplacer($x, $y)
    { // Fonction qui permet de deplacer le vaiseau
        $this->x = $x;
        $this->y = $y;
    }
}






// classe qui represente vaiseau de type  Support
class SupportVessel extends Vessel
{
    public $medicalUnit;
    public function  executerOrdre($tache)
    {

        echo $this->nom . "   qui transoporte " . $this->medicalUnit . "va executer la tâche suivante : " . $tache . " <br>";
    }
}


// classe qui represente vaiseau de type  Offensive 
class OffensiveVessel extends Vessel
{
    public $nbCannons;

    public function attaquer()
    {
        echo $this->nom . " attaque !! <br>";
    }
    public function leverBoucliers()
    {
        echo $this->nom . " leve ces boucliers !! <br>";
    }
}

// classe qui représente qui représente un  vaisseau Offensive  de type  Destroyer
class Destroyer extends OffensiveVessel
{
    public function __construct($name)
    {
        $this->type = "offensif";
        $this->nom = $name;
        $this->nbCannons = 12;
    }
}

// classe qui représente un  vaisseau Offensive de type croiseur
class Cruiser extends OffensiveVessel
{
    public function __construct($name)
    {
        $this->type = "offensif";
        $this->nom = $name;
        $this->nbCannons = 6;
    }
}

//classe qui représente un  vaisseau Offensive de type Battleship
class Battleship extends OffensiveVessel
{
    public function __construct($name)
    {
        $this->type = "offensif";
        $this->nom = $name;
        $this->nbCannons = 24;
    }
}



// classe qui représente un  vaisseau de Support  de type Refueling
class RefuelingVessel extends SupportVessel
{
    public function __construct($nom, $medicalUnit)
    {
        $this->type = "soutien";
        $this->$medicalUnit = $medicalUnit;
        $this->nom = $nom;
    }
}

// classe qui représente un  vaisseau de Support  de type  Mechanical
class MechanicalAssistanceVessel extends SupportVessel
{
    public function __construct($nom, $medicalUnit)
    {
        $this->type = "soutien";
        $this->$medicalUnit = $medicalUnit;
        $this->nom = $nom;
    }
}

// classe qui représente un  vaisseau de Support  de type  Cargo
class CargoVessel extends SupportVessel
{
    public function __construct($nom, $medicalUnit)
    {
        $this->type = "soutien";
        $this->medicalUnit = $medicalUnit;

        $this->nom = $nom;
    }
}






// Test de création des différents vaiseaux

/*$battleShip = new Battleship("batlleship1");
$battleShip->attaquer();
$battleShip->leverBoucliers();



$cargoVessel = new CargoVessel("CargoVessel1","medicalUnite1");
$cargoVessel->executerOrdre("Ordre 1 ");

*/

// tableau qui continet les vaisseaux de support 
$supportVessels = array();
// tableau qui contient les vaisseaux offensive
$offensiveVessels = array();


// generation de 50 vaisseaux 25 de type support et 25 de type offensive
for ($i = 0; $i < 25; $i++) {
    $battleShip = new Battleship("batlleship{$i}");
    $cargoVessel = new CargoVessel("CargoVessel{$i}", "medicalUnite{$i}");
    $x = mt_rand(0, 100);
    $y = mt_rand(0, 100);
    $battleShip->seDecplacer($x, $y);
    $x = mt_rand(0, 100);
    $y = mt_rand(0, 100);
    $cargoVessel->seDecplacer($x, $y);
    $supportVessels[$i] = $cargoVessel;
    $offensiveVessels[$i] = $battleShip;
}


// tableau qui permet à preciser si le vaiseau [i] a son pair ou pas 
$offensiveVesselsPris[] = array();
for ($i = 0; $i < 25; $i++)
    $offensiveVesselsPris[$i] = false;


$case_j = 0;
for ($i = 0; $i < 25; $i++) {


    $min = 1000;

    for ($j = 0; $j < 25; $j++) {

        $distance = sqrt(pow($supportVessels[$i]->x - $offensiveVessels[$j]->x, 2) + pow($supportVessels[$i]->y - $offensiveVessels[$j]->y, 2));
        if ($min > $distance) {
            if ($offensiveVesselsPris[$j] == false) {

                $min = $distance;
                $case_j = $j;
            }
        }

        // echo "distance de {$i} est " .$distance."<br>";


    }
    $supportVessels[$i]->seDecplacer($offensiveVessels[$case_j]->x, $offensiveVessels[$case_j]->y);
    $offensiveVesselsPris[$case_j] = true;
    echo "   {$supportVessels[$i]->nom} je suis avec " .  $offensiveVessels[$case_j]->nom   . " Nos cordonnés sont  X: {$supportVessels[$i]->x}  {$offensiveVessels[$case_j]->x}  ;  Y: {$supportVessels[$i]->y}  {$offensiveVessels[$case_j]->y}   <br> ";
}


