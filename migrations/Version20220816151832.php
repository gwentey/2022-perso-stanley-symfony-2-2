<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816151832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ville VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, INDEX IDX_C7440455BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destruction (id INT AUTO_INCREMENT NOT NULL, production_id INT DEFAULT NULL, date_destruction DATE NOT NULL, quantite DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_48CE57A6ECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_creation DATE NOT NULL, date_reglement DATE DEFAULT NULL, INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moyen_de_reglement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, atelier_id INT NOT NULL, classe_id INT NOT NULL, produit_id INT DEFAULT NULL, temperature DOUBLE PRECISION NOT NULL, date_fabrication DATE NOT NULL, date_peremption DATE NOT NULL, quantite DOUBLE PRECISION NOT NULL, conditionnement DOUBLE PRECISION NOT NULL, prix_par_portion DOUBLE PRECISION NOT NULL, congelation TINYINT(1) NOT NULL, INDEX IDX_D3EDB1E0BAB22EE9 (professeur_id), INDEX IDX_D3EDB1E082E2CF35 (atelier_id), INDEX IDX_D3EDB1E08F5EA509 (classe_id), INDEX IDX_D3EDB1E0F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, famille_id INT DEFAULT NULL, unitee_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC2797A77B84 (famille_id), INDEX IDX_29A5EC27D3EB8572 (unitee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert (id INT AUTO_INCREMENT NOT NULL, type_transfert_id INT NOT NULL, production_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, date_transfert DATE NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_1E4EACBBBBDFF1A8 (type_transfert_id), INDEX IDX_1E4EACBBECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transfert (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unitee_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, profile VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, production_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_888A2A4C7F2DEE08 (facture_id), INDEX IDX_888A2A4CECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_client (id)');
        $this->addSql('ALTER TABLE destruction ADD CONSTRAINT FK_48CE57A6ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E08F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2797A77B84 FOREIGN KEY (famille_id) REFERENCES famille_produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27D3EB8572 FOREIGN KEY (unitee_id) REFERENCES unitee_produit (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBBBDFF1A8 FOREIGN KEY (type_transfert_id) REFERENCES type_transfert (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BCF5E72D');
        $this->addSql('ALTER TABLE destruction DROP FOREIGN KEY FK_48CE57A6ECC6147F');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0BAB22EE9');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E082E2CF35');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E08F5EA509');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2797A77B84');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27D3EB8572');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBBBBDFF1A8');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBBECC6147F');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C7F2DEE08');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4CECC6147F');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE categorie_client');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE destruction');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE famille_produit');
        $this->addSql('DROP TABLE moyen_de_reglement');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE transfert');
        $this->addSql('DROP TABLE type_transfert');
        $this->addSql('DROP TABLE unitee_produit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
    }
}
