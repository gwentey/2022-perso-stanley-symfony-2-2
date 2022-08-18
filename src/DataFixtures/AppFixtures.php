<?php

namespace App\DataFixtures;

use App\Entity\Atelier;
use App\Entity\CategorieClient;
use App\Entity\Classe;
use App\Entity\Client;
use App\Entity\Composition;
use App\Entity\FamilleProduit;
use App\Entity\MoyenDeReglement;
use App\Entity\Production;
use App\Entity\Produit;
use App\Entity\Professeur;
use App\Entity\TypeTransfert;
use App\Entity\UniteeProduit;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        // TABLEAU DE STOCKAGE
        $tableauDeCategorie = [];
        $tableauDeFamilleProduit = [];
        $tableauDesClients = [];
        $tableauDesClasses = [];
        $tableauDesAteliers = [];
        $tableauDesProduits = [];
        $tableauDesProfesseurs = [];
        $tableauDesTypesTransfert = [];
        $tableauDesProductions = [];
        $tableauDesUniteesProduit = [];
        $tableauDesMoyensReglements = [];
        $tableauDesCompositions = [];



        // Création des categories clients
        $categorieClientNom = array("Elèves", "Profs", "Autres");
        foreach ($categorieClientNom as $value) {
            $categorieClient = new CategorieClient;
            $categorieClient->setNom($value);
            array_push($tableauDeCategorie, $categorieClient);

            $manager->persist($categorieClient);
        }


        // Création des moyens de reglement
        $moyensDeReglement = array("Non réglé", "Carte Bancaire", "Chèque", "Espèce");
        foreach ($moyensDeReglement as $moy) {
            $moyen = new MoyenDeReglement;
            $moyen->setNom($moy);
            array_push($tableauDesMoyensReglements, $moyen);

            $manager->persist($moyen);
        }

        // Création des ateliers
        $lesAteliers = array(
            "Boucherie", "Charcutier Traiteur", "Cuisine CFA",
            "Cuisine GRETA", "Cuisine Lycee", "Emballages", "Patisserie Boulangerie"
        );
        foreach ($lesAteliers as $at) {
            $atelier = new Atelier;
            $atelier->setNom($at);
            array_push($tableauDesAteliers, $atelier);

            $manager->persist($atelier);
        }

        // Création des classes
        $lesClasses = array("Non renseigné", "BTS2", "BTS3", "CAP1", "CAP2");
        foreach ($lesClasses as $classe) {
            $laClasse = new Classe;
            $laClasse->setNom($classe);
            array_push($tableauDesClasses, $laClasse);
            $manager->persist($laClasse);
        }

        // Création des clients
        for ($i = 0; $i < 10; $i++) {
            $client = new Client;
            $client->setNom("Nom " . $i);
            $client->setPrenom("Prenom " . $i);
            $client->setVille("Ville " . $i);
            $client->setTelephone($i . $i . $i . $i . $i . $i . $i . $i . $i . $i);
            $client->setMail("mail" . $i . "@gail.com");
            $client->setCategorie($tableauDeCategorie[random_int(0, 2)]);
            array_push($tableauDesClients, $client);
            $manager->persist($client);
        }

        // Création des familles de produits
        $lesFamillesProduits = array(
            "Plats cuisinés avec garniture", "Plats cuisinés sans garniture", "Divers",
            "Charcuterie à cuire", "Entrées froides", "Pâtisserie charcutière", "Garniture", "Plat complet traditionnel",
            "Plat cuisiné festif", "Potage", "Petits fours", "Pâtisserie", "Boulangerie", "Confiserie", "Charcuterie cuite"
        );

        foreach ($lesFamillesProduits as $fam) {
            $famille = new FamilleProduit;
            $famille->setNom($fam);
            array_push($tableauDeFamilleProduit, $famille);
            $manager->persist($famille);
        }


        // Création des unitées produits
        $lesUniteesProduit = array("Portion", "Kg", "Pièce", "Litre");

        foreach ($lesUniteesProduit as $uni) {
            $unitee = new UniteeProduit;
            $unitee->setNom($uni);
            array_push($tableauDesUniteesProduit, $unitee);
            $manager->persist($unitee);
        }

         // Création des compostions
         $composition = array(
            array('nom' => 'Petit sac de transport papier', 'prix' => '0.15'),
            array('nom' => 'Grand sac de transport papier', 'prix' => '0.25'),
            array('nom' => 'Charcuterie à cuire à base de porc', 'prix' => '10'),
            array('nom' => 'Charcuterie cuite : pâté, terrine et galantine de porc', 'prix' => '10'),
            array('nom' => 'Charcuterie cuite : pâté, terrine et galantine de volaille et lapin', 'prix' => '11'),
            array('nom' => 'Charcuterie cuite : terrine de poisson et/ou  fruits de mer', 'prix' => '11'),
            array('nom' => 'Charcuterie cuite : terrine festive', 'prix' => '27'),
            array('nom' => 'Charcuterie cuite : produits tripiers', 'prix' => '6'),
            array('nom' => 'Charcuterie cuite : saucisserie', 'prix' => '11'),
            array('nom' => 'Charcuterie cuite : saucisserie sèche', 'prix' => '8'),
            array('nom' => 'Entrées froides : poisson fumé', 'prix' => '30'),
            array('nom' => 'Entrées froides : foie gras de canard', 'prix' => '60'),
            array('nom' => 'Entrées froides à base de légumes', 'prix' => '1'),
            array('nom' => 'Entrées froides : poisson froid', 'prix' => '3'),
            array('nom' => 'Pâtisserie charcutière : quiche simple  et pizza', 'prix' => '1'),
            array('nom' => 'Pâtisserie charcutière : tourte/quiche prestige', 'prix' => '1.2'),
            array('nom' => 'Pâtisserie charcutière : crêpes fourrées', 'prix' => '1.5'),
            array('nom' => 'Pâtisserie charcutière : feuilleté garniture simple', 'prix' => '1'),
            array('nom' => 'Pâtisserie charcutière : feuilleté garniture plus élaborée', 'prix' => '1.2'),
            array('nom' => 'Plats cuisinés sans garniture à base de porc, poulet ou dinde', 'prix' => '2'),
            array('nom' => 'Plats cuisinés sans garniture à base de gibier, canard, lapin, bœuf, veau et agneau(bas morceaux)', 'prix' => '2.1'),
            array('nom' => 'Plats cuisinés sans garniture à base de morceaux nobles de bœuf , veau et agneau', 'prix' => '2.7'),
            array('nom' => 'Plats cuisinés sans garniture : poisson en filet ou darne', 'prix' => '2.7'),
            array('nom' => 'Plats cuisinés sans garniture : poisson en mousseline', 'prix' => '1.5'),
            array('nom' => 'Garniture à base de féculents', 'prix' => '0.5'),
            array('nom' => 'Garniture à base de légumes', 'prix' => '0.7'),
            array('nom' => 'Garniture : gratin', 'prix' => '1'),
            array('nom' => 'Plat complet traditionnel', 'prix' => '3.5'),
            array('nom' => 'Plat cuisiné festif', 'prix' => '4.2'),
            array('nom' => 'Potage à base de légumes', 'prix' => '2'),
            array('nom' => 'Potage à base de poissons', 'prix' => '3.5'),
            array('nom' => 'Petits fours : bouchée cocktail salée', 'prix' => '0.5'),
            array('nom' => 'Petits fours : bouchée cocktail sucrée', 'prix' => '0.5'),
            array('nom' => 'Pâtisserie simple, un seul appareil', 'prix' => '0.9'),
            array('nom' => 'Pâtisserie simple, deux appareils', 'prix' => '1'),
            array('nom' => 'Pâtisserie : gâteau élaboré individuel', 'prix' => '1.8'),
            array('nom' => ' Pâtisserie : gâteau élaboré, à partager', 'prix' => '1.7'),
            array('nom' => 'Pâtisserie : entremets pâtissier individuel ou à partager', 'prix' => '2.4'),
            array('nom' => 'Pâtisserie : tarte sucrée de base', 'prix' => '1'),
            array('nom' => 'Pâtisserie : tarte sucrée complexe', 'prix' => '1.2'),
            array('nom' => 'Pâtisserie : biscuits secs', 'prix' => '8'),
            array('nom' => 'Boulangerie : pain', 'prix' => '2'),
            array('nom' => 'Boulangerie : viennoiseries', 'prix' => '0.5'),
            array('nom' => 'Confiserie : chocolats', 'prix' => '20'),
            array('nom' => 'Confiserie sans chocolat', 'prix' => '10')
        );
        foreach ($composition as $com) {
            $composition = new Composition;
            $composition->setNom($com['nom']);
            $composition->setPrix($com['prix']);

            array_push($tableauDesCompositions, $composition);
            $manager->persist($composition);
        }


        // Création des produits
        $lesNomsProduit = array(
            "Allumettes au foie gras", "Artichauts poivrade", "Asperges en petits pois", "Avocat au saumon",
            "Avocat au thon", "Avocat aux crevettes sautées", "Bouchées fumées", "Bouchées montagnardes",
            "Canapés façon bistrot", "Céleris rémoulade", "Crackers", "Salade provencal",
            "Salade de tomate", "Pomme au four", "Pizza veggie", "Haricot au four"
        );

        foreach ($lesNomsProduit as $prod) {
            $produit = new Produit;
            $produit->setNom($prod);
            $produit->setPrix(random_int(0, 50) / 2);
            $produit->setUnitee($tableauDesUniteesProduit[random_int(0, count($tableauDesUniteesProduit) - 1)]);
            $produit->setFamille($tableauDeFamilleProduit[random_int(0, count($tableauDeFamilleProduit) - 1)]);
            $produit->addComposition($tableauDesCompositions[random_int(0, count($tableauDesCompositions) - 1)]);
            $produit->addComposition($tableauDesCompositions[random_int(0, count($tableauDesCompositions) - 1)]);
            array_push($tableauDesProduits, $produit);
            $manager->persist($produit);
        }


        // Création des professeurs
        for ($i = 0; $i < 6; $i++) {
            $professeur = new Professeur;
            $professeur->setNom("Nom " . $i);
            $professeur->setPrenom("Prenom " . $i);
            array_push($tableauDesProfesseurs, $professeur);
            $manager->persist($professeur);
        }

        // Création des types transferts
        $typesTransfert = array("Self", "Cuisine", "Autres");
        foreach ($typesTransfert as $tras) {
            $typesTransfert = new TypeTransfert;
            $typesTransfert->setNom($tras);
            array_push($tableauDesTypesTransfert, $typesTransfert);

            $manager->persist($typesTransfert);
        }

        // Création des professeurs
        for ($i = 0; $i < 18; $i++) {
            $production = new Production;
            $production->setClasse($tableauDesClasses[random_int(0, count($tableauDesClasses) - 1)]);
            $production->setProduit($tableauDesProduits[random_int(0, count($tableauDesProduits) - 1)]);
            $production->setAtelier($tableauDesAteliers[random_int(0, count($tableauDesAteliers) - 1)]);
            $production->setProfesseur($tableauDesProfesseurs[random_int(0, count($tableauDesProfesseurs) - 1)]);
            $production->setTemperature(random_int(0, 10));
            // genération des dates
            $today = new \DateTime('now');
            $datePerm = $today->modify("+5 day");
            $production->setDateFabrication($today);
            $production->setDatePeremption($datePerm);
            $production->setQuantite(random_int(1, 15));
            $production->setConditionnement(random_int(1, 15));
            $production->setPrixParPortion(random_int(0, 50) / 2);
            $production->setCongelation(false);

            array_push($tableauDesProductions, $production);
            $manager->persist($production);
        }

        // Création des utilisateurs
        $user = new User;
        $plaintextPassword = "admin";
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );

        $user->setUsername("admin");
        $user->setNom("Rodrigues");
        $user->setPrenom("Anthony");
        $user->setProfile(4);
        $user->setPassword($hashedPassword);

        $manager->persist($user);


        $manager->flush();
    }
}
