<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314103513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, cp VARCHAR(255) NOT NULL, tel VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conseiller (id INT NOT NULL, specialite_id INT DEFAULT NULL, photo VARCHAR(255) NOT NULL, referent TINYINT(1) NOT NULL, description LONGTEXT NOT NULL, maj DATETIME DEFAULT NULL, INDEX IDX_18C69F972195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, titre VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, maj DATETIME DEFAULT NULL, description LONGTEXT NOT NULL, hotel VARCHAR(255) NOT NULL, INDEX IDX_285F75DDF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, INDEX IDX_D79F6B11B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, destinations_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, photo VARCHAR(255) NOT NULL, maj DATETIME DEFAULT NULL, prix INT NOT NULL, INDEX IDX_29A5EC27912C90D4 (destinations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, client_id INT NOT NULL, reference VARCHAR(255) NOT NULL, date_reservation DATETIME NOT NULL, date_depart DATE NOT NULL, prix_total INT NOT NULL, statut enum(\'en attente\', \'validé\', \'terminé\'), INDEX IDX_42C84955F347EFB (produit_id), INDEX IDX_42C8495519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conseiller ADD CONSTRAINT FK_18C69F972195E0F0 FOREIGN KEY (specialite_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE conseiller ADD CONSTRAINT FK_18C69F97BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DDF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27912C90D4 FOREIGN KEY (destinations_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495519EB6921');
        $this->addSql('ALTER TABLE conseiller DROP FOREIGN KEY FK_18C69F972195E0F0');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27912C90D4');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DDF347EFB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F347EFB');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11B83297E7');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE conseiller DROP FOREIGN KEY FK_18C69F97BF396750');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE conseiller');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE user');
    }
}
