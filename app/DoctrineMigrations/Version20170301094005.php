<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170301094005 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO order_status SET name=\'Новый\', alias=\'new\';');
        $this->addSql('INSERT INTO order_status SET name=\'Ожидается\', alias=\'expected\';');
        $this->addSql('INSERT INTO order_status SET name=\'Готов к отправке\', alias=\'ready\';');
        $this->addSql('INSERT INTO order_status SET name=\'Отправлен\', alias=\'sent\';');
        $this->addSql('INSERT INTO order_status SET name=\'Выполнен\', alias=\'closed\';');
        $this->addSql('INSERT INTO order_status SET name=\'Проблемный\', alias=\'problem\';');
        $this->addSql('INSERT INTO order_status SET name=\'Отменен\', alias=\'canceled\';');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
