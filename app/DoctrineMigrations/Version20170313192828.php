<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170313192828 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sales_orders (id INT AUTO_INCREMENT NOT NULL, source_id INT DEFAULT NULL, status_id INT DEFAULT NULL, date DATETIME NOT NULL, number VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, url_chat VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, delivery LONGTEXT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_E52FFDEE953C1C61 (source_id), INDEX IDX_E52FFDEE6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sales_order_row (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, category_id INT DEFAULT NULL, size_id INT DEFAULT NULL, shop_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, purchase_price INT NOT NULL, selling_price INT NOT NULL, weight_included TINYINT(1) NOT NULL, weight_cost INT NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_C76BB9BB8D9F6D38 (order_id), INDEX IDX_C76BB9BB12469DE2 (category_id), INDEX IDX_C76BB9BB498DA827 (size_id), INDEX IDX_C76BB9BB4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sales_orders ADD CONSTRAINT FK_E52FFDEE953C1C61 FOREIGN KEY (source_id) REFERENCES sales_source (id)');
        $this->addSql('ALTER TABLE sales_orders ADD CONSTRAINT FK_E52FFDEE6BF700BD FOREIGN KEY (status_id) REFERENCES sales_order_status (id)');
        $this->addSql('ALTER TABLE sales_order_row ADD CONSTRAINT FK_C76BB9BB8D9F6D38 FOREIGN KEY (order_id) REFERENCES sales_orders (id)');
        $this->addSql('ALTER TABLE sales_order_row ADD CONSTRAINT FK_C76BB9BB12469DE2 FOREIGN KEY (category_id) REFERENCES sales_size_category (id)');
        $this->addSql('ALTER TABLE sales_order_row ADD CONSTRAINT FK_C76BB9BB498DA827 FOREIGN KEY (size_id) REFERENCES sales_size (id)');
        $this->addSql('ALTER TABLE sales_order_row ADD CONSTRAINT FK_C76BB9BB4D16C4DD FOREIGN KEY (shop_id) REFERENCES sales_shop (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales_order_row DROP FOREIGN KEY FK_C76BB9BB8D9F6D38');
        $this->addSql('DROP TABLE sales_orders');
        $this->addSql('DROP TABLE sales_order_row');
    }
}
