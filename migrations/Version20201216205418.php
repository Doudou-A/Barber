<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201216205418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE coiffeur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE indisponibilite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE presentation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reservation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE coiffeur (id INT NOT NULL, username VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, snap VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, insta VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE indisponibilite (id INT NOT NULL, coiffeur_id INT DEFAULT NULL, date_indispo DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8717036FBD427C57 ON indisponibilite (coiffeur_id)');
        $this->addSql('CREATE TABLE presentation (id INT NOT NULL, file VARCHAR(255) NOT NULL, type BOOLEAN NOT NULL, format BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reservation (id INT NOT NULL, coiffeur_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_rdv TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42C84955BD427C57 ON reservation (coiffeur_id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, date_created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, token VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, number_change INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036FBD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE indisponibilite DROP CONSTRAINT FK_8717036FBD427C57');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955BD427C57');
        $this->addSql('ALTER TABLE reservation DROP CONSTRAINT FK_42C84955A76ED395');
        $this->addSql('DROP SEQUENCE coiffeur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE indisponibilite_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE presentation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reservation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('DROP TABLE coiffeur');
        $this->addSql('DROP TABLE indisponibilite');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE "user"');
    }
}
