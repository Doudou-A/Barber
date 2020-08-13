<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812050630 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indisponibilite DROP FOREIGN KEY FK_8717036FBD427C57');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036FBD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955BD427C57');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE indisponibilite DROP FOREIGN KEY FK_8717036FBD427C57');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036FBD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955BD427C57');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955BD427C57 FOREIGN KEY (coiffeur_id) REFERENCES coiffeur (id)');
    }
}
