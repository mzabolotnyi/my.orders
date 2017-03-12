<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170312162810 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, icon_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_5F8A7F735E237E06 (name), INDEX IDX_5F8A7F7354B9D732 (icon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7354B9D732 FOREIGN KEY (icon_id) REFERENCES media (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F7354B9D732');
        $this->addSql('DROP TABLE source');
    }
}
