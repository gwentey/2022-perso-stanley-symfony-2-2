<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615172225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE production (id INT AUTO_INCREMENT NOT NULL, professeur_id INT NOT NULL, atelier_id INT NOT NULL, classe_id INT NOT NULL, temperature DOUBLE PRECISION NOT NULL, date_fabrication DATE NOT NULL, date_peremption DATE NOT NULL, quantite DOUBLE PRECISION NOT NULL, conditionnement DOUBLE PRECISION NOT NULL, INDEX IDX_D3EDB1E0BAB22EE9 (professeur_id), INDEX IDX_D3EDB1E082E2CF35 (atelier_id), INDEX IDX_D3EDB1E08F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E0BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE production ADD CONSTRAINT FK_D3EDB1E08F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E082E2CF35');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E08F5EA509');
        $this->addSql('ALTER TABLE production DROP FOREIGN KEY FK_D3EDB1E0BAB22EE9');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE production');
        $this->addSql('DROP TABLE professeur');
    }
}
