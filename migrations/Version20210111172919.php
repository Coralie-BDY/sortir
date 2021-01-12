<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111172919 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campus (id INT AUTO_INCREMENT NOT NULL, nom_campus VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieux (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, nom_lieu VARCHAR(50) NOT NULL, adresse VARCHAR(50) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, INDEX IDX_9E44A8AEA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, ratachement_campus_id INT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(10) DEFAULT NULL, email VARCHAR(50) NOT NULL, admin TINYINT(1) NOT NULL, actif TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D79F6B1186CC499D (pseudo), INDEX IDX_D79F6B11E3EDD6F5 (ratachement_campus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant_sortie (participant_id INT NOT NULL, sortie_id INT NOT NULL, INDEX IDX_8E436D739D1C3019 (participant_id), INDEX IDX_8E436D73CC72D953 (sortie_id), PRIMARY KEY(participant_id, sortie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sortie (id INT AUTO_INCREMENT NOT NULL, etat_id INT NOT NULL, campus_id INT NOT NULL, lieux_id INT DEFAULT NULL, participant_id INT NOT NULL, nom_sortie VARCHAR(50) NOT NULL, date_debut DATETIME NOT NULL, duree INT DEFAULT NULL, date_cloture_inscription DATETIME NOT NULL, nb_max_inscrits INT NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_3C3FD3F2D5E86FF (etat_id), INDEX IDX_3C3FD3F2AF5D55E1 (campus_id), INDEX IDX_3C3FD3F2A2C806AC (lieux_id), INDEX IDX_3C3FD3F29D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(50) NOT NULL, code_postal VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieux ADD CONSTRAINT FK_9E44A8AEA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11E3EDD6F5 FOREIGN KEY (ratachement_campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE participant_sortie ADD CONSTRAINT FK_8E436D739D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participant_sortie ADD CONSTRAINT FK_8E436D73CC72D953 FOREIGN KEY (sortie_id) REFERENCES sortie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2D5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2AF5D55E1 FOREIGN KEY (campus_id) REFERENCES campus (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F2A2C806AC FOREIGN KEY (lieux_id) REFERENCES lieux (id)');
        $this->addSql('ALTER TABLE sortie ADD CONSTRAINT FK_3C3FD3F29D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11E3EDD6F5');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2AF5D55E1');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2D5E86FF');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F2A2C806AC');
        $this->addSql('ALTER TABLE participant_sortie DROP FOREIGN KEY FK_8E436D739D1C3019');
        $this->addSql('ALTER TABLE sortie DROP FOREIGN KEY FK_3C3FD3F29D1C3019');
        $this->addSql('ALTER TABLE participant_sortie DROP FOREIGN KEY FK_8E436D73CC72D953');
        $this->addSql('ALTER TABLE lieux DROP FOREIGN KEY FK_9E44A8AEA73F0036');
        $this->addSql('DROP TABLE campus');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE lieux');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE participant_sortie');
        $this->addSql('DROP TABLE sortie');
        $this->addSql('DROP TABLE ville');
    }
}
