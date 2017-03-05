<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170228201305 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, source_id INT DEFAULT NULL, status_id INT DEFAULT NULL, date DATETIME NOT NULL, number VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, delivery LONGTEXT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_E52FFDEE953C1C61 (source_id), INDEX IDX_E52FFDEE6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_row (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, type_id INT DEFAULT NULL, size_id INT DEFAULT NULL, shop_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, purchase_price INT NOT NULL, selling_price INT NOT NULL, weight_included TINYINT(1) NOT NULL, weight_cost INT NOT NULL, comment LONGTEXT DEFAULT NULL, INDEX IDX_C76BB9BB8D9F6D38 (order_id), INDEX IDX_C76BB9BBC54C8C93 (type_id), INDEX IDX_C76BB9BB498DA827 (size_id), INDEX IDX_C76BB9BB4D16C4DD (shop_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B88F75C95E237E06 (name), UNIQUE INDEX UNIQ_B88F75C9E16C6B94 (alias), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, size_guide VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_AC6A4CA25E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F7C0246AC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E77B918D5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, comment LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_5F8A7F735E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE953C1C61 FOREIGN KEY (source_id) REFERENCES source (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE6BF700BD FOREIGN KEY (status_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE order_row ADD CONSTRAINT FK_C76BB9BB8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE order_row ADD CONSTRAINT FK_C76BB9BBC54C8C93 FOREIGN KEY (type_id) REFERENCES size_type (id)');
        $this->addSql('ALTER TABLE order_row ADD CONSTRAINT FK_C76BB9BB498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE order_row ADD CONSTRAINT FK_C76BB9BB4D16C4DD FOREIGN KEY (shop_id) REFERENCES shop (id)');
        $this->addSql('ALTER TABLE size ADD CONSTRAINT FK_F7C0246AC54C8C93 FOREIGN KEY (type_id) REFERENCES size_type (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_row DROP FOREIGN KEY FK_C76BB9BB8D9F6D38');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE6BF700BD');
        $this->addSql('ALTER TABLE order_row DROP FOREIGN KEY FK_C76BB9BB4D16C4DD');
        $this->addSql('ALTER TABLE order_row DROP FOREIGN KEY FK_C76BB9BB498DA827');
        $this->addSql('ALTER TABLE order_row DROP FOREIGN KEY FK_C76BB9BBC54C8C93');
        $this->addSql('ALTER TABLE size DROP FOREIGN KEY FK_F7C0246AC54C8C93');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE953C1C61');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE order_row');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE shop');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE size_type');
        $this->addSql('DROP TABLE source');
    }
}
