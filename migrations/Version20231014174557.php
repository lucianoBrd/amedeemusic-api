<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231014174557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE gallery ADD extension VARCHAR(50) NOT NULL, ADD type VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE testimonial ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP image');
        $this->addSql('ALTER TABLE gallery DROP extension, DROP type');
        $this->addSql('ALTER TABLE testimonial DROP image');
    }
}
