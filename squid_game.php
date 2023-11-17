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
     // je déclare le constructeur de la classe Characters pour initialiser les propriétés lors de la création d'une instance
    
    protected function __construct($name, $marbles) {
        $this->name = $name;
        $this->marbles = $marbles;
    }
    // les propriétés sont en protected donc je dois créer des getters et setters pour y accéder
    //  Donc je crée les méthodes getName() et getMarbles() pour accéder aux propriétés grace aux return
    
    public function getName() {
        return $this->name;
    }

    public function getMarbles() {
        return $this->marbles;
    }
     // et les méthodes setMarbles() pour modifier la propriété $marbles
    public function setMarbles($newMarbles) {
        $this->marbles = $newMarbles;
    }
}

// Définition d'une classe appelée Hero qui hérite de la classe Characters

class Hero extends Characters {
    // je déclare les propriétés $loss, $gain et $scream_war en private pour qu'elles ne soient pas accessibles en dehors de la classe Hero
    // Mes propriétés sont protéées
    private $loss;
    private $gain;
    private $scream_war;
     // je déclare le constructeur de la classe Hero pour initialiser les propriétés lors de la création d'une instance
    public function __construct($name, $marbles, $loss, $gain, $scream_war) {
    // j'appelle le constructeur de la classe parente Characters pour y avoir accès et initialiser les propriétés $name et $marbles 
        parent::__construct($name, $marbles);
        $this->loss = $loss;
        $this->gain = $gain;
        $this->scream_war = $scream_war;
    }
    // les propriétés sont en private donc je dois créer des getters pour y accéder 
    // Donc je crée les méthodes getLoss(), getGain() et getScreamWar() pour accéder aux propriétés gràce aux return
    public function getLoss() {
        return $this->loss;
    }

    public function getGain() {
        return $this->gain;
    }

    public function getScreamWar() {
        return $this->scream_war;
    }

    // je crée la méthode OddEvenCheck() pour vérifier si le nombre de billes est pair ou impair
    //$number est un paramètre qui représente le nombre de billes de l'ennemi
    
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

// Définition d'une classe appelée Game
class Game {
    // je déclare les propriétés $ennemylist, $level et players
    private $ennemylist;
    // je déclare le tableau $level qui contient les  3 niveaux avec le nombre d'ennemis à affronter
    private $level = ['Facile' => 5, 'Difficile' => 10, 'Impossible'=> 20];
    private $players;

  
    // je crée la méthode heroes() pour créer les héros
    //j'instancie héros avec les paramètres $name, $marbles, $loss, $gain, $scream_war
    // j'ai créée 3 objets héros avec les paramètres précédemment définis
    private function heroes() {
        $seong = new Hero('Seong Gi-hun', 15, 2, 1, 'Bo !');
        $kang = new Hero('Kang Sae-byeok', 25, 1, 2, 'Boo !');
        $cho = new Hero('Cho Sang-woo', 35, 0, 3, 'BOOO');
        // je mets les héros dans un tableau
        $this->players = [$seong, $kang, $cho];
        
    }
    
    
    //  // je déclare le constructeur de la classe Game pour initialiser les propriétés lors de la création d'une instance
    public function __construct() {
        // je déclare que la propriété $ennemylist est égale à la méthode getEnnemy() défini plus bas
        $this->ennemylist = $this->getEnnemy();
        // j'appelle la méthode heroes() créer ci-dessus pour créer les héros
        $this->heroes();
    }
    // je crée la méthode getEnnemy() pour créer les  20 ennemis dans une boucle for
    // la methode est en private car elle ne sera utilisée que dans la classe Game et elle protégée
    private function getEnnemy() {
        // je déclare un tableau vide $ennemylist dasn lequel je vais stocker les ennemis créés
      $ennemylist = [];
        // je crée une boucle for avec la variable $i qui va de 0 à 20 qui défini le nombre d'ennemis à créer
        // la variable $i est incrémentée de 1 à chaque tour de boucle
        // et va définir le nom numéroté de l'ennemi
        // j'instancie ennemi avec les paramètres $name, $marbles, $age

      for ($i = 0; $i < 20; $i++) { 
         // je déclare la variable $name qui est égale à la chaine de caractère 'Ennemi' concaténée avec la variable $i
         // je déclare la variable $marbles qui est égale à un nombre aléatoire entre 15 et 40. ce nombre va définir le nombre de billes de l'ennemi aléatoirement
         // pareil pour l'age
          $name = "Ennemi " . $i;
          $marbles = rand(15, 40);
          $age = rand(10, 100);
          // pour chaque tour dans la boucle un ennemi est créé avec ses paramètres et il est stocké dans le tableau $ennemylist
          // j'instancie donc 20 ennemis avec les paramètres précédemment définis
          // j'ai un nouvel objet ennemi à chaque tour de boucle
          $ennemylist[] = new Ennemy($name, $marbles, $age);
          
        }
         // à la fin de la boucle je retourne le tableau $ennemylist qui contient les 20 ennemis
      return $ennemylist;
    }
    // je crée la méthode randomLevel() pour sélectionner un niveau aléatoirement
    public function randomLevel() {
        // j'appelle la méthode getRandomvalue() de la classe Utils pour obtenir un niveau aléatoire
        $randomLevel = Utils::getRandomvalue($this->level);

          // je défini une condition pour donner une instruction en fonction du niveau choisi aléatoirment
          // Pour chaque niveau je supprime un nombre d'ennemis en trop du tableau $ennemylist 
          // afin que le nombre d'ennemis corresponde au niveau choisi
       if($randomLevel == 5) {
          // le array_slice() permet de supprimer un nombre d'éléments d'un tableau
          // le premier paramètre est le tableau $ennemylist
          // le deuxième paramètre est l'index à partir duquel on veut supprimer les éléments
           array_slice($this->ennemylist, 6);
        
         } elseif($randomLevel == 10) {
            array_slice($this->ennemylist, 11);
         } else {
            array_slice($this->ennemylist, 21);
         }
    
       
         // j'affiche le niveau choisi aléatoirement
        return $randomLevel;
       
    }

