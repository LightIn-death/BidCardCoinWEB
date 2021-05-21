<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521212621 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, commissaire_id INT DEFAULT NULL, pays VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, adresse_number VARCHAR(255) NOT NULL, INDEX IDX_C35F0816F7EA9D21 (commissaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse_user (adresse_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D95019F4DE7DC5C (adresse_id), INDEX IDX_7D95019FA76ED395 (user_id), PRIMARY KEY(adresse_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, liste_categorie_enfant_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_497DD634C96EA73 (liste_categorie_enfant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commissaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, email VARCHAR(255) NOT NULL, telephone_m VARCHAR(255) DEFAULT NULL, telephone_f VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, utilistateur_id INT NOT NULL, lot_id INT DEFAULT NULL, commissaire_id INT DEFAULT NULL, ordre_achat_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, adjuger TINYINT(1) NOT NULL, date_heure_vente DATETIME NOT NULL, INDEX IDX_38D1870F1B067F20 (utilistateur_id), INDEX IDX_38D1870FA8CBA5F7 (lot_id), INDEX IDX_38D1870FF7EA9D21 (commissaire_id), INDEX IDX_38D1870F5DD2787F (ordre_achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lot (id INT AUTO_INCREMENT NOT NULL, vente_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_B81291B7DC7170A (vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordre_achat (id INT AUTO_INCREMENT NOT NULL, utilistateur_id INT NOT NULL, lot_id INT NOT NULL, automatique TINYINT(1) NOT NULL, montant_max DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, INDEX IDX_71306AD91B067F20 (utilistateur_id), INDEX IDX_71306AD9A8CBA5F7 (lot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, lot_id INT NOT NULL, utilisateur_id INT NOT NULL, type VARCHAR(255) NOT NULL, validation TINYINT(1) NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_B1DC7A1EA8CBA5F7 (lot_id), INDEX IDX_B1DC7A1EFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, lot_id INT DEFAULT NULL, vendeur_id INT NOT NULL, enchere_gagnante_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, nom_auteur VARCHAR(255) DEFAULT NULL, nom_style VARCHAR(255) DEFAULT NULL, prix_reserve DOUBLE PRECISION DEFAULT NULL, reference_catalogue VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, is_send TINYINT(1) NOT NULL, photo_url VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC27A8CBA5F7 (lot_id), INDEX IDX_29A5EC27858C065E (vendeur_id), UNIQUE INDEX UNIQ_29A5EC2772FCB4 (enchere_gagnante_id), INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_4B3656604DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, numero VARCHAR(255) DEFAULT NULL, solvable VARCHAR(255) DEFAULT NULL, liste_mot_clef VARCHAR(255) DEFAULT NULL, verif_solvable TINYINT(1) NOT NULL, verif_identity TINYINT(1) NOT NULL, verif_ressortissants TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, INDEX IDX_888A2A4C4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816F7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES commissaire (id)');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019F4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse_user ADD CONSTRAINT FK_7D95019FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634C96EA73 FOREIGN KEY (liste_categorie_enfant_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F1B067F20 FOREIGN KEY (utilistateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FF7EA9D21 FOREIGN KEY (commissaire_id) REFERENCES commissaire (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870F5DD2787F FOREIGN KEY (ordre_achat_id) REFERENCES ordre_achat (id)');
        $this->addSql('ALTER TABLE lot ADD CONSTRAINT FK_B81291B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD91B067F20 FOREIGN KEY (utilistateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ordre_achat ADD CONSTRAINT FK_71306AD9A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EA8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A8CBA5F7 FOREIGN KEY (lot_id) REFERENCES lot (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27858C065E FOREIGN KEY (vendeur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2772FCB4 FOREIGN KEY (enchere_gagnante_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656604DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019F4DE7DC5C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656604DE7DC5C');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C4DE7DC5C');
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634C96EA73');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816F7EA9D21');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FF7EA9D21');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2772FCB4');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FA8CBA5F7');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD9A8CBA5F7');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EA8CBA5F7');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A8CBA5F7');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F5DD2787F');
        $this->addSql('ALTER TABLE adresse_user DROP FOREIGN KEY FK_7D95019FA76ED395');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870F1B067F20');
        $this->addSql('ALTER TABLE ordre_achat DROP FOREIGN KEY FK_71306AD91B067F20');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EFB88E14F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27858C065E');
        $this->addSql('ALTER TABLE lot DROP FOREIGN KEY FK_B81291B7DC7170A');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE adresse_user');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commissaire');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE lot');
        $this->addSql('DROP TABLE ordre_achat');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE vente');
    }
}
