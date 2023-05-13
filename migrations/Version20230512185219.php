<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512185219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75D5A2101');
        $this->addSql('DROP INDEX IDX_3BAE0AA75D5A2101 ON event');
        $this->addSql('ALTER TABLE event DROP local_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD local_id INT NOT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA75D5A2101 ON event (local_id)');
    }
}
