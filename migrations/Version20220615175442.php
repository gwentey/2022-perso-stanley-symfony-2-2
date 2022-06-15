<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615175442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, ville VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, INDEX IDX_C7440455BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destruction (id INT AUTO_INCREMENT NOT NULL, date_destruction DATE NOT NULL, quantite DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date_creation DATE NOT NULL, date_reglement DATE DEFAULT NULL, INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE moyen_de_reglement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert (id INT AUTO_INCREMENT NOT NULL, type_transfert_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, date_transfert DATE NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_1E4EACBBBBDFF1A8 (type_transfert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_transfert (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, facture_id INT DEFAULT NULL, production_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, INDEX IDX_888A2A4C7F2DEE08 (facture_id), INDEX IDX_888A2A4CECC6147F (production_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie_client (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBBBDFF1A8 FOREIGN KEY (type_transfert_id) REFERENCES type_transfert (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4CECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('ALTER TABLE production ADD destruction_id INT DEFAULT NULL, ADD transfert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E03292C08E FOREIGN KEY (destruction_id) REFERENCES destruction (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E03C9C4BAD FOREIGN KEY (transfert_id) REFERENCES transfert (id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E03292C08E ON production (destruction_id)');
        $this->addSql('CREATE INDEX IDX_D3EDB1E03C9C4BAD ON production (transfert_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BCF5E72D');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E03292C08E');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C7F2DEE08');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E03C9C4BAD');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBBBBDFF1A8');
        $this->addSql('DROP TABLE categorie_client');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE destruction');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE moyen_de_reglement');
        $this->addSql('DROP TABLE transfert');
        $this->addSql('DROP TABLE type_transfert');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP INDEX IDX_D3EDB1E03292C08E ON production');
        $this->addSql('DROP INDEX IDX_D3EDB1E03C9C4BAD ON production');
        $this->addSql('ALTER TABLE production DROP destruction_id, DROP transfert_id');
    }
}
