<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517122017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, date DATETIME DEFAULT NULL, man VARCHAR(255) NOT NULL, header VARCHAR(255) DEFAULT NULL, project VARCHAR(255) DEFAULT NULL, gallery VARCHAR(255) DEFAULT NULL, video VARCHAR(255) DEFAULT NULL, videos_link VARCHAR(255) NOT NULL, blog VARCHAR(255) DEFAULT NULL, subscribe VARCHAR(255) DEFAULT NULL, testimonial VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, footer VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_about (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, artist_id INT NOT NULL, about VARCHAR(3000) NOT NULL, INDEX IDX_D5F812B05D5A2101 (local_id), INDEX IDX_D5F812B0B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, image VARCHAR(255) NOT NULL, date DATETIME NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(350) NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_C0155143989D9B62 (slug), INDEX IDX_C01551435D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, place VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE local (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, local VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8BD688E88BD688E8 (local), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo_favicon (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo_png (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logo_png_email (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, message LONGTEXT NOT NULL, date DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE politic (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, title VARCHAR(255) NOT NULL, document LONGTEXT NOT NULL, INDEX IDX_A136B09F5D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EEC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_platform (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, link VARCHAR(255) NOT NULL, fa VARCHAR(255) NOT NULL, INDEX IDX_41C5B10166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social (id INT AUTO_INCREMENT NOT NULL, link VARCHAR(255) NOT NULL, fa VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE testimonial (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, citation VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_E6BDCDF75D5A2101 (local_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) NOT NULL, lyrics LONGTEXT DEFAULT NULL, INDEX IDX_2B36786B166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title_platform (id INT AUTO_INCREMENT NOT NULL, title_id INT DEFAULT NULL, link VARCHAR(255) NOT NULL, fa VARCHAR(255) NOT NULL, INDEX IDX_10C9656AA9F87BD (title_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mail VARCHAR(255) NOT NULL, subscribe TINYINT(1) NOT NULL, secret VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video_description (id INT AUTO_INCREMENT NOT NULL, local_id INT NOT NULL, video_id INT NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_4F66F1875D5A2101 (local_id), INDEX IDX_4F66F18729C1004E (video_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_about ADD CONSTRAINT FK_D5F812B05D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE artist_about ADD CONSTRAINT FK_D5F812B0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE blog ADD CONSTRAINT FK_C01551435D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE politic ADD CONSTRAINT FK_A136B09F5D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE project_platform ADD CONSTRAINT FK_41C5B10166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE testimonial ADD CONSTRAINT FK_E6BDCDF75D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE title ADD CONSTRAINT FK_2B36786B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE title_platform ADD CONSTRAINT FK_10C9656AA9F87BD FOREIGN KEY (title_id) REFERENCES title (id)');
        $this->addSql('ALTER TABLE video_description ADD CONSTRAINT FK_4F66F1875D5A2101 FOREIGN KEY (local_id) REFERENCES local (id)');
        $this->addSql('ALTER TABLE video_description ADD CONSTRAINT FK_4F66F18729C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql(file_get_contents(__DIR__ . '/sql-dump.sql'));
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_about DROP FOREIGN KEY FK_D5F812B05D5A2101');
        $this->addSql('ALTER TABLE artist_about DROP FOREIGN KEY FK_D5F812B0B7970CF8');
        $this->addSql('ALTER TABLE blog DROP FOREIGN KEY FK_C01551435D5A2101');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE politic DROP FOREIGN KEY FK_A136B09F5D5A2101');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEC54C8C93');
        $this->addSql('ALTER TABLE project_platform DROP FOREIGN KEY FK_41C5B10166D1F9C');
        $this->addSql('ALTER TABLE testimonial DROP FOREIGN KEY FK_E6BDCDF75D5A2101');
        $this->addSql('ALTER TABLE title DROP FOREIGN KEY FK_2B36786B166D1F9C');
        $this->addSql('ALTER TABLE title_platform DROP FOREIGN KEY FK_10C9656AA9F87BD');
        $this->addSql('ALTER TABLE video_description DROP FOREIGN KEY FK_4F66F1875D5A2101');
        $this->addSql('ALTER TABLE video_description DROP FOREIGN KEY FK_4F66F18729C1004E');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_about');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE local');
        $this->addSql('DROP TABLE logo_favicon');
        $this->addSql('DROP TABLE logo_png');
        $this->addSql('DROP TABLE logo_png_email');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE politic');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_platform');
        $this->addSql('DROP TABLE social');
        $this->addSql('DROP TABLE testimonial');
        $this->addSql('DROP TABLE title');
        $this->addSql('DROP TABLE title_platform');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE video_description');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
