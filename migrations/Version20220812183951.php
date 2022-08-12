<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812183951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composition (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composition_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, composition_id INT DEFAULT NULL, INDEX IDX_34D2FB5FF347EFB (produit_id), INDEX IDX_34D2FB5F87A2E12 (composition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composition_produit ADD CONSTRAINT FK_34D2FB5FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE composition_produit ADD CONSTRAINT FK_34D2FB5F87A2E12 FOREIGN KEY (composition_id) REFERENCES composition (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE composition_produit DROP FOREIGN KEY FK_34D2FB5FF347EFB');
        $this->addSql('ALTER TABLE composition_produit DROP FOREIGN KEY FK_34D2FB5F87A2E12');
        $this->addSql('DROP TABLE composition');
        $this->addSql('DROP TABLE composition_produit');
    }
}
