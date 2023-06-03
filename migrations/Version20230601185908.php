<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601185908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, blog_articles_id INT DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, paragraph_bold VARCHAR(255) DEFAULT NULL, INDEX IDX_23A0E663DA5256D (image_id), INDEX IDX_23A0E66C78A6A32 (blog_articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, button_id INT DEFAULT NULL, image_id INT DEFAULT NULL, book_suggestion_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_CBE5A331A123E519 (button_id), INDEX IDX_CBE5A3313DA5256D (image_id), INDEX IDX_CBE5A331C1F2802E (book_suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE button (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE good (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, two_col_free_goods_id INT DEFAULT NULL, three_col_free_goods_id INT DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, author VARCHAR(255) DEFAULT NULL, INDEX IDX_6C844E923DA5256D (image_id), INDEX IDX_6C844E92F1FF3C1A (two_col_free_goods_id), INDEX IDX_6C844E929EE8BBBD (three_col_free_goods_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) DEFAULT NULL, absolute_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, job_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, INDEX IDX_CB8931573DA5256D (image_id), INDEX IDX_CB893157BE04EA9 (job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, job_board_id INT DEFAULT NULL, compagny VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, INDEX IDX_FBD8E0F83DA5256D (image_id), INDEX IDX_FBD8E0F880ABF2FE (job_board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail (id INT AUTO_INCREMENT NOT NULL, mail_content_id INT DEFAULT NULL, title VARCHAR(500) DEFAULT NULL, date DATETIME NOT NULL, template VARCHAR(255) DEFAULT NULL, sent TINYINT(1) NOT NULL, INDEX IDX_5126AC4850634911 (mail_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_user (mail_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_20E84520C8776F01 (mail_id), INDEX IDX_20E84520A76ED395 (user_id), PRIMARY KEY(mail_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_content (id INT AUTO_INCREMENT NOT NULL, featured_button_id INT DEFAULT NULL, featured_image_id INT DEFAULT NULL, first_schedule_button_id INT DEFAULT NULL, second_schedule_button_id INT DEFAULT NULL, button_id INT DEFAULT NULL, playlist_button_id INT DEFAULT NULL, playlist_image_id INT DEFAULT NULL, starter_button_id INT DEFAULT NULL, advanced_button_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, title_bold VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, discr VARCHAR(255) NOT NULL, featured_title VARCHAR(255) DEFAULT NULL, featured_author VARCHAR(255) DEFAULT NULL, featured_category VARCHAR(255) DEFAULT NULL, section_featured_title VARCHAR(255) DEFAULT NULL, section_best_title VARCHAR(255) DEFAULT NULL, section_speaker_title VARCHAR(255) DEFAULT NULL, section_schedule_title VARCHAR(255) DEFAULT NULL, schedule_paragraph VARCHAR(600) DEFAULT NULL, playlist_title VARCHAR(255) DEFAULT NULL, playlist_paragraph VARCHAR(600) DEFAULT NULL, starter_title VARCHAR(255) DEFAULT NULL, advanced_title VARCHAR(255) DEFAULT NULL, starter_sub_title VARCHAR(255) DEFAULT NULL, advanced_sub_title VARCHAR(255) DEFAULT NULL, starter_price VARCHAR(255) DEFAULT NULL, advanced_price VARCHAR(255) DEFAULT NULL, starter_date VARCHAR(255) DEFAULT NULL, advanced_date VARCHAR(255) DEFAULT NULL, starter_paragraph VARCHAR(600) DEFAULT NULL, advanced_paragraph VARCHAR(600) DEFAULT NULL, l_label VARCHAR(255) DEFAULT NULL, r_label VARCHAR(255) DEFAULT NULL, l_info VARCHAR(600) DEFAULT NULL, r_info VARCHAR(600) DEFAULT NULL, INDEX IDX_2478B1C6F94365F4 (featured_button_id), INDEX IDX_2478B1C63569D950 (featured_image_id), INDEX IDX_2478B1C654724FAF (first_schedule_button_id), INDEX IDX_2478B1C6957A5AE4 (second_schedule_button_id), INDEX IDX_2478B1C6A123E519 (button_id), INDEX IDX_2478B1C692DD253A (playlist_button_id), INDEX IDX_2478B1C6C078E300 (playlist_image_id), INDEX IDX_2478B1C66695B87D (starter_button_id), INDEX IDX_2478B1C6B3EB3B22 (advanced_button_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mail_event (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, button_id INT DEFAULT NULL, event_suggestion_id INT DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, place VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, paragraph_bold VARCHAR(255) DEFAULT NULL, INDEX IDX_F6DA8C83DA5256D (image_id), INDEX IDX_F6DA8C8A123E519 (button_id), INDEX IDX_F6DA8C88042088E (event_suggestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, event_plan_id INT DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, hour VARCHAR(255) DEFAULT NULL, paragraphs LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_5A3811FB6DCEAB34 (event_plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speaker (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, event_plan_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, INDEX IDX_7B85DB613DA5256D (image_id), INDEX IDX_7B85DB616DCEAB34 (event_plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stat (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, month_stats_id INT DEFAULT NULL, number VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, sub_title VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, evolution VARCHAR(255) DEFAULT NULL, date VARCHAR(255) DEFAULT NULL, INDEX IDX_20B8FF213DA5256D (image_id), INDEX IDX_20B8FF2136D43671 (month_stats_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE text (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, mail_content_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, paragraph VARCHAR(600) DEFAULT NULL, INDEX IDX_3B8BA7C73DA5256D (image_id), INDEX IDX_3B8BA7C750634911 (mail_content_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E663DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C78A6A32 FOREIGN KEY (blog_articles_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331A123E519 FOREIGN KEY (button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3313DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331C1F2802E FOREIGN KEY (book_suggestion_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E923DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E92F1FF3C1A FOREIGN KEY (two_col_free_goods_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E929EE8BBBD FOREIGN KEY (three_col_free_goods_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB8931573DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE info ADD CONSTRAINT FK_CB893157BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F83DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F880ABF2FE FOREIGN KEY (job_board_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE mail ADD CONSTRAINT FK_5126AC4850634911 FOREIGN KEY (mail_content_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE mail_user ADD CONSTRAINT FK_20E84520C8776F01 FOREIGN KEY (mail_id) REFERENCES mail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_user ADD CONSTRAINT FK_20E84520A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C6F94365F4 FOREIGN KEY (featured_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C63569D950 FOREIGN KEY (featured_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C654724FAF FOREIGN KEY (first_schedule_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C6957A5AE4 FOREIGN KEY (second_schedule_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C6A123E519 FOREIGN KEY (button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C692DD253A FOREIGN KEY (playlist_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C6C078E300 FOREIGN KEY (playlist_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C66695B87D FOREIGN KEY (starter_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_content ADD CONSTRAINT FK_2478B1C6B3EB3B22 FOREIGN KEY (advanced_button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_event ADD CONSTRAINT FK_F6DA8C83DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE mail_event ADD CONSTRAINT FK_F6DA8C8A123E519 FOREIGN KEY (button_id) REFERENCES button (id)');
        $this->addSql('ALTER TABLE mail_event ADD CONSTRAINT FK_F6DA8C88042088E FOREIGN KEY (event_suggestion_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB6DCEAB34 FOREIGN KEY (event_plan_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE speaker ADD CONSTRAINT FK_7B85DB613DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE speaker ADD CONSTRAINT FK_7B85DB616DCEAB34 FOREIGN KEY (event_plan_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE stat ADD CONSTRAINT FK_20B8FF213DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE stat ADD CONSTRAINT FK_20B8FF2136D43671 FOREIGN KEY (month_stats_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C73DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE text ADD CONSTRAINT FK_3B8BA7C750634911 FOREIGN KEY (mail_content_id) REFERENCES mail_content (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E663DA5256D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C78A6A32');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331A123E519');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3313DA5256D');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331C1F2802E');
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E923DA5256D');
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E92F1FF3C1A');
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E929EE8BBBD');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB8931573DA5256D');
        $this->addSql('ALTER TABLE info DROP FOREIGN KEY FK_CB893157BE04EA9');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F83DA5256D');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F880ABF2FE');
        $this->addSql('ALTER TABLE mail DROP FOREIGN KEY FK_5126AC4850634911');
        $this->addSql('ALTER TABLE mail_user DROP FOREIGN KEY FK_20E84520C8776F01');
        $this->addSql('ALTER TABLE mail_user DROP FOREIGN KEY FK_20E84520A76ED395');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C6F94365F4');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C63569D950');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C654724FAF');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C6957A5AE4');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C6A123E519');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C692DD253A');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C6C078E300');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C66695B87D');
        $this->addSql('ALTER TABLE mail_content DROP FOREIGN KEY FK_2478B1C6B3EB3B22');
        $this->addSql('ALTER TABLE mail_event DROP FOREIGN KEY FK_F6DA8C83DA5256D');
        $this->addSql('ALTER TABLE mail_event DROP FOREIGN KEY FK_F6DA8C8A123E519');
        $this->addSql('ALTER TABLE mail_event DROP FOREIGN KEY FK_F6DA8C88042088E');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB6DCEAB34');
        $this->addSql('ALTER TABLE speaker DROP FOREIGN KEY FK_7B85DB613DA5256D');
        $this->addSql('ALTER TABLE speaker DROP FOREIGN KEY FK_7B85DB616DCEAB34');
        $this->addSql('ALTER TABLE stat DROP FOREIGN KEY FK_20B8FF213DA5256D');
        $this->addSql('ALTER TABLE stat DROP FOREIGN KEY FK_20B8FF2136D43671');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C73DA5256D');
        $this->addSql('ALTER TABLE text DROP FOREIGN KEY FK_3B8BA7C750634911');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE button');
        $this->addSql('DROP TABLE good');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE info');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE mail');
        $this->addSql('DROP TABLE mail_user');
        $this->addSql('DROP TABLE mail_content');
        $this->addSql('DROP TABLE mail_event');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE speaker');
        $this->addSql('DROP TABLE stat');
        $this->addSql('DROP TABLE text');
    }
}
