<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808125417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destruction ADD production_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE destruction ADD CONSTRAINT FK_48CE57A6ECC6147F FOREIGN KEY (production_id) REFERENCES production (id)');
        $this->addSql('CREATE INDEX IDX_48CE57A6ECC6147F ON destruction (production_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destruction DROP FOREIGN KEY FK_48CE57A6ECC6147F');
        $this->addSql('DROP INDEX IDX_48CE57A6ECC6147F ON destruction');
        $this->addSql('ALTER TABLE destruction DROP production_id');
    }
}
