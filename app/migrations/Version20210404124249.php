<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404124249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, station_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_E00CEDDE21BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rented_item (id INT AUTO_INCREMENT NOT NULL, booking_id INT NOT NULL, item_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_884BDCA03301C60 (booking_id), INDEX IDX_884BDCA0126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE21BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE rented_item ADD CONSTRAINT FK_884BDCA03301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE rented_item ADD CONSTRAINT FK_884BDCA0126F525E FOREIGN KEY (item_id) REFERENCES rent_item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rented_item DROP FOREIGN KEY FK_884BDCA03301C60');
        $this->addSql('ALTER TABLE rented_item DROP FOREIGN KEY FK_884BDCA0126F525E');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE21BDB235');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE rent_item');
        $this->addSql('DROP TABLE rented_item');
        $this->addSql('DROP TABLE station');
    }
}
