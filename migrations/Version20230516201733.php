<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516201733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_content DROP FOREIGN KEY FK_12338D2A5D5A2101');
        $this->addSql('ALTER TABLE blog_content DROP FOREIGN KEY FK_12338D2ADAE07E97');
        $this->addSql('DROP TABLE blog_content');
        $this->addSql('ALTER TABLE blog ADD local_id INT NOT NULL, ADD content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551435D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('CREATE INDEX IDX_C01551435D5A2101 ON blog (local_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_content (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, blog_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_12338D2ADAE07E97 (blog_id), INDEX IDX_12338D2A5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE blog_content ADD CONSTRAINT FK_12338D2A5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE blog_content ADD CONSTRAINT FK_12338D2ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551435D5A2101');
        $this->addSql('DROP INDEX IDX_C01551435D5A2101 ON blog');
        $this->addSql('ALTER TABLE blog DROP local_id, DROP content');
    }
}
