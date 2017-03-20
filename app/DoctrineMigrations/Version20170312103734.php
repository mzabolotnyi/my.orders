<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170312103734 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sales_order_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B88F75C95E237E06 (name), UNIQUE INDEX UNIQ_B88F75C9E16C6B94 (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function postUp(Schema $schema)
    {
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Новый\', alias=\'new\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Ожидается\', alias=\'expected\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Готов к отправке\', alias=\'ready\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Отправлен\', alias=\'sent\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Выполнен\', alias=\'closed\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Проблемный\', alias=\'problem\';');
        $this->connection->executeUpdate('INSERT INTO sales_order_status SET name=\'Отменен\', alias=\'canceled\';');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sales_order_status');
    }
}
