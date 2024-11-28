<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113143631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet_personne DROP FOREIGN KEY FK_284EA218C18272');
        $this->addSql('ALTER TABLE projet_personne DROP FOREIGN KEY FK_284EA218A21BD112');
        $this->addSql('DROP TABLE projet_personne');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet_personne (projet_id INT NOT NULL, personne_id INT NOT NULL, INDEX IDX_284EA218C18272 (projet_id), INDEX IDX_284EA218A21BD112 (personne_id), PRIMARY KEY(projet_id, personne_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE projet_personne ADD CONSTRAINT FK_284EA218C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projet_personne ADD CONSTRAINT FK_284EA218A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
    }
}
