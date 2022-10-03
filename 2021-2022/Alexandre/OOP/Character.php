<?php

// Exo 1

// class Character {

//     public string $health = '90hp';

//     public string $damage = '25dmg';

//     public function getName() {

//         echo 'My name is Souleyman';

//     }
// }

// $newCharacter = new Character();

// var_dump($newCharacter);
// $newCharacter->getName();

// Exo 2

// class Calculator {

//     public function sum(int $number1, int $number2):int {

//         return $number1 + $number2;

//     }

//     public function substract(int $number1, int $number2):int {

//         return $number1 - $number2;

//     }

//     public function multiply(int $number1, int $number2):int {

//         return : $number1 * $number2;

//     }

//     public function divide(int $number1, int $number2):float {

//         return $number1 / $number2;

//     }
// }

// $newCalcul = new Calculator();

// var_dump($newCalcul->sum(1,2));
// var_dump($newCalcul->substract(1,2));
// var_dump($newCalcul->multiply(1,2));
// var_dump($newCalcul->divide(1,2));

// Exo 3

class Character {

    public string $name;

    public int $health;

    public int $damage;

    public function __construct($name, $health, $damage) {

        $this->name = $name;
        
        $this->health = $health;

        $this->damage = $damage;
        
    }

    public function sayHi() {

        return 'Hey, I am '. $this->name . ' !';

    }

    public function getHealth() {

        return 'I have '. $this->health . ' hp !';

    }

    public function setHealth($newHealth) {

        $this->health = $newHealth;

        echo 'Le nombre d\'hp de ' . $this->name . ' est maintenant de ' . $this->health . 'hp !' . "<br>";

    }

    public function attack($target) {

        $target->health -= $this->damage;

        echo $target->name . ' a maintenant ' . $target->health . ' hp !' . "<br>";

    }
}

class Stage {

    public function fight($opponent1, $opponent2) {

        while ($opponent1->health > 0 && $opponent2->health > 0) {

            $coinflip = random_int(0, 1);

            if ($coinflip === 0) {

                $opponent1->health -= $opponent2->damage;

                if ($opponent1->health <= 0) {
                    
                    echo $opponent2->name . ' has won ! (With ' . $opponent2->health . ' hp ! ezz)';

                } else {

                    echo $opponent1->name . ' a maintenant ' . $opponent1->health . ' hp !' . "<br>";

                }

            } else {

                $opponent2->health -= $opponent1->damage;

                if ($opponent2->health <= 0) {
                    
                    echo $opponent1->name . ' has won ! (With ' . $opponent1->health . ' hp ! ezz)';

                } else {

                    echo $opponent2->name . ' a maintenant ' . $opponent2->health . ' hp !' . "<br>";

                }

            }
        }
    }
}

// $newCharacter = new Character('Bibi', 1800, 400);

// var_dump($newCharacter);
// $newCharacter->sayHi();
// $newCharacter->getHealth();

// $character2 = new Character('LeRoiAdib', 2000, 350);

// var_dump($character2);
// $character2->sayHi();
// $character2->getHealth();

// $newStage = new Stage();

// $newStage->fight($newCharacter, $character2);

// Exo 4

class Card {

    public string $number;

    public string $suit;

    public function __construct($number, $suit) {

        $this->number = $number;

        $this->suit = $suit;

    }

}

class Deck {

    public array $cards = [];

    public function addCard($card) {

        $this->cards[] = $card;

    }

    public function shuffle() {

        shuffle($this->cards);

    }

    public function pickOne() {

        $randomCard = random_int(0, count($this->cards)-1);
        
        return $this->cards[$randomCard];

    }

}

// $deck1 = new Deck();

// $card1 = new Card('9', 'trefle');

// $card2 = new Card('2', 'carreau');

// $card3 = new Card('5', 'coeur');

// $card4 = new Card('10', 'pic');

// $card5 = new Card('roi', 'pic');

// $card6 = new Card('valet', 'coeur');

// $card7 = new Card('dame', 'carreau');

// var_dump($deck1);

// $deck1->addCard($card1);

// $deck1->addCard($card2);

// $deck1->addCard($card3);

// $deck1->addCard($card4);

// $deck1->addCard($card5);

// $deck1->addCard($card6);

// $deck1->addCard($card7);

// var_dump($deck1);

// $deck1->shuffle();

// var_dump($deck1);

// var_dump($deck1->pickOne());

// Exo 5

class Author {

    public string $firstname;
    
    public string $lastname;

    public array $booksOfAuthor;

    public function __construct(string $firstname, string $lastname, array $booksOfAuthor) {

        $this->booksOfAuthor = [];

        $this->firstname = $firstname;

        $this->lastname = $lastname;

    }

}

class Book {

    public string $name;

    public DateTimeImmutable $releaseDate;

    public Author $Author;

    public function __construct(string $name, DateTimeImmutable $releaseDate, Author $Author) {

        $Author->booksOfAuthor[] = $name;

        $this->name = $name;

        $this->releaseDate = $releaseDate;

        $this->Author = $Author;
        
    }

}

$author1 = new Author('Romain', 'Laurent', []);

$author2 = new Author('William', 'Queva', []);

$author3 = new Author('Geoffrey', 'Mauroy', []);

$book1 = new Book('harry potter wsh', new \DateTimeImmutable('2002-01-20'), $author1);
$book4 = new Book('harry potter il est où ?', new \DateTimeImmutable('2004-01-20'), $author1);
$book7 = new Book('harry potter retrouvé !', new \DateTimeImmutable('2006-01-20'), $author1);

$book2 = new Book('Aladin', new \DateTimeImmutable('1998-07-20'), $author2);
$book5 = new Book('Aladin 2', new \DateTimeImmutable('2000-07-20'), $author2);
$book8 = new Book('Aladin 4', new \DateTimeImmutable('2002-07-20'), $author2);

$book3 = new Book('Pokemon', new \DateTimeImmutable('1998-09-27'), $author3);
$book6 = new Book('Pokemon 2', new \DateTimeImmutable('2000-09-27'), $author3);
$book9 = new Book('Pokemon 2 bis', new \DateTimeImmutable('2001-09-27'), $author3);

// var_dump($author1, $author2, $author3);

// Exo 6

class BankAccount {

    protected int $balance = 80;

    public function withdraw(int $amount) {

        if ($this->balance > $amount) {

            $this->balance -= $amount;

            echo "Votre compte en banque contient maintenant " . $this->balance . " euros. <br>";

        } else {
            
            throw new Exception('Not enough money on this account');
            echo "Votre compte ne contient pas suffisament de fonds pour retirer ce montant. <br>";

        }

    }
    
    public function deposit(int $amount) {

        $this->balance += $amount;

        echo "Votre compte en banque contient maintenant " . $this->balance . " euros. <br>";

    }

}

class SavingAccount extends BankAccount {

    public float $tauxInteret;

    public function __construct(float $tauxInteret) {

        $this->tauxInteret = $tauxInteret;

    }

    public function AddInterest () {

        $this->balance = $this->balance + ($this->balance * $this->tauxInteret);

        echo "Votre compte en banque contient maintenant " . $this->balance . " euros ! Vive les taux d'intérêts ! <br>";

    }

}

$bankAccount1 = new BankAccount();

// $bankAccount1->deposit(500);
// $bankAccount1->deposit(2);
$bankAccount1->withdraw(5);

// $savingAccount1 = new SavingAccount(25);
// $savingAccount1->AddInterest();

// Exo 7

