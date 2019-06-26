<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603150643 extends AbstractMigration
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
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', telefoonnr INT NOT NULL, banknr VARCHAR(180) DEFAULT NULL, woonplaats VARCHAR(180) NOT NULL, adres VARCHAR(180) NOT NULL, voornaam VARCHAR(180) NOT NULL, achternaam VARCHAR(180) NOT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kamer ADD CONSTRAINT FK_4DD4F6A6C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC3C427B2F FOREIGN KEY (klant_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC78ECB459 FOREIGN KEY (kamer_id) REFERENCES kamer (id)');
        $this->addSql('ALTER TABLE reservering ADD CONSTRAINT FK_F2E439AC6BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC78ECB459');
        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC6BF700BD');
        $this->addSql('ALTER TABLE kamer DROP FOREIGN KEY FK_4DD4F6A6C54C8C93');
        $this->addSql('ALTER TABLE reservering DROP FOREIGN KEY FK_F2E439AC3C427B2F');
        $this->addSql('DROP TABLE kamer');
        $this->addSql('DROP TABLE reservering');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE fos_user');
    }
}