     // je crée la méthode startGame() qui va commencer le jeu
    Public function startGame() {
        // je met les heroes dans un tableau $randHeroes et je les mélange
        $randHeroes = $this->players;
        // je mélange les héros pour qu'ils soient sélectionné aléatoirement
        shuffle($randHeroes);
        // je crée une boucle foreach pour parcourir le tableau $randHeroes 
        foreach( $randHeroes as $player) {
            
            //  je stocke la méthode randomLevel() dans la variable $randomLevel
            
            $randomLevel = $this->randomLevel();
            // j'appelle la méthode randomLevel() pour obtenir un niveau aléatoire 
            // j'affiche le niveau choisi aléatoirement
            $this->randomLevel();
            echo " <br> <br> Niveau " .$randomLevel. "<br> <br>";
            
            // je crée une boucle foreach pour parcourir le tableau $ennemylist et excuté des instructions à chaque tour de boucle
            // $key est la clé de l'élément en cours de traitement
            // donc le $key est l'index de l'ennemi dans le tableau $ennemylist
            foreach ($this->ennemylist as $key => $ennemy) {
                // j'appelle la méthode getRandomvalue() de la classe Utils pour obtenir un ennemi aléatoire
                $randomEnemy = Utils::getRandomvalue($this->ennemylist);
                //  je déclare que le le randomEnemy est égale à la variable $randomEnemy qui contient un ennemi aléatoire
                $this->randomEnemy = $randomEnemy;
                // Dans le echo j'affiche le nom du héros, le nombre de billes du héros, le nom de l'ennemi et le nombre de billes de l'ennemi grâce aux getters
                echo "le hero " .$player->getName(). " a " . $player->getMarbles() . " billes et il affronte " . $randomEnemy->getName() . " qui a " . $randomEnemy->getMarbles() . " billes." ."<br>";
                // la variable $guess  est égale à un nombre aléatoire entre 0 et 1
                $guess = rand(0, 1);
                //$guess1 = rand(0, 1);
                // je déclare une condition qui dit que si l'age de l'ennemi est supérieur à 70 et que le nombre aléatoire $guess est égale à 0 donc qu'il ne triche pas
                if ( $randomEnemy->getAge() > 70 && $guess == 0) {
                    // si le nombre de billes de l'ennemi est égale au nombre de $guess
                    // alors si le nombre de billes de l'ennemi est pair ou impair 
                    // donc le player tombe sur le bon nombre de billes de l'ennemi
                    if($player->OddEvenCheck($randomEnemy->getMarbles()) == $guess){
                        // alors l'ennemi est éliminé
                       echo $player->getName() . " a trouver le nombre de billes dans la mains de son adversaire" . "<br>"; 
                       // le player gagne les billes de l'ennemi et le gain du player donc le nonus qu'il a en plus
                       //le setmarbles permet de modifier le nombre de billes du player
                       $player->setMarbles($player->getMarbles() + $randomEnemy->getMarbles());
                       $player->setMarbles($player->getMarbles() + $player->getGain());
                       echo'il gagne '. $randomEnemy->getMarbles() ." + ".$player->getGain(). "<br> Il a maintenant " . $player->getMarbles() . " billes <br>";
                       // je supprime l'ennemi du tableau $ennemylist avec la fonction unset() parce qu'il a persu
                       unset($this->ennemylist[$key]);
                       //echo count($this->ennemylist). "<br>";
                       echo $randomEnemy->getName() . ' est iliminé <br>';
                       // si le tableau $ennemylist est vide et que le player a encore des billes j'exécute les instructions suivantes
                       if (count($this->ennemylist) == 0 && $player->getMarbles() > 0 ) {
                           echo "Plus d'adversaires disponibles. Le jeu est terminé." . "<br>";
                           echo $randomEnemy->getName() . ' est iliminé' .$player->getName(). " a ramporté la partie  <br>";
                           // avec le break je sors de la boucle donc je met fin à la partie
                           break;
                       }
                   
                    
                       // si le nombre de billes de l'ennemi est différent du nombre de $guess
                       // si le player ne tombe pas sur le bon nombre de billes de l'ennemi
                    } else {
                        
                        echo $player->getName() . " n'a pas trouver le nombre de billes dans la mains de son adversaire" . "<br>"; 
                        // le player perd les billes de l'ennemi plus le malus qu'il a en plus dans ses paramètres
                        $player->setMarbles($player->getMarbles() - $randomEnemy->getMarbles());
                        $player->setMarbles($player->getMarbles() - $player->getLoss());
                        echo'il perd '. $player->getLoss(). " + " .$randomEnemy->getMarbles() . "<br> Il a maintenant " . $player->getMarbles() . " billes <br>";
                        // si le player n'a plus de billes j'exécute les instructions suivantes 
                        //le jeu est terminé car le player n'a plus de billes
                        if($player->getMarbles() <= 0) {
                            echo $player->getName() . " a perdu toutes ses billes. La partie est terminée." . "<br>";
                            break;
                        }
                    }
                  // autrement si l'age de l'ennemi est supérieur à 70 et que le nombre aléatoire $guess est égale à 1 donc qu'il triche alors j'exécute les instructions suivantes
                  // et ensuite comme précédement je déclare une condition j'exécute encore les instructions 
                } else if ( $randomEnemy->getAge() > 70 && $guess == 1) {
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