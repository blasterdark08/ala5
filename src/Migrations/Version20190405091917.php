<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405091917 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kamer (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, prijs DOUBLE PRECISION NOT NULL, INDEX IDX_4DD4F6A6C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservering (id INT AUTO_INCREMENT NOT NULL, klant_id INT NOT NULL, kamer_id INT NOT NULL, status_id INT NOT NULL, opmerking VARCHAR(255) DEFAULT NULL, start DATE NOT NULL, eind DATE NOT NULL, betaald TINYINT(1) NOT NULL, INDEX IDX_F2E439AC3C427B2F (klant_id), INDEX IDX_F2E439AC78ECB459 (kamer_id), INDEX IDX_F2E439AC6BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, omschrijving VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, aantal_personen INT NOT NULL, omschrijving VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kamer ADD CONSTRAINT FK_4DD4F6A6C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC3C427B2F FOREIGN KEY (klant_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC78ECB459 FOREIGN KEY (kamer_id) REFERENCES kamer (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE fos_user ADD telefoonnr INT NOT NULL, ADD banknr VARCHAR(180) DEFAULT NULL, ADD woonplaats VARCHAR(180) NOT NULL, ADD adres VARCHAR(180) NOT NULL, ADD voornaam VARCHAR(180) NOT NULL, ADD achternaam VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC78ECB459');
        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC6BF700BD');
        $this->addSql('ALTER TABLE kamer DROP FOREIGN KEY FK_4DD4F6A6C54C8C93');
        $this->addSql('DROP TABLE kamer');
        $this->addSql('DROP TABLE reservering');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type');
        $this->addSql('ALTER TABLE fos_user DROP telefoonnr, DROP banknr, DROP woonplaats, DROP adres, DROP voornaam, DROP achternaam');
    }
}
