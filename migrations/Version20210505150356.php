<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505150356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoping_cart DROP FOREIGN KEY FK_8321C245A0CE8766');
        $this->addSql('DROP INDEX IDX_8321C245A0CE8766 ON shoping_cart');
        $this->addSql('ALTER TABLE shoping_cart CHANGE product_name_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE shoping_cart ADD CONSTRAINT FK_8321C2454584665A FOREIGN KEY (product_id) REFERENCES items (id)');
        $this->addSql('CREATE INDEX IDX_8321C2454584665A ON shoping_cart (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoping_cart DROP FOREIGN KEY FK_8321C2454584665A');
        $this->addSql('DROP INDEX IDX_8321C2454584665A ON shoping_cart');
        $this->addSql('ALTER TABLE shoping_cart CHANGE product_id product_name_id INT NOT NULL');
        $this->addSql('ALTER TABLE shoping_cart ADD CONSTRAINT FK_8321C245A0CE8766 FOREIGN KEY (product_name_id) REFERENCES items (id)');
        $this->addSql('CREATE INDEX IDX_8321C245A0CE8766 ON shoping_cart (product_name_id)');
    }
}
