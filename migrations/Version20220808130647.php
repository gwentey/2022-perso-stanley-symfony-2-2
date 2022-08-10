<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808130647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfert ADD production_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('CREATE INDEX IDX_1E4EACBBECC6147F ON transfert (production_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBBECC6147F');
        $this->addSql('DROP INDEX IDX_1E4EACBBECC6147F ON transfert');
        $this->addSql('ALTER TABLE transfert DROP production_id');
    }
}
