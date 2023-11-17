<?php
// Définition d'une classe abstraite Utils
abstract class Utils {
    public static function getRandomvalue($array) { 
     // j'Utilise la fonction array_rand() pour obtenir une clé aléatoire du tableau
     // et retourne la valeur associée à cette clé
       return $array[array_rand($array)];
    }
}

// Définition d'une classe appelée Characters
class Characters {
    // je déclare les propriétés $name et $marbles 
    // protected pour que les classes filles puissent y accéder
    protected $name; 
    protected $marbles;

    protected function __construct($name, $marbles) {
        $this->name = $name;
        $this->marbles = $marbles;
    }

    public function getName() {
        return $this->name;
    }

    public function getMarbles() {
        return $this->marbles;
    }

    public function setMarbles($newMarbles) {
        $this->marbles = $newMarbles;
    }
}

class Hero extends Characters {
    private $loss;
    private $gain;
    private $scream_war;

    public function __construct($name, $marbles, $loss, $gain, $scream_war) {
        parent::__construct($name, $marbles);
        $this->loss = $loss;
        $this->gain = $gain;
        $this->scream_war = $scream_war;
    }

    public function getLoss() {
        return $this->loss;
    }

    public function getGain() {
        return $this->gain;
    }

    public function getScreamWar() {
        return $this->scream_war;
    }

   /*  public function OddEvenMarbles() {
        $guess = rand(0, 1);
        return $guess;
    } */

    public function OddEvenCheck($number) {
     //   return $this->marbles % 2 == 0;
          return $number % 2 == 0;
    }
}

class Ennemy extends Characters {
    private $age;

    public function getAge() {
        return $this->age;
    }

    public function __construct($name, $marbles, $age) {
        parent::__construct($name, $marbles);
        $this->age = $age;  
    }
}

class Game {
    private $ennemylist;
    private $level = ['Facile' => 5, 'Difficile' => 10, 'Impossible'=> 20];
    private $players;

  
    
    private function heroes() {
        $seong = new Hero('Seong Gi-hun', 15, 2, 1, 'Bo !');
        $kang = new Hero('Kang Sae-byeok', 25, 1, 2, 'Boo !');
        $cho = new Hero('Cho Sang-woo', 35, 0, 3, 'BOOO');

        $this->players = [$seong, $kang, $cho];
        
    }
    


    public function __construct() {
        $this->ennemylist = $this->getEnnemy();
        $this->heroes();
    }

    private function getEnnemy() {
      $ennemylist = [];
      for ($i = 0; $i < 20; $i++) {
          $name = "Ennemi " . $i;
          $marbles = rand(15, 40);
          $age = rand(10, 100);
          $ennemylist[] = new Ennemy($name, $marbles, $age);
          
      }
        
      return $ennemylist;
    }

    public function randomLevel() {
        $randomLevel = Utils::getRandomvalue($this->level);

       
       if($randomLevel === 5) {
           array_slice($this->ennemylist, 15);
        
         } elseif($randomLevel === 10) {
            array_slice($this->ennemylist, 10);
         } else {
            array_slice($this->ennemylist, 0);
         }
    
       
        
        return $randomLevel;
       
    }


