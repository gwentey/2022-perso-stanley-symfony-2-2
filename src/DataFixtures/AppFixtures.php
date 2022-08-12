<?php

namespace App\DataFixtures;

use App\Entity\Atelier;
use App\Entity\CategorieClient;
use App\Entity\Classe;
use App\Entity\Client;
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
