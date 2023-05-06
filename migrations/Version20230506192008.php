<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230506192008 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, about VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, man VARCHAR(255) NOT NULL, header VARCHAR(255) DEFAULT NULL, project VARCHAR(255) DEFAULT NULL, gallery VARCHAR(255) DEFAULT NULL, video VARCHAR(255) DEFAULT NULL, videos_link VARCHAR(255) NOT NULL, blog VARCHAR(255) DEFAULT NULL, subscribe VARCHAR(255) DEFAULT NULL, testimonial VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) NOT NULL, INDEX IDX_15996875D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, place VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, INDEX IDX_3BAE0AA75D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, local VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, title_id INT DEFAULT NULL, project_id INT DEFAULT NULL, link VARCHAR(255) NOT NULL, fa VARCHAR(255) NOT NULL, INDEX IDX_3952D0CBA9F87BD (title_id), INDEX IDX_3952D0CB166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE politic (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, title VARCHAR(255) NOT NULL, document LONGTEXT NOT NULL, INDEX IDX_A136B09F5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, local_id INT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EEC54C8C93 (type_id), INDEX IDX_2FB3D0EE5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social (id INT AUTO_INCREMENT NOT NULL, link VARCHAR(255) NOT NULL, fa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, citation VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_E6BDCDF75D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, local_id INT NOT NULL, name VARCHAR(255) NOT NULL, lyrics LONGTEXT DEFAULT NULL, INDEX IDX_2B36786B166D1F9C (project_id), INDEX IDX_2B36786B5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8CDE57295D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, subscribe TINYINT(1) NOT NULL, secret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, INDEX IDX_7CC7DA2C5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996875D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA75D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CBA9F87BD FOREIGN KEY (title_id) REFERENCES title (id)');
        $this->addSql('ALTER TABLE platform ADD CONSTRAINT FK_3952D0CB166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE politic ADD CONSTRAINT FK_A136B09F5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF75D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE title ADD CONSTRAINT FK_2B36786B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE title ADD CONSTRAINT FK_2B36786B5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE57295D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996875D5A2101');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA75D5A2101');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CBA9F87BD');
        $this->addSql('ALTER TABLE platform DROP FOREIGN KEY FK_3952D0CB166D1F9C');
        $this->addSql('ALTER TABLE politic DROP FOREIGN KEY FK_A136B09F5D5A2101');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEC54C8C93');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE5D5A2101');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF75D5A2101');
        $this->addSql('ALTER TABLE title DROP FOREIGN KEY FK_2B36786B166D1F9C');
        $this->addSql('ALTER TABLE title DROP FOREIGN KEY FK_2B36786B5D5A2101');
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE57295D5A2101');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C5D5A2101');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE local');
        $this->addSql('DROP TABLE platform');
        $this->addSql('DROP TABLE politic');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE social');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE title');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