    Public function startGame() {
        $randHeroes = $this->players;
        shuffle($randHeroes);
        foreach( $randHeroes as $player) {
            
            
            $randomLevel = $this->randomLevel();
            $this->randomLevel();
            echo " <br> <br> Niveau " .$randomLevel. "<br> <br>";
            

            foreach ($this->ennemylist as $key => $ennemy) {
        
                $randomEnemy = Utils::getRandomvalue($this->ennemylist);
                $this->randomEnemy = $randomEnemy;
                echo "le hero " .$player->getName(). " a " . $player->getMarbles() . " billes et il affronte " . $randomEnemy->getName() . " qui a " . $randomEnemy->getMarbles() . " billes." ."<br>";
                $guess = rand(0, 1);
                $guess1 = rand(0, 1);
                if ( $randomEnemy->getAge() > 70 && $guess1 == 0) {
                    
              
                    if($player->OddEvenCheck($randomEnemy->getMarbles()) == $guess){
                       echo $player->getName() . " a trouver le nombre de billes dans la mains de son adversaire" . "<br>"; 
                       $player->setMarbles($player->getMarbles() + $randomEnemy->getMarbles());
                       $player->setMarbles($player->getMarbles() + $player->getGain());
                       echo'il gagne '. $randomEnemy->getMarbles() ." + ".$player->getGain(). "<br> Il a maintenant " . $player->getMarbles() . " billes <br>";
                       unset($this->ennemylist[$key]);
                       //echo count($this->ennemylist). "<br>";
                       echo $randomEnemy->getName() . ' est iliminé <br>';
                       if (count($this->ennemylist) == 0 && $player->getMarbles() > 0 ) {
                           echo "Plus d'adversaires disponibles. Le jeu est terminé." . "<br>";
                           echo $randomEnemy->getName() . ' est iliminé' .$player->getName(). " a ramporté la partie  <br>";
                           break;
                       }
                   
                    
                    
                    } else {
                        echo $player->getName() . " n'a pas trouver le nombre de billes dans la mains de son adversaire" . "<br>"; 
                        $player->setMarbles($player->getMarbles() - $randomEnemy->getMarbles());
                        $player->setMarbles($player->getMarbles() - $player->getLoss());
                        echo'il perd '. $player->getLoss(). " + " .$randomEnemy->getMarbles() . "<br> Il a maintenant " . $player->getMarbles() . " billes <br>";
                        if($player->getMarbles() <= 0) {
                            echo $player->getName() . " a perdu toutes ses billes. La partie est terminée." . "<br>";
                            break;
                        }
                    }

                } else if ( $randomEnemy->getAge() > 70 && $guess1 == 1) {
                    echo $randomEnemy->getName() ." a plus de ". $randomEnemy->getAge(). " et " .$player->getName(). " décide de tricher " . "<br>";
                    echo'il garde ses '. $player->getMarbles() ." billes <br>";
                    unset($this->ennemylist[$key]);
                    echo count($this->ennemylist). "<br>";
                    echo $randomEnemy->getName() . ' est iliminé ' .$player->getName(). " a ramporté la partie  <br>";
                    
                    if (count($this->ennemylist) == 0 && $player->getMarbles() > 0 ) {
                        echo "Plus d'adversaires disponibles. Le jeu est terminé." . "<br>";
                        echo $player->getName() . " a gagné la partie" . "<br>";
                        break;
                    }
                } else {
                    echo $player->getName() . " n'a pas trouver le nombre de billes dans la mains de son adversaire" . "<br>"; 
                    $player->setMarbles($player->getMarbles() - $randomEnemy->getMarbles());
                    $player->setMarbles($player->getMarbles() - $player->getLoss());
                    echo'il perd '. $player->getLoss(). " + " .$randomEnemy->getMarbles() . "<br> Il a maintenant " . $player->getMarbles() . " billes <br>";
                    if($player->getMarbles() <= 0) {
                        echo $player->getName() . " a perdu toutes ses billes. La partie est terminée." . "<br>";
                        break;
                    }
                }

                
                
                
            
            }
           
            
        }
       


    }

  /*   public function showEnnemies() {
        foreach ($this->ennemylist as $enemy) {
            echo "Enemy Name: " . $enemy->getName() . ", Marbles: " . $enemy->getMarbles() . ", Age: " . $enemy->getAge() . "<br>";
        }
    
        // Select a random enemy after the foreach loop
        $randomEnemy = Utils::getRandomvalue($this->ennemylist);
        echo "Randomly selected enemy: " . $randomEnemy->getName() . "<br>";
    } */
    

}

    

$game = new Game();

$game->randomLevel();
$game->startGame();