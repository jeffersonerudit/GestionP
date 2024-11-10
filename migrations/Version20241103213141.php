<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241103213141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enveloppe (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet_personne (projet_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_284EA218C18272 (projet_id), INDEX IDX_284EA218A21BD112 (personne_id), PRIMARY KEY(projet_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet_personne ADD CONSTRAINT FK_284EA218C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_personne ADD CONSTRAINT FK_284EA218A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet ADD statut_projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9A16F17B0 FOREIGN KEY (statut_projet_id) REFERENCES statut_projet (id)');
        $this->addSql('CREATE INDEX IDX_50159CA9A16F17B0 ON projet (statut_projet_id)');
        $this->addSql('ALTER TABLE strategie ADD enveloppe INT DEFAULT NULL');
        $this->addSql('ALTER TABLE viste ADD nature_viste_id INT NOT NULL');
        $this->addSql('ALTER TABLE viste ADD CONSTRAINT FK_D6A2A5D7F38EC92B FOREIGN KEY (nature_viste_id) REFERENCES nature_visite (id)');
        $this->addSql('CREATE INDEX IDX_D6A2A5D7F38EC92B ON viste (nature_viste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet_personne DROP FOREIGN KEY FK_284EA218C18272');
        $this->addSql('ALTER TABLE projet_personne DROP FOREIGN KEY FK_284EA218A21BD112');
        $this->addSql('DROP TABLE enveloppe');
        $this->addSql('DROP TABLE projet_personne');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA9A16F17B0');
        $this->addSql('DROP INDEX IDX_50159CA9A16F17B0 ON projet');
        $this->addSql('ALTER TABLE projet DROP statut_projet_id');
        $this->addSql('ALTER TABLE strategie DROP enveloppe');
        $this->addSql('ALTER TABLE viste DROP FOREIGN KEY FK_D6A2A5D7F38EC92B');
        $this->addSql('DROP INDEX IDX_D6A2A5D7F38EC92B ON viste');
        $this->addSql('ALTER TABLE viste DROP nature_viste_id');
    }
}
