<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170319075822 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales_order_row CHANGE weight_included weight_included TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX size_unique ON sales_size');
        $this->addSql('ALTER TABLE sales_size CHANGE category_id category_id INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales_order_row CHANGE weight_included weight_included TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE sales_size CHANGE category_id category_id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX size_unique ON sales_size (name, category_id)');
    }
}
