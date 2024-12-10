![separe](https://github.com/studoo-app/.github/blob/main/profile/studoo-banner-logo.png)
# CYBER EVAL 2 : Tests Unitaires et Développement Piloté par les Tests (TDD)
[![Version](https://img.shields.io/badge/Version-2024-blue)]()

## Contexte
Vous travaillez sur le développement d'une application de gestion de Bibliothèque en ligne. Cette application 
permet de gérer les livres, les auteurs, les emprunts et les clients. 

Votre mission est de tester les différentes entités, services et contrôleurs de cette application.

### Exercice 1 : Test unitaire d'une Entité Simple
#### Objectif :
Créer et tester une entité Book qui représente un livre dans la bibliothèque.

#### Travail à faire :

- [ ] Créez une entité Book avec les propriétés suivantes :
  - id (integer) : Identifiant unique.
  - title (string) : Titre du livre.
  - isbn (string) : Numéro ISBN.
  - publishedAt (DateTime) : Date de publication.
- [ ] Écrivez un test unitaire pour vérifier le bon fonctionnement des getters et setters de l'entité.

### Exercice 2 : Test unitaire des validations d'une Entité 

#### Objectif :
Créer et tester les validations de l'entité Book. Un livre doit avoir un titre, un numéro ISBN et une date de publication.

#### Travail à faire :

- [ ] Ajoutez les annotations de validation suivantes à l'entité Book :
  - title : Ne peut pas être vide
  - isbn : Ne peut pas être vide et doit être une chaine de 14 caractères numériques,
  - publishedAt : Ne peut pas être vide
- [ ] Écrivez un test unitaire pour vérifier que :
  - Un livre sans titre n'est pas valide.
  - Un livre sans ISBN n'est pas valide.
  - Un livre sans date de publication n'est pas valide.
  - Un livre avec toutes les informations requises est valide.

### Exercice 3 : Test unitaire d'une Entité avec Relation
#### Objectif :
Créer et tester une relation entre un Auteur et un Livre. Un auteur peut écrire plusieurs livres.

#### Travail à faire :

- [ ] Créez une entité Author avec les propriétés suivantes :
  - id (integer) : Identifiant unique.
  - name (string) : Nom complet de l'auteur.
  - books (relation)
- [ ] Écrivez un test unitaire pour vérifier que :
  - On peut lier des livres à un auteur.
  - La suppression d’un livre de la liste de l’auteur fonctionne.

### Exercice 3 : Test d'un Service Moyennement Complexe
#### Objectif :
Créer et tester un service BorrowingManager qui gère les emprunts de livres par les clients.
Ce service doit vérifier si un client peut emprunter un livre en fonction de la disponibilité et du nombre de livres qu'il a déjà empruntés.

#### Travail à faire :

On souhaite implémenter le service suivant :
```php
// src/Service/BorrowingManager.php
namespace App\Service;

use App\Entity\Book;
use App\Entity\Client;

class BorrowingManager
{
    public function canBorrowBook(Client $client, Book $book): bool
    {
        if ($client->getBorrowedBooksCount() >= 5) {
            return false;
        }

        if ($book->isBorrowed()) {
            return false;
        }

        return true;
    }
}

```

- [ ] Implémenter le service et effectuer les modifications necéssaires.
- [ ] Écrivez un test unitaire pour la méthode canBorrowBook() en vérifiant :
  - Un client qui a déjà emprunté 5 livres ne peut pas emprunter d'autres.
  - Un client peut emprunter un livre disponible.
  - Un client ne peut pas emprunter un livre déjà emprunté par un autre client.

### Exercice 4 : Créer un Service via TDD 
#### Objectif :
A l'aide du fichier de tests ci-dessous, créer un service LateFeeCalculator qui sera destiné pour une implémentation future
au calcul du montant des frais de retard lorsqu'un client rend un livre en retard.

La méthode calculera le nombre de jours de retard et applique un frais de 0,50 € par jour de retard.
Si le livre est rendu à temps ou en avance, le frais est de 0,00 €.

Vous utiliserez la méthodologie TDD (Test Driven Development).

```php
// tests/Service/LateFeeCalculatorTest.php
namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\LateFeeCalculator;

class LateFeeCalculatorTest extends TestCase
{
    public function testCalculateLateFee(): void
    {
        $calculator = new LateFeeCalculator();
        $dueDate = new \DateTime('2024-01-01');
        $returnDate = new \DateTime('2024-01-04');

        $this->assertEquals(1.5, $calculator->calculateLateFee($dueDate, $returnDate));
    }
}

```

#### Travail à faire :

- [ ] Implémenter le test `LateFeeCalculatorTest`
- [ ] Implémenter le service afin que le test unitaire fonctionne
- [ ] Ajoutez des tests pour les cas suivants :
  - Le livre est retourné avant la date d’échéance (frais = 0 €).
  - Le livre est retourné le jour même (frais = 0 €).
  - Le livre est retourné avec 3 jours de retard (frais = 1,50 €).


