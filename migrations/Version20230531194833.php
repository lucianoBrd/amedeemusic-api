<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230531194833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E92FFCD7F');
        $this->addSql('DROP INDEX IDX_6C844E92FFCD7F ON good');
        $this->addSql('ALTER TABLE good ADD three_col_free_goods_id INT DEFAULT NULL, CHANGE free_goods_id two_col_free_goods_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E92F1FF3C1A FOREIGN KEY (two_col_free_goods_id) REFERENCES mail_content (id)');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E929EE8BBBD FOREIGN KEY (three_col_free_goods_id) REFERENCES mail_content (id)');
        $this->addSql('CREATE INDEX IDX_6C844E92F1FF3C1A ON good (two_col_free_goods_id)');
        $this->addSql('CREATE INDEX IDX_6C844E929EE8BBBD ON good (three_col_free_goods_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E92F1FF3C1A');
        $this->addSql('ALTER TABLE good DROP FOREIGN KEY FK_6C844E929EE8BBBD');
        $this->addSql('DROP INDEX IDX_6C844E92F1FF3C1A ON good');
        $this->addSql('DROP INDEX IDX_6C844E929EE8BBBD ON good');
        $this->addSql('ALTER TABLE good ADD free_goods_id INT DEFAULT NULL, DROP two_col_free_goods_id, DROP three_col_free_goods_id');
        $this->addSql('ALTER TABLE good ADD CONSTRAINT FK_6C844E92FFCD7F FOREIGN KEY (free_goods_id) REFERENCES mail_content (id)');
        $this->addSql('CREATE INDEX IDX_6C844E92FFCD7F ON good (free_goods_id)');
    }
}
