<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170320184639 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales_orders RENAME INDEX idx_e52ffdee953c1c61 TO IDX_C7DBAFE6953C1C61');
        $this->addSql('ALTER TABLE sales_orders RENAME INDEX idx_e52ffdee6bf700bd TO IDX_C7DBAFE66BF700BD');
        $this->addSql('ALTER TABLE sales_order_row DROP FOREIGN KEY FK_C76BB9BB12469DE2');
        $this->addSql('DROP INDEX IDX_C76BB9BB12469DE2 ON sales_order_row');
        $this->addSql('ALTER TABLE sales_order_row DROP category_id');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_c76bb9bb8d9f6d38 TO IDX_FB25E1F28D9F6D38');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_c76bb9bb498da827 TO IDX_FB25E1F2498DA827');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_c76bb9bb4d16c4dd TO IDX_FB25E1F24D16C4DD');
        $this->addSql('ALTER TABLE sales_order_status RENAME INDEX uniq_b88f75c95e237e06 TO UNIQ_24C278715E237E06');
        $this->addSql('ALTER TABLE sales_order_status RENAME INDEX uniq_b88f75c9e16c6b94 TO UNIQ_24C27871E16C6B94');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX uniq_ac6a4ca25e237e06 TO UNIQ_51FDA1775E237E06');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX idx_ac6a4ca254b9d732 TO IDX_51FDA17754B9D732');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX idx_ac6a4ca289d68997 TO IDX_51FDA17789D68997');
        $this->addSql('ALTER TABLE sales_size RENAME INDEX idx_f7c0246a12469de2 TO IDX_A57C9BF12469DE2');
        $this->addSql('ALTER TABLE sales_size_category RENAME INDEX uniq_58778d1d5e237e06 TO UNIQ_9D51FBAE5E237E06');
        $this->addSql('ALTER TABLE sales_source RENAME INDEX uniq_5f8a7f735e237e06 TO UNIQ_7D7E2D7B5E237E06');
        $this->addSql('ALTER TABLE sales_source RENAME INDEX idx_5f8a7f7354b9d732 TO IDX_7D7E2D7B54B9D732');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sales_order_row ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sales_order_row ADD CONSTRAINT FK_C76BB9BB12469DE2 FOREIGN KEY (category_id) REFERENCES sales_size_category (id)');
        $this->addSql('CREATE INDEX IDX_C76BB9BB12469DE2 ON sales_order_row (category_id)');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_fb25e1f28d9f6d38 TO IDX_C76BB9BB8D9F6D38');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_fb25e1f2498da827 TO IDX_C76BB9BB498DA827');
        $this->addSql('ALTER TABLE sales_order_row RENAME INDEX idx_fb25e1f24d16c4dd TO IDX_C76BB9BB4D16C4DD');
        $this->addSql('ALTER TABLE sales_order_status RENAME INDEX uniq_24c278715e237e06 TO UNIQ_B88F75C95E237E06');
        $this->addSql('ALTER TABLE sales_order_status RENAME INDEX uniq_24c27871e16c6b94 TO UNIQ_B88F75C9E16C6B94');
        $this->addSql('ALTER TABLE sales_orders RENAME INDEX idx_c7dbafe6953c1c61 TO IDX_E52FFDEE953C1C61');
        $this->addSql('ALTER TABLE sales_orders RENAME INDEX idx_c7dbafe66bf700bd TO IDX_E52FFDEE6BF700BD');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX uniq_51fda1775e237e06 TO UNIQ_AC6A4CA25E237E06');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX idx_51fda17754b9d732 TO IDX_AC6A4CA254B9D732');
        $this->addSql('ALTER TABLE sales_shop RENAME INDEX idx_51fda17789d68997 TO IDX_AC6A4CA289D68997');
        $this->addSql('ALTER TABLE sales_size RENAME INDEX idx_a57c9bf12469de2 TO IDX_F7C0246A12469DE2');
        $this->addSql('ALTER TABLE sales_size_category RENAME INDEX uniq_9d51fbae5e237e06 TO UNIQ_58778D1D5E237E06');
        $this->addSql('ALTER TABLE sales_source RENAME INDEX uniq_7d7e2d7b5e237e06 TO UNIQ_5F8A7F735E237E06');
        $this->addSql('ALTER TABLE sales_source RENAME INDEX idx_7d7e2d7b54b9d732 TO IDX_5F8A7F7354B9D732');
    }
}
