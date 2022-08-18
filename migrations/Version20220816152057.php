<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816152057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_composition (produit_id INT NOT NULL, composition_id INT NOT NULL, INDEX IDX_726707C3F347EFB (produit_id), INDEX IDX_726707C387A2E12 (composition_id), PRIMARY KEY(produit_id, composition_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_composition ADD CONSTRAINT FK_726707C3F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_composition ADD CONSTRAINT FK_726707C387A2E12 FOREIGN KEY (composition_id) REFERENCES composition (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_composition DROP FOREIGN KEY FK_726707C3F347EFB');
        $this->addSql('ALTER TABLE produit_composition DROP FOREIGN KEY FK_726707C387A2E12');
        $this->addSql('DROP TABLE produit_composition');
    }
}
