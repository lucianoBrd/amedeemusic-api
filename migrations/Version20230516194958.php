<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516194958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, date DATETIME NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(350) NOT NULL, UNIQUE INDEX UNIQ_C0155143989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_content (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, blog_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_12338D2A5D5A2101 (local_id), INDEX IDX_12338D2ADAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blog_content ADD CONSTRAINT FK_12338D2A5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE blog_content ADD CONSTRAINT FK_12338D2ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_content DROP FOREIGN KEY FK_12338D2A5D5A2101');
        $this->addSql('ALTER TABLE blog_content DROP FOREIGN KEY FK_12338D2ADAE07E97');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE blog_content');
    }
}
