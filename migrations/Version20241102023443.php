<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241102023443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE interet_potentiel (id INT AUTO_INCREMENT NOT NULL, interet VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nature_visite (id INT AUTO_INCREMENT NOT NULL, nature_v VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, relation_p_id INT NOT NULL, statut_p_id INT NOT NULL, interet_id INT NOT NULL, photo VARCHAR(50) DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, societe VARCHAR(50) NOT NULL, poste VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, numero INT NOT NULL, mail VARCHAR(50) NOT NULL, date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) DEFAULT NULL, INDEX IDX_FCEC9EF6451602F (relation_p_id), INDEX IDX_FCEC9EFF678FE8E (statut_p_id), INDEX IDX_FCEC9EFC1289ECC (interet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, nom_projet VARCHAR(50) NOT NULL, description_projet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realisation (id INT AUTO_INCREMENT NOT NULL, date_r DATE NOT NULL, new_client INT NOT NULL, new_partenaire INT NOT NULL, new_contact INT NOT NULL, nbr_rdv_pris INT NOT NULL, nbr_rdv_conf INT NOT NULL, date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation_p (id INT AUTO_INCREMENT NOT NULL, type_p VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendez_vous (id INT AUTO_INCREMENT NOT NULL, statut_rdv_id INT NOT NULL, personne_id INT NOT NULL, nom_rdv VARCHAR(50) NOT NULL, type_rdv VARCHAR(50) NOT NULL, date_rdv DATETIME NOT NULL, lieu VARCHAR(50) NOT NULL, date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description VARCHAR(255) NOT NULL, INDEX IDX_65E8AA0AFB419ED2 (statut_rdv_id), INDEX IDX_65E8AA0AA21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_p (id INT AUTO_INCREMENT NOT NULL, statut VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_projet (id INT AUTO_INCREMENT NOT NULL, statut_p VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_rendez_vous (id INT AUTO_INCREMENT NOT NULL, statut_rdv VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE strategie (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, nom_strategie VARCHAR(50) NOT NULL, budget INT NOT NULL, date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7BB7B08BA21BD112 (personne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_viste (id INT AUTO_INCREMENT NOT NULL, type_v VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE viste (id INT AUTO_INCREMENT NOT NULL, type_viste_id INT NOT NULL, nom_v VARCHAR(50) NOT NULL, prenom_v VARCHAR(50) NOT NULL, societe VARCHAR(50) NOT NULL, poste VARCHAR(50) NOT NULL, pays VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, numero INT NOT NULL, mail VARCHAR(50) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D6A2A5D7C8D04BC7 (type_viste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF6451602F FOREIGN KEY (relation_p_id) REFERENCES relation_p (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFF678FE8E FOREIGN KEY (statut_p_id) REFERENCES statut_p (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFC1289ECC FOREIGN KEY (interet_id) REFERENCES interet_potentiel (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AFB419ED2 FOREIGN KEY (statut_rdv_id) REFERENCES statut_rendez_vous (id)');
        $this->addSql('ALTER TABLE rendez_vous ADD CONSTRAINT FK_65E8AA0AA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE strategie ADD CONSTRAINT FK_7BB7B08BA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE viste ADD CONSTRAINT FK_D6A2A5D7C8D04BC7 FOREIGN KEY (type_viste_id) REFERENCES type_viste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF6451602F');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFF678FE8E');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFC1289ECC');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AFB419ED2');
        $this->addSql('ALTER TABLE rendez_vous DROP FOREIGN KEY FK_65E8AA0AA21BD112');
        $this->addSql('ALTER TABLE strategie DROP FOREIGN KEY FK_7BB7B08BA21BD112');
        $this->addSql('ALTER TABLE viste DROP FOREIGN KEY FK_D6A2A5D7C8D04BC7');
        $this->addSql('DROP TABLE interet_potentiel');
        $this->addSql('DROP TABLE nature_visite');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE relation_p');
        $this->addSql('DROP TABLE rendez_vous');
        $this->addSql('DROP TABLE statut_p');
        $this->addSql('DROP TABLE statut_projet');
        $this->addSql('DROP TABLE statut_rendez_vous');
        $this->addSql('DROP TABLE strategie');
        $this->addSql('DROP TABLE type_viste');
        $this->addSql('DROP TABLE viste');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
